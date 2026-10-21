<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Coupons
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List coupons**
     *
     * The store's coupons, a page at a time, each with how often it has been used and what it has taken off. `meta.counts` says how many there are in each state.
     *
     * Needs the `coupons.read` permission (Read Coupons).
     *
     * Fields:
     *
     * - `page`: Which page of the list. The first is 1. Left out, it is 1.
     * - `perPage`: How many a page holds, up to 500. Left out, it is 20.
     * - `search`: Only coupons whose code contains this.
     * - `state`: Only coupons in this state.
     * - `categoryId`: Only coupons in this coupon category.
     *
     * @param array{
     *     page?: int,
     *     perPage?: int,
     *     search?: string,
     *     state?: 'active'|'inactive'|'expired',
     *     categoryId?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\Page<array{
     *     id: string,
     *     storeId: string,
     *     categoryId: string,
     *     code: string,
     *     discountType: string,
     *     value: int|float,
     *     maxUses: int|float,
     *     uses: int|float,
     *     remainingUses: int|float,
     *     minSubtotal: int|float,
     *     expiresAt: mixed,
     *     active: bool,
     *     appliesTo: string,
     *     targets: array<mixed>,
     *     sort: int|float,
     *     discountGiven: int|float,
     *     revenue: int|float,
     *     dateCreated: string,
     *     updatedAt: string
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/coupons/list-coupons
     */
    public function list(array $params = [], array $options = []): \Shoply\Page
    {
        return $this->caller->call('coupons.list', [], $params, $options);
    }

    /**
     * **Create a coupon**
     *
     * Adds a coupon. Its expiry cannot already have passed.
     *
     * Needs the `coupons.write` permission (Change Coupons).
     *
     * Fields:
     *
     * - `tz`: The time zone a bare date in `expiresAt` is read in, as an IANA name. Left out, UTC.
     * - `code` (required): What a buyer types. 3 to 64 letters, digits, hyphens or underscores, kept in capitals. One coupon a code in a store.
     * - `discountType`: A share of the order, or an amount in the store's currency. Left out, it is "percent".
     * - `value` (required): How much comes off: 1 to 100 for `percent`, an amount for `fixed`.
     * - `maxUses`: How many orders may use it. 0 is no limit. Left out, it is 0.
     * - `minSubtotal`: The smallest order it works on, before discounts. 0 is any order. Left out, it is 0.
     * - `expiresAt`: When it stops working: a date (`2026-12-31`, good to the end of that day) or a date and time. Empty is never.
     * - `active`: Whether buyers can use it. Left out, it is true.
     * - `categoryId`: The coupon category it is filed in. Left out, it goes in the store's Default category.
     * - `appliesTo`: Every product, or only the ones in `targets`. Left out, it is "all".
     * - `targets`: The products it works on when `appliesTo` is `some`. Each names a product, and optionally one variant of it.
     *
     * @param array{
     *     tz?: string,
     *     code: string,
     *     discountType?: 'percent'|'fixed',
     *     value: int|float,
     *     maxUses?: int,
     *     minSubtotal?: int|float,
     *     expiresAt?: string,
     *     active?: bool,
     *     categoryId?: string,
     *     appliesTo?: 'all'|'some',
     *     targets?: list<array{
     *         productId: string,
     *         variantId?: string
     *     }>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     storeId: string,
     *     categoryId: string,
     *     code: string,
     *     discountType: string,
     *     value: int|float,
     *     maxUses: int|float,
     *     uses: int|float,
     *     remainingUses: int|float,
     *     minSubtotal: int|float,
     *     expiresAt: mixed,
     *     active: bool,
     *     appliesTo: string,
     *     targets: array<mixed>,
     *     sort: int|float,
     *     discountGiven: int|float,
     *     revenue: int|float,
     *     dateCreated: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/coupons/create-a-coupon
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('coupons.create', [], $params, $options);
    }

    /**
     * **Update a coupon**
     *
     * Saves the coupon whole: send every field as it should be, not only what changed. A field left out goes back to its default. The exceptions are `appliesTo` and `targets`, which stay as they are when `appliesTo` is left out.
     *
     * Needs the `coupons.write` permission (Change Coupons).
     *
     * Fields:
     *
     * - `tz`: The time zone a bare date in `expiresAt` is read in, as an IANA name. Left out, UTC.
     * - `code` (required): What a buyer types. 3 to 64 letters, digits, hyphens or underscores, kept in capitals. One coupon a code in a store.
     * - `discountType`: A share of the order, or an amount in the store's currency. Left out, it is "percent".
     * - `value` (required): How much comes off: 1 to 100 for `percent`, an amount for `fixed`.
     * - `maxUses`: How many orders may use it. 0 is no limit. Left out, it is 0.
     * - `minSubtotal`: The smallest order it works on, before discounts. 0 is any order. Left out, it is 0.
     * - `expiresAt`: When it stops working: a date (`2026-12-31`, good to the end of that day) or a date and time. Empty is never.
     * - `active`: Whether buyers can use it. Left out, it is true.
     * - `categoryId`: The coupon category it is filed in. Left out, it goes in the store's Default category.
     * - `appliesTo`: Every product, or only the ones in `targets`. Left out, it is "all".
     * - `targets`: The products it works on when `appliesTo` is `some`. Each names a product, and optionally one variant of it.
     * - `expectedUpdatedAt`: The `updatedAt` you last read. Sent, the change is refused with `stale_write` if the record has changed since. Left out, it is saved whatever happened in between.
     *
     * @param string $couponId The coupon.
     * @param array{
     *     tz?: string,
     *     code: string,
     *     discountType?: 'percent'|'fixed',
     *     value: int|float,
     *     maxUses?: int,
     *     minSubtotal?: int|float,
     *     expiresAt?: string,
     *     active?: bool,
     *     categoryId?: string,
     *     appliesTo?: 'all'|'some',
     *     targets?: list<array{
     *         productId: string,
     *         variantId?: string
     *     }>,
     *     expectedUpdatedAt?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     storeId: string,
     *     categoryId: string,
     *     code: string,
     *     discountType: string,
     *     value: int|float,
     *     maxUses: int|float,
     *     uses: int|float,
     *     remainingUses: int|float,
     *     minSubtotal: int|float,
     *     expiresAt: mixed,
     *     active: bool,
     *     appliesTo: string,
     *     targets: array<mixed>,
     *     sort: int|float,
     *     discountGiven: int|float,
     *     revenue: int|float,
     *     dateCreated: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/coupons/update-a-coupon
     */
    public function update(string $couponId, array $params, array $options = []): mixed
    {
        return $this->caller->call('coupons.update', [$couponId], $params, $options);
    }

    /**
     * **Delete a coupon**
     *
     * Removes the coupon. Orders that used it keep the code they were placed with.
     *
     * Needs the `coupons.write` permission (Change Coupons).
     *
     * @param string $couponId The coupon.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     deleted: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/coupons/delete-a-coupon
     */
    public function delete(string $couponId, array $options = []): mixed
    {
        return $this->caller->call('coupons.delete', [$couponId], [], $options);
    }

    /**
     * **Sort coupons**
     *
     * Sets the order of the coupons in one coupon category. Send every coupon of that category, in the order they should be in.
     *
     * Needs the `coupons.write` permission (Change Coupons).
     *
     * Fields:
     *
     * - `categoryId`: The coupon category being sorted. Left out, the Default category.
     * - `couponIds` (required): The coupons' IDs in their new order.
     *
     * @param array{
     *     categoryId?: string,
     *     couponIds: list<string>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     reordered: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/coupons/sort-coupons
     */
    public function sort(array $params, array $options = []): mixed
    {
        return $this->caller->call('coupons.sort', [], $params, $options);
    }
}
