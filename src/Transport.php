<?php

declare(strict_types=1);

namespace Shoply;

/**
 * Asking the API: one request, tried again where that is safe.
 *
 * @internal
 */
final class Transport
{
    /** Statuses a request that is safe to repeat is tried again on. */
    private const AGAIN = [408, 429, 500, 502, 503, 504];

    private string $baseUrl;

    /**
     * @param \Closure(): ?string $auth the token to send, if any
     */
    public function __construct(
        ?string $baseUrl,
        private readonly float $timeout,
        private readonly int $maxRetries,
        private readonly \Closure $auth,
    ) {
        if (!function_exists('curl_init')) {
            throw new ShoplyException('PHP\'s curl extension is needed to ask Shoply.', 0, 'no_curl');
        }

        $this->baseUrl = rtrim($baseUrl ?? 'https://api.shoply.gg/v1', '/');
    }

    /**
     * One request: `path` after /v1, `query` into the address, `body` as JSON or `form` as
     * multipart. Answers the decoded envelope, or a File for a route that answers one.
     *
     * @param array<string, mixed>|null $query
     * @param array<string, mixed>|null $form
     * @param array<string, mixed>      $options
     * @return array<string, mixed>|File
     */
    public function send(string $method, string $path, ?array $query, mixed $body, ?array $form, bool $idempotent, bool $file, array $options): array|File
    {
        $url = $this->baseUrl . $path;

        if ($query) {
            $pairs = [];

            foreach ($query as $name => $value) {
                if ($value === null) {
                    continue;
                }

                foreach (is_array($value) ? $value : [$value] as $one) {
                    $pairs[] = rawurlencode((string) $name) . '=' . rawurlencode(is_bool($one) ? ($one ? 'true' : 'false') : (string) $one);
                }
            }

            if ($pairs !== []) {
                $url .= '?' . implode('&', $pairs);
            }
        }

        $headers = ['Accept' => 'application/json', 'User-Agent' => 'shoply-php/' . Client::VERSION . ' (php/' . PHP_VERSION . ')'];
        $token   = ($this->auth)();

        if ($token !== null && $token !== '') {
            $headers['Authorization'] = 'Bearer ' . $token;
        }

        if ($body !== null) {
            $headers['Content-Type'] = 'application/json';
        }

        // A change carries a key of its own, the same on every try, so that a try whose answer
        // was lost is answered as the first was rather than carried out twice.
        $key = $idempotent ? (string) ($options['idempotencyKey'] ?? self::uuid()) : null;

        if ($key !== null) {
            $headers['Idempotency-Key'] = $key;
        }

        foreach ((array) ($options['headers'] ?? []) as $name => $value) {
            $headers[(string) $name] = (string) $value;
        }

        $lines   = array_map(static fn (string $name, string $value): string => $name . ': ' . $value, array_keys($headers), $headers);
        $retries = (int) ($options['maxRetries'] ?? $this->maxRetries);
        $timeout = (float) ($options['timeout'] ?? $this->timeout);
        $safe    = $method === 'GET' || $key !== null;
        $payload = $form ?? ($body !== null ? json_encode($body, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR) : null);

        for ($attempt = 0; ; $attempt++) {
            $answerHeaders = [];
            $curl          = curl_init($url);

            curl_setopt_array($curl, [
                CURLOPT_CUSTOMREQUEST     => $method,
                CURLOPT_RETURNTRANSFER    => true,
                CURLOPT_HTTPHEADER        => $lines,
                CURLOPT_TIMEOUT_MS        => (int) round($timeout * 1000),
                CURLOPT_CONNECTTIMEOUT_MS => (int) round(min($timeout, 10.0) * 1000),
                CURLOPT_FOLLOWLOCATION    => false,
                CURLOPT_HEADERFUNCTION    => static function ($curl, string $line) use (&$answerHeaders): int {
                    $parts = explode(':', $line, 2);

                    if (count($parts) === 2) {
                        $answerHeaders[strtolower(trim($parts[0]))] = trim($parts[1]);
                    }

                    return strlen($line);
                },
            ]);

            if ($payload !== null) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
            }

            $text   = curl_exec($curl);
            $errno  = curl_errno($curl);
            $error  = curl_error($curl);
            $status = (int) curl_getinfo($curl, CURLINFO_RESPONSE_CODE);

            curl_close($curl);

            if ($text === false || $errno !== 0) {
                $timedOut = $errno === CURLE_OPERATION_TIMEDOUT;
                $failure  = new ShoplyException(
                    $timedOut ? sprintf('Shoply did not answer within %s seconds.', $timeout) : 'Shoply could not be reached: ' . $error,
                    0,
                    $timedOut ? 'timeout' : 'connection_error',
                );

                // Whether a change that got no answer was made is not known: only one with a
                // key is sent again.
                if ($safe && $attempt < $retries) {
                    usleep(self::backoff($attempt));
                    continue;
                }

                throw $failure;
            }

            if ($status >= 200 && $status < 300 && $file) {
                return new File((string) $text, $answerHeaders);
            }

            $parsed = $text === '' ? null : json_decode((string) $text, true);

            if ($status >= 200 && $status < 300 && is_array($parsed) && ($parsed['success'] ?? null) !== false) {
                return $parsed;
            }

            $retryAfter = isset($answerHeaders['retry-after']) && ctype_digit($answerHeaders['retry-after']) ? (int) $answerHeaders['retry-after'] : null;
            $code       = is_array($parsed) && is_string($parsed['code'] ?? null) ? $parsed['code'] : null;
            $exception  = new ShoplyException(
                is_array($parsed) && is_string($parsed['message'] ?? null) && $parsed['message'] !== '' ? $parsed['message'] : "Shoply answered {$status}.",
                $status,
                $code,
                is_array($parsed) && is_array($parsed['errors'] ?? null) ? $parsed['errors'] : null,
                $answerHeaders['x-request-id'] ?? null,
                $retryAfter,
                $parsed ?? $text,
            );

            // Told to slow down or to wait for the same request still running, and anything the
            // server could not answer: tried again, after as long as it said where it said, where
            // it is safe to. A change with no key is never sent again by itself.
            $again = $safe
                && $attempt < $retries
                && (in_array($status, self::AGAIN, true) || ($status === 409 && $code === 'request_in_progress'));

            if ($again && ($retryAfter === null || $retryAfter <= 60)) {
                usleep($retryAfter !== null ? $retryAfter * 1_000_000 : self::backoff($attempt));
                continue;
            }

            throw $exception;
        }
    }

    /** Half a second, then one, then two, up to eight, a little more or less. In microseconds. */
    private static function backoff(int $attempt): int
    {
        return (int) (min(8.0, 0.5 * 2 ** $attempt) * (0.75 + mt_rand() / mt_getrandmax() * 0.5) * 1_000_000);
    }

    private static function uuid(): string
    {
        $bytes    = random_bytes(16);
        $bytes[6] = chr((ord($bytes[6]) & 0x0f) | 0x40);
        $bytes[8] = chr((ord($bytes[8]) & 0x3f) | 0x80);

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($bytes), 4));
    }
}
