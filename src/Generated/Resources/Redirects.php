<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Redirects
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List redirects and broken links**
     *
     * The store's redirects, and under `meta.missing` the addresses people asked the store for that had nothing at them, most asked for first. A redirect from an address that still has a page is kept and waits: `live` says which.
     *
     * Needs the `seo.read` permission (Read Search Settings).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     from: string,
     *     to: string,
     *     hits: int|float,
     *     createdAt: string,
     *     live: bool
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/redirects/list-redirects-and-broken-links
     */
    public function list(array $options = []): mixed
    {
        return $this->caller->call('redirects.list', [], [], $options);
    }

    /**
     * **Create a redirect**
     *
     * Sends an address that has nothing at it to one that has. It is followed only once the first address has turned out to be nothing, so a redirect can never take a page away. Adding one for a broken link takes that link off the list. Answers the store's redirects as they now stand.
     *
     * Needs the `seo.write` permission (Change Search Settings).
     *
     * Fields:
     *
     * - `from` (required): The address that has nothing at it, as a path on the store (`/old-page`). A whole address of the store is cut down to its path.
     * - `to` (required): Where it leads, as a path on the store. A redirect never leaves the store, and never leads to an address that is itself redirected.
     *
     * @param array{
     *     from: string,
     *     to: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     from: string,
     *     to: string,
     *     hits: int|float,
     *     createdAt: string,
     *     live: bool
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/redirects/create-a-redirect
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('redirects.create', [], $params, $options);
    }

    /**
     * **Update a redirect**
     *
     * Changes where a redirect is from and where it leads. Answers the store's redirects as they now stand.
     *
     * Needs the `seo.write` permission (Change Search Settings).
     *
     * Fields:
     *
     * - `from` (required): The address that has nothing at it, as a path on the store (`/old-page`). A whole address of the store is cut down to its path.
     * - `to` (required): Where it leads, as a path on the store. A redirect never leaves the store, and never leads to an address that is itself redirected.
     *
     * @param string $redirectId The redirect.
     * @param array{
     *     from: string,
     *     to: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     from: string,
     *     to: string,
     *     hits: int|float,
     *     createdAt: string,
     *     live: bool
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/redirects/update-a-redirect
     */
    public function update(string $redirectId, array $params, array $options = []): mixed
    {
        return $this->caller->call('redirects.update', [$redirectId], $params, $options);
    }

    /**
     * **Delete a redirect**
     *
     * Removes a redirect. Answers the redirects that are left.
     *
     * Needs the `seo.write` permission (Change Search Settings).
     *
     * @param string $redirectId The redirect.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array<mixed>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/redirects/delete-a-redirect
     */
    public function delete(string $redirectId, array $options = []): mixed
    {
        return $this->caller->call('redirects.delete', [$redirectId], [], $options);
    }
}
