<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class BrokenLinks
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **Dismiss broken links**
     *
     * Takes one address off the list of broken links, or all of them when none is named. An address somebody asks for again is counted again.
     *
     * Needs the `seo.write` permission (Change Search Settings).
     *
     * Fields:
     *
     * - `path`: The one address to take off the list. Left out, the whole list is emptied.
     *
     * @param array{
     *     path?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array<mixed>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/redirects/dismiss-broken-links
     */
    public function dismiss(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('brokenLinks.dismiss', [], $params, $options);
    }
}
