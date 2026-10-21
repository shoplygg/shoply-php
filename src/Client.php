<?php

declare(strict_types=1);

namespace Shoply;

use Shoply\Generated\ClientBase;

/**
 * Shoply's API from your own server, with a store's secret API key. Every route of the API
 * reference is a method named by its id: `orders.show` is `$shoply->orders->show($orderId)`.
 *
 *     $shoply = new \Shoply\Client(['apiKey' => getenv('SHOPLY_API_KEY')]);
 *     $order  = $shoply->orders->show('8f2c...');
 *
 * A call takes the IDs in the route's address, in order, then its fields as one array, then
 * options (`idempotencyKey`, `timeout`, `maxRetries`, `headers`). It answers the route's
 * `data`, as arrays; a list that is paged answers a Page, and a file a File.
 *
 * Docs: https://docs.shoply.gg/api-reference/php
 */
class Client extends ClientBase
{
    public const VERSION = '0.1.0';

    private Transport $transport;

    private ?string $storeId;

    /**
     * @param array{apiKey?: string|false|null, storeId?: string, baseUrl?: string, timeout?: int|float, maxRetries?: int} $options
     *        apiKey      `shoply_sk_...`, or what getenv() answers. Left out, SHOPLY_API_KEY from the environment.
     *        storeId     the store's ID. Left out, it is asked of the key the first time it is needed.
     *        timeout     how long one try waits for an answer, in seconds. 60.
     *        maxRetries  how many more tries a request that is safe to repeat is given. 2.
     */
    public function __construct(array $options = [])
    {
        $apiKey = $options['apiKey'] ?? (getenv('SHOPLY_API_KEY') ?: null);

        if (!is_string($apiKey) || !str_starts_with($apiKey, 'shoply_sk_')) {
            throw new ShoplyException('Pass the store\'s secret API key as `apiKey` (shoply_sk_...), or set SHOPLY_API_KEY.', 0, 'api_key_required');
        }

        $this->storeId   = isset($options['storeId']) ? (string) $options['storeId'] : null;
        $this->transport = new Transport(
            $options['baseUrl'] ?? null,
            (float) ($options['timeout'] ?? 60),
            (int) ($options['maxRetries'] ?? 2),
            static fn (): string => $apiKey,
        );

        parent::__construct();
    }

    /** The store the key belongs to, asked once and remembered. */
    public function storeId(): string
    {
        if ($this->storeId === null) {
            $answer        = $this->transport->send('GET', '/key', null, null, null, false, false, []);
            $this->storeId = (string) $answer['data']['store']['id'];
        }

        return $this->storeId;
    }

    /**
     * Any route, by its method and its address after /v1, for one newer than this package:
     * `{storeId}` in the path is filled in. Answers the whole envelope: `data`, and `meta`,
     * `pages` and `total` where the route has them.
     *
     * @param array{query?: array<string, mixed>, body?: mixed} $params
     * @param array<string, mixed>                              $options
     * @return array<string, mixed>
     */
    public function request(string $method, string $path, array $params = [], array $options = []): array
    {
        $method = strtoupper($method);

        if (str_contains($path, '{storeId}')) {
            $path = str_replace('{storeId}', rawurlencode($this->storeId()), $path);
        }

        /** @var array<string, mixed> */
        return $this->transport->send($method, $path, $params['query'] ?? null, $params['body'] ?? null, null, $method !== 'GET', false, $options);
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

        $fetch = function (int $page) use ($call, $route, $options): mixed {
            $values = $call['values'];

            if (str_contains($route['path'], '{storeId}')) {
                $values['storeId'] = $this->storeId();
            }

            $query  = $route['paged'] ? ['page' => $page] + ($call['query'] ?? []) : $call['query'];
            $answer = $this->transport->send($route['method'], Calls::fill($route['path'], $values), $query, $call['body'], $call['form'], $route['idempotent'], $route['file'], $options);

            return $answer;
        };

        if ($route['paged']) {
            $first = isset($params['page']) && is_int($params['page']) && $params['page'] > 0 ? $params['page'] : 1;

            return self::page($fetch, $first);
        }

        $answer = $fetch(1);

        return $answer instanceof File ? $answer : ($answer['data'] ?? null);
    }

    /**
     * @param \Closure(int): mixed $fetch
     * @return Page<mixed>
     */
    private static function page(\Closure $fetch, int $number): Page
    {
        $answer = $fetch($number);

        return new Page(
            is_array($answer['data'] ?? null) ? array_values($answer['data']) : [],
            $number,
            isset($answer['pages']) ? (int) $answer['pages'] : null,
            isset($answer['total']) ? (int) $answer['total'] : null,
            is_array($answer['meta'] ?? null) ? $answer['meta'] : null,
            static fn (int $next): Page => self::page($fetch, $next),
        );
    }
}
