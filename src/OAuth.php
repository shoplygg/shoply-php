<?php

declare(strict_types=1);

namespace Shoply;

/**
 * Connecting an app to a seller's store, by OAuth's authorization code flow:
 *
 *   1. Send the seller to authorizeUrl(). With PKCE (always, for a desktop or phone app), make
 *      a pair with pkce() first, keep its verifier and send its challenge.
 *   2. They come back to your redirect URL with `code` and your `state`. Check the state.
 *   3. exchange() the code, on your server with the client secret, or with the verifier.
 *   4. The token is a key of their store: `new \Shoply\Client(['apiKey' => $token])`. It works
 *      until the seller disconnects the app; revoke() gives it up.
 *
 * Docs: https://docs.shoply.gg/guides/oauth
 */
final class OAuth
{
    private const DASHBOARD = 'https://dashboard.shoply.gg';

    private const API = 'https://api.shoply.gg/v1';

    /**
     * The page to send a seller to. `state` is yours, sent back unchanged: check it.
     *
     * @param array{clientId: string, redirectUri: string, state?: string, codeChallenge?: string, dashboardUrl?: string} $options
     */
    public static function authorizeUrl(array $options): string
    {
        $clientId    = $options['clientId'];
        $redirectUri = $options['redirectUri'];

        if ($clientId === '' || $redirectUri === '') {
            throw new \InvalidArgumentException('Pass the app\'s clientId and the redirectUri the seller is sent back to.');
        }

        $query = ['response_type' => 'code', 'client_id' => $clientId, 'redirect_uri' => $redirectUri];

        if (($options['state'] ?? '') !== '') {
            $query['state'] = (string) $options['state'];
        }

        if (($options['codeChallenge'] ?? '') !== '') {
            $query['code_challenge']        = (string) $options['codeChallenge'];
            $query['code_challenge_method'] = 'S256';
        }

        return rtrim((string) ($options['dashboardUrl'] ?? self::DASHBOARD), '/') . '/oauth/authorize/?' . http_build_query($query, '', '&', PHP_QUERY_RFC3986);
    }

    /**
     * A PKCE pair: keep `verifier` until the code comes back, and send `challenge`.
     *
     * @return array{verifier: string, challenge: string, method: 'S256'}
     */
    public static function pkce(): array
    {
        $verifier = self::base64url(random_bytes(32));

        return ['verifier' => $verifier, 'challenge' => self::base64url(hash('sha256', $verifier, true)), 'method' => 'S256'];
    }

    /** A random `state`, to keep with the seller's session and compare when they come back. */
    public static function state(): string
    {
        return self::base64url(random_bytes(16));
    }

    /**
     * The code swapped for the token. A web app sends its client secret; a desktop or phone app
     * sends the PKCE verifier and no secret. Throws a ShoplyException whose errorCode is OAuth's
     * word: `invalid_grant` (the code is wrong, used, or older than ten minutes), `invalid_client`.
     *
     * @param array{clientId: string, clientSecret?: string, code: string, redirectUri: string, codeVerifier?: string, baseUrl?: string} $options
     * @return array{accessToken: string, tokenType: string, scopes: list<string>, storeId: string}
     */
    public static function exchange(array $options): array
    {
        $clientId    = $options['clientId'];
        $code        = $options['code'];
        $redirectUri = $options['redirectUri'];

        if ($clientId === '' || $code === '' || $redirectUri === '') {
            throw new \InvalidArgumentException('Pass clientId, the code and the redirectUri it came back to.');
        }

        $form = ['grant_type' => 'authorization_code', 'code' => $code, 'redirect_uri' => $redirectUri];

        if (($options['codeVerifier'] ?? '') !== '') {
            $form['code_verifier'] = (string) $options['codeVerifier'];
        }

        $body   = self::post('/oauth/token', $form, $clientId, (string) ($options['clientSecret'] ?? ''), $options['baseUrl'] ?? null);
        $scopes = array_values(array_filter(explode(' ', (string) ($body['scope'] ?? '')), static fn (string $one): bool => $one !== ''));

        return [
            'accessToken' => (string) ($body['access_token'] ?? ''),
            'tokenType'   => (string) ($body['token_type'] ?? ''),
            'scopes'      => $scopes,
            'storeId'     => (string) ($body['store_id'] ?? ''),
        ];
    }

    /**
     * A token given up: it stops working at once. Answered the same whether or not there was one.
     *
     * @param array{clientId: string, clientSecret?: string, token: string, baseUrl?: string} $options
     */
    public static function revoke(array $options): void
    {
        $clientId = $options['clientId'];
        $token    = $options['token'];

        if ($clientId === '' || $token === '') {
            throw new \InvalidArgumentException('Pass clientId and the token to give up.');
        }

        self::post('/oauth/revoke', ['token' => $token], $clientId, (string) ($options['clientSecret'] ?? ''), $options['baseUrl'] ?? null);
    }

    /**
     * @param array<string, string> $form
     * @return array<string, mixed>
     */
    private static function post(string $path, array $form, string $clientId, string $clientSecret, ?string $baseUrl): array
    {
        $headers = ['Content-Type: application/x-www-form-urlencoded', 'Accept: application/json', 'User-Agent: shoply-php/' . Client::VERSION . ' (php/' . PHP_VERSION . ')'];

        if ($clientSecret !== '') {
            $headers[] = 'Authorization: Basic ' . base64_encode(rawurlencode($clientId) . ':' . rawurlencode($clientSecret));
        } else {
            $form['client_id'] = $clientId;
        }

        $curl = curl_init(rtrim($baseUrl ?? self::API, '/') . $path);

        curl_setopt_array($curl, [
            CURLOPT_POST              => true,
            CURLOPT_RETURNTRANSFER    => true,
            CURLOPT_HTTPHEADER        => $headers,
            CURLOPT_POSTFIELDS        => http_build_query($form, '', '&', PHP_QUERY_RFC3986),
            CURLOPT_TIMEOUT           => 60,
            CURLOPT_CONNECTTIMEOUT    => 10,
            CURLOPT_FOLLOWLOCATION    => false,
        ]);

        $text   = curl_exec($curl);
        $status = (int) curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
        $error  = curl_error($curl);

        curl_close($curl);

        if (!is_string($text)) {
            throw new ShoplyException('Shoply could not be reached: ' . $error, 0, 'connection_error');
        }

        $body = $text === '' ? [] : json_decode($text, true);

        if ($status < 200 || $status >= 300) {
            $said = is_array($body) ? $body : [];

            throw new ShoplyException(
                is_string($said['error_description'] ?? null) ? $said['error_description'] : (is_string($said['message'] ?? null) ? $said['message'] : sprintf('Shoply answered %d.', $status)),
                $status,
                is_string($said['error'] ?? null) ? $said['error'] : ($status === 429 ? 'rate_limited' : 'oauth_error'),
                null,
                null,
                null,
                $body,
            );
        }

        /** @var array<string, mixed> */
        return is_array($body) ? $body : [];
    }

    private static function base64url(string $bytes): string
    {
        return rtrim(strtr(base64_encode($bytes), '+/', '-_'), '=');
    }
}
