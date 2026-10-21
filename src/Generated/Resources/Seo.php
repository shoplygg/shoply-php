<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Seo
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **Get search settings**
     *
     * The four things a store sets once for search: its site verification codes, whether AI crawlers are asked to stay away, whether search engines are told of changes, and where paid orders are sent in Google Analytics.
     *
     * Needs the `seo.read` permission (Read Search Settings).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     googleVerification: string,
     *     bingVerification: string,
     *     aiCrawlers: bool,
     *     indexNow: bool,
     *     analytics: array{
     *         measurementId: string,
     *         hasSecret: bool
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/search-settings/get-search-settings
     */
    public function show(array $options = []): mixed
    {
        return $this->caller->call('seo.show', [], [], $options);
    }

    /**
     * **Update search settings**
     *
     * Changes the store's search settings. Only what is sent changes.
     *
     * Needs the `seo.write` permission (Change Search Settings).
     *
     * Fields:
     *
     * - `googleVerification`: The code Google Search Console gives a site's owner, as the code or as the whole meta tag. Empty removes it.
     * - `bingVerification`: The same, from Bing Webmaster Tools.
     * - `aiCrawlers`: Whether AI crawlers may read the store. Off, the store's robots.txt asks each of them not to.
     * - `indexNow`: Whether search engines are told when a product, a post or a page changes.
     * - `measurementId`: The Google Analytics property paid orders are sent to, as `G-XXXXXXXXXX`. Empty stops sending them.
     * - `apiSecret`: That property's Measurement Protocol API secret. It is never answered back.
     *
     * @param array{
     *     googleVerification?: string,
     *     bingVerification?: string,
     *     aiCrawlers?: bool,
     *     indexNow?: bool,
     *     measurementId?: string,
     *     apiSecret?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     googleVerification: string,
     *     bingVerification: string,
     *     aiCrawlers: bool,
     *     indexNow: bool,
     *     analytics: array{
     *         measurementId: string,
     *         hasSecret: bool
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/search-settings/update-search-settings
     */
    public function update(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('seo.update', [], $params, $options);
    }
}
