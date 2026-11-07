<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class ResellerTiers
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List tiers**
     *
     * The panel's tiers, each a discount off every Reseller Price, with how many resellers are in it. A reseller pays their own discount where they have one, else their tier's. `meta.limit` is how many tiers the store's plan holds.
     *
     * Needs the `resellers.read` permission (Read Resellers).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     name: string,
     *     discount: int|float,
     *     resellers: int|float,
     *     spent30: int|float
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/list-tiers
     */
    public function list(array $options = []): mixed
    {
        return $this->caller->call('resellerTiers.list', [], [], $options);
    }

    /**
     * **Create a tier**
     *
     * Adds a tier, up to as many as the store's plan holds. A name is used once a panel.
     *
     * Needs the `resellers.write` permission (Change Resellers).
     *
     * Fields:
     *
     * - `name` (required): What the tier is called, up to 40 characters.
     * - `discount` (required): What it takes off every Reseller Price, in percent: 0.01 to 99.99.
     *
     * @param array{
     *     name: string,
     *     discount: int|float
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     name: string,
     *     discount: int|float,
     *     resellers: int|float,
     *     spent30: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/create-a-tier
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('resellerTiers.create', [], $params, $options);
    }

    /**
     * **Update a tier**
     *
     * Saves the tier whole: its name and discount. Its resellers pay the new discount from their next purchase.
     *
     * Needs the `resellers.write` permission (Change Resellers).
     *
     * Fields:
     *
     * - `name` (required): What the tier is called, up to 40 characters.
     * - `discount` (required): What it takes off every Reseller Price, in percent: 0.01 to 99.99.
     *
     * @param string $tierId The tier.
     * @param array{
     *     name: string,
     *     discount: int|float
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     name: string,
     *     discount: int|float,
     *     resellers: int|float,
     *     spent30: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/update-a-tier
     */
    public function update(string $tierId, array $params, array $options = []): mixed
    {
        return $this->caller->call('resellerTiers.update', [$tierId], $params, $options);
    }

    /**
     * **Delete a tier**
     *
     * Its resellers and invite links are left in no tier, which is the Reseller Price. Answers the tiers that are left.
     *
     * Needs the `resellers.write` permission (Change Resellers).
     *
     * @param string $tierId The tier.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array<mixed>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/delete-a-tier
     */
    public function delete(string $tierId, array $options = []): mixed
    {
        return $this->caller->call('resellerTiers.delete', [$tierId], [], $options);
    }
}
