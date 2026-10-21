<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Sitemap
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **Get the sitemap**
     *
     * Every address the store has, a kind at a time (pages, categories, products, blog), each with whether the sitemap lists it, its priority and how often it is said to change. This is the file the store serves at `/sitemap.xml`.
     *
     * Needs the `seo.read` permission (Read Search Settings).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     url: string,
     *     served: bool,
     *     total: int|float,
     *     listed: int|float,
     *     priorities: list<string>,
     *     frequencies: list<string>,
     *     kinds: list<array{
     *         id: string,
     *         listed: bool,
     *         priority: string,
     *         changefreq: string,
     *         entries: list<array{
     *             ref: string,
     *             name: string,
     *             path: string,
     *             changed: string,
     *             on: bool,
     *             priority: string,
     *             changefreq: string
     *         }>
     *     }>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/sitemap/get-the-sitemap
     */
    public function show(array $options = []): mixed
    {
        return $this->caller->call('sitemap.show', [], [], $options);
    }

    /**
     * **Update a kind of address**
     *
     * Sets the rule for a whole kind. Every address of that kind that has no rule of its own follows it, and a kind that is not listed lists none of its addresses. Send any of the three. Answers the whole sitemap again.
     *
     * Needs the `seo.write` permission (Change Search Settings).
     *
     * Fields:
     *
     * - `listed`: Whether the sitemap lists it.
     * - `priority`: Its priority, from `0.1` to `1.0`.
     * - `changefreq`: How often it changes.
     *
     * @param string $kind The kind: `pages`, `categories`, `products` or `blog`.
     * @param array{
     *     listed?: bool,
     *     priority?: string,
     *     changefreq?: 'always'|'hourly'|'daily'|'weekly'|'monthly'|'yearly'|'never'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     url: string,
     *     served: bool,
     *     total: int|float,
     *     listed: int|float,
     *     priorities: list<string>,
     *     frequencies: list<string>,
     *     kinds: list<array{
     *         id: string,
     *         listed: bool,
     *         priority: string,
     *         changefreq: string,
     *         entries: list<array{
     *             ref: string,
     *             name: string,
     *             path: string,
     *             changed: string,
     *             on: bool,
     *             priority: string,
     *             changefreq: string
     *         }>
     *     }>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/sitemap/update-a-kind-of-address
     */
    public function updateKind(string $kind, array $params = [], array $options = []): mixed
    {
        return $this->caller->call('sitemap.updateKind', [$kind], $params, $options);
    }

    /**
     * **Update one address**
     *
     * Sets one address's own rule. An address set to what its kind says follows its kind again. Only an address the store has can be given a rule. Answers the whole sitemap again.
     *
     * Needs the `seo.write` permission (Change Search Settings).
     *
     * Fields:
     *
     * - `kind` (required): The kind the address is of.
     * - `ref` (required): Which address of that kind, as "Get the sitemap" names it.
     * - `listed`: Whether the sitemap lists it.
     * - `priority`: Its priority, from `0.1` to `1.0`.
     * - `changefreq`: How often it changes.
     *
     * @param array{
     *     kind: 'pages'|'categories'|'products'|'blog',
     *     ref: string,
     *     listed?: bool,
     *     priority?: string,
     *     changefreq?: 'always'|'hourly'|'daily'|'weekly'|'monthly'|'yearly'|'never'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/sitemap/update-one-address
     */
    public function updateEntry(array $params, array $options = []): mixed
    {
        return $this->caller->call('sitemap.updateEntry', [], $params, $options);
    }
}
