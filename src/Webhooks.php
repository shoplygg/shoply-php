<?php

declare(strict_types=1);

namespace Shoply;

/** Checking that a webhook came from Shoply, and making a signed one to test your handler with. */
final class Webhooks
{
    /**
     * The event, once its signature checks out with the endpoint's signing secret and it was sent
     * within `$tolerance` seconds. Pass the raw body, as it arrived (`file_get_contents('php://input')`),
     * and the request's headers: from getallheaders(), a framework's request, or $_SERVER.
     * Throws a ShoplyException with errorCode `invalid_signature` or `too_old` otherwise.
     *
     * @param array<string, string|list<string>> $headers
     * @return array{id: string, event: string, createdAt: string, storeId: string, data: array<string, mixed>}
     */
    public static function verify(string $payload, array $headers, string $secret, int $tolerance = 300): array
    {
        if ($secret === '') {
            throw new \InvalidArgumentException('Pass the endpoint\'s signing secret, from its page under Developers, Webhooks.');
        }

        $timestamp = self::header($headers, 'X-Shoply-Timestamp');
        $given     = self::header($headers, 'X-Shoply-Signature');

        if ($timestamp === null || !ctype_digit($timestamp) || $given === null) {
            throw new ShoplyException('The request has no Shoply signature: X-Shoply-Timestamp and X-Shoply-Signature.', 0, 'invalid_signature');
        }

        $expected = 'v1=' . hash_hmac('sha256', $timestamp . '.' . $payload, $secret);
        $matched  = false;

        foreach (explode(',', $given) as $one) {
            $matched = hash_equals($expected, trim($one)) || $matched;
        }

        if (!$matched) {
            throw new ShoplyException('The signature does not match. Check the signing secret, and that the body is the raw one.', 0, 'invalid_signature');
        }

        if (abs(time() - (int) $timestamp) > $tolerance) {
            throw new ShoplyException("The webhook was signed more than {$tolerance} seconds ago.", 0, 'too_old');
        }

        $event = json_decode($payload, true);

        if (!is_array($event)) {
            throw new ShoplyException('The webhook\'s body is not JSON.', 0, 'invalid_payload');
        }

        /** @var array{id: string, event: string, createdAt: string, storeId: string, data: array<string, mixed>} */
        return $event;
    }

    /**
     * The headers Shoply would send with this body: for testing your own handler.
     *
     * @return array{X-Shoply-Timestamp: string, X-Shoply-Signature: string}
     */
    public static function sign(string $payload, string $secret, ?int $timestamp = null): array
    {
        $timestamp = (string) ($timestamp ?? time());

        return [
            'X-Shoply-Timestamp' => $timestamp,
            'X-Shoply-Signature' => 'v1=' . hash_hmac('sha256', $timestamp . '.' . $payload, $secret),
        ];
    }

    /**
     * A header by its name, whatever its case, a list's first value, or as $_SERVER names it.
     *
     * @param array<string, string|list<string>> $headers
     */
    private static function header(array $headers, string $name): ?string
    {
        $server = 'HTTP_' . strtoupper(str_replace('-', '_', $name));

        foreach ($headers as $key => $value) {
            if (strcasecmp((string) $key, $name) === 0 || (string) $key === $server) {
                $value = is_array($value) ? ($value[0] ?? null) : $value;

                return is_string($value) ? $value : null;
            }
        }

        return null;
    }
}
