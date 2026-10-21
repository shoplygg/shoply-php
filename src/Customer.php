<?php

declare(strict_types=1);

namespace Shoply;

use Shoply\Generated\CustomerBase;

/**
 * The Customer API: a buyer signed in on your own site or app with a code emailed to them,
 * reading their own orders, keys, subscriptions and affiliate page. It holds the buyer's token
 * and no key.
 *
 *     $buyer = new \Shoply\Customer(['storeId' => 'YOUR_STORE_ID']);
 *     $buyer->login(['email' => $email]);
 *     $buyer->verify(['email' => $email, 'code' => $code]); // keeps the token
 *     $me = $buyer->show();
 */
class Customer extends CustomerBase
{
    /** The buyer's token, once signed in: keep it to sign them in again without a code. */
    public ?string $token;

    public readonly string $storeId;

    private Transport $transport;

    /**
     * `storeId`, the store's ID, from Settings, General (it is not a secret); `token`, one from an
     * earlier sign-in (`shoply_ct_...`), if you kept one; and `baseUrl`, `timeout`, `maxRetries`
     * as the Client takes them.
     *
     * @param array<string, mixed> $options
     */
    public function __construct(array $options)
    {
        if (!isset($options['storeId']) || !is_string($options['storeId']) || $options['storeId'] === '') {
            throw new ShoplyException('Pass the store\'s ID as `storeId`. It is in Settings, General, in the store\'s dashboard.', 0, 'store_id_required');
        }

        $this->storeId   = $options['storeId'];
        $this->token     = isset($options['token']) ? (string) $options['token'] : null;
        $this->transport = new Transport(
            isset($options['baseUrl']) ? (string) $options['baseUrl'] : null,
            (float) ($options['timeout'] ?? 60),
            (int) ($options['maxRetries'] ?? 2),
            fn (): ?string => $this->token,
        );

        parent::__construct();
    }

    /**
     * @internal What every generated method calls.
     *
     * @param array<int, mixed>    $path
     * @param array<string, mixed> $params
     * @param array<string, mixed> $options
     */
    public function call(string $id, array $path, array $params, array $options): mixed
    {
        $call  = Calls::prepare($id, $path, $params);
        $route = $call['route'];

        if ($route['signedIn'] && ($this->token === null || $this->token === '')) {
            throw new ShoplyException('Sign the buyer in first: login, then verify with the code they were emailed.', 0, 'customer_token_required');
        }

        $answer = $this->transport->send(
            $route['method'],
            Calls::fill($route['path'], $call['values'] + ['storeId' => $this->storeId]),
            $call['query'],
            $call['body'],
            null,
            false,
            false,
            $options,
        );

        $data = $answer instanceof File ? $answer : ($answer['data'] ?? null);

        // Signing in hands out the token; signing out ends it.
        if ($id === 'customer.verify' && is_array($data) && is_string($data['token'] ?? null)) {
            $this->token = $data['token'];
        }

        if ($id === 'customer.logout' || $id === 'customer.logoutEverywhere') {
            $this->token = null;
        }

        return $data;
    }
}
