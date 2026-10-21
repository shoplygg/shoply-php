<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Domain
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **Get the store's domain**
     *
     * The store's own domain, if it has connected one, with where it stands (`status`, and `checks`: whether it points here, whether its TXT record has proved it the store's, and whether its certificate is issued), and `cnameTarget`: what the domain's DNS record has to point at.
     *
     * Needs the `store.read` permission (Read Store).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     domain: mixed,
     *     cnameTarget: string,
     *     available: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/domain/get-the-stores-domain
     */
    public function show(array $options = []): mixed
    {
        return $this->caller->call('domain.show', [], [], $options);
    }

    /**
     * **Connect a domain**
     *
     * Connects a domain of the store's own. Point a CNAME record for it at `cnameTarget` and it goes live once that is seen and its certificate is issued. A store has one domain: remove it to connect another.
     *
     * Needs the `store.write` permission (Change Store).
     *
     * Fields:
     *
     * - `hostname` (required): The domain, with no `https://` in front.
     *
     * @param array{
     *     hostname: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/domain/connect-a-domain
     */
    public function connect(array $params, array $options = []): mixed
    {
        return $this->caller->call('domain.connect', [], $params, $options);
    }

    /**
     * **Remove the store's domain**
     *
     * Disconnects the store's own domain. The store goes on answering at its myshoply.gg address.
     *
     * Needs the `store.write` permission (Change Store).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/domain/remove-the-stores-domain
     */
    public function remove(array $options = []): mixed
    {
        return $this->caller->call('domain.remove', [], [], $options);
    }
}
