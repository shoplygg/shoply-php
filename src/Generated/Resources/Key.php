<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Key
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **Get the current key**
     *
     * What the key in the request is: its name, the permissions it carries, the addresses it accepts, and the store it belongs to with that store's ID. Make this your first call. Every other address needs the store's ID, and `api` in the answer is where that store's routes begin.
     *
     * Any live key may ask it, whatever its permissions.
     *
     * Any live API key may call this, whatever its permissions.
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     key: array{
     *         id: string,
     *         name: string,
     *         prefix: string,
     *         scopes: list<string>,
     *         allowedIps: array<mixed>,
     *         allowedDomains: array<mixed>,
     *         expiresAt: mixed,
     *         expired: bool,
     *         createdAt: string,
     *         lastUsedAt: mixed,
     *         revokedAt: mixed
     *     },
     *     store: array{
     *         id: string,
     *         name: string,
     *         slug: string,
     *         url: string
     *     },
     *     api: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/api-key/get-the-current-key
     */
    public function show(array $options = []): mixed
    {
        return $this->caller->call('key.show', [], [], $options);
    }
}
