<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Requests
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List API requests**
     *
     * The requests made with this store's API keys, newest first, without what was sent or answered. Requests are kept for 30 days. `meta.keptDays` says so.
     *
     * Needs the `logs.read` permission (Read API Requests).
     *
     * Fields:
     *
     * - `page`: Which page of the list. The first is 1. Left out, it is 1.
     * - `perPage`: How many a page holds, up to 100. Left out, it is 50.
     * - `keyId`: Only requests made with this API key.
     * - `method`: Only requests of this method.
     * - `status`: Only requests that worked (`ok`), that were refused or failed (`failed`), or with one status code (`404`).
     * - `search`: A request's ID, or part of a path.
     *
     * @param array{
     *     page?: int,
     *     perPage?: int,
     *     keyId?: string,
     *     method?: 'GET'|'POST'|'PUT'|'PATCH'|'DELETE',
     *     status?: string,
     *     search?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\Page<array{
     *     id: string,
     *     method: string,
     *     path: string,
     *     query: string,
     *     operation: string,
     *     status: int|float,
     *     code: mixed,
     *     durationMs: int|float,
     *     ip: string,
     *     userAgent: string,
     *     apiKey: array{
     *         id: string,
     *         name: string,
     *         prefix: string
     *     },
     *     createdAt: string
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/api-requests/list-api-requests
     */
    public function list(array $params = [], array $options = []): \Shoply\Page
    {
        return $this->caller->call('requests.list', [], $params, $options);
    }

    /**
     * **Get an API request**
     *
     * One request, with what was sent and what came back. Long bodies are cut short, and values that are secrets or goods (a password, license keys going into stock) are not kept. A request's ID is the `X-Request-Id` header of its answer.
     *
     * Needs the `logs.read` permission (Read API Requests).
     *
     * @param string $requestId The request, as its answer's `X-Request-Id` header named it.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     method: string,
     *     path: string,
     *     query: string,
     *     operation: string,
     *     status: int|float,
     *     code: mixed,
     *     durationMs: int|float,
     *     ip: string,
     *     userAgent: string,
     *     apiKey: array{
     *         id: string,
     *         name: string,
     *         prefix: string
     *     },
     *     createdAt: string,
     *     requestBody: mixed,
     *     responseBody: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/api-requests/get-an-api-request
     */
    public function show(string $requestId, array $options = []): mixed
    {
        return $this->caller->call('requests.show', [$requestId], [], $options);
    }
}
