<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Sales
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List sales**
     *
     * Every sale the store has, newest first. A store holds up to 30, so the list is not paged.
     *
     * Needs the `sales.read` permission (Read Sales).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     name: string,
     *     enabled: bool,
     *     status: string,
     *     discountType: string,
     *     value: int|float,
     *     appliesTo: string,
     *     targets: array<mixed>,
     *     startsAt: string,
     *     endsAt: string,
     *     couponRule: string,
     *     exceptions: array<mixed>,
     *     showBar: bool,
     *     orders: int|float,
     *     revenue: int|float,
     *     dateCreated: string,
     *     updatedAt: string
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/sales/list-sales
     */
    public function list(array $options = []): mixed
    {
        return $this->caller->call('sales.list', [], [], $options);
    }

    /**
     * **Create a sale**
     *
     * Adds a sale. A store holds up to 30.
     *
     * Needs the `sales.write` permission (Change Sales).
     *
     * Fields:
     *
     * - `tz`: The time zone `startsAt` and `endsAt` are read in when they name none, as an IANA name. Left out, UTC.
     * - `name` (required): What the sale is called, up to 60 characters. Buyers see it on the storefront's countdown.
     * - `discountType`: A share of each price, or an amount in the store's currency. Left out, it is "percent".
     * - `value` (required): How much comes off: above 0 and up to 100 for `percent`, an amount with at most 2 decimals for `fixed`.
     * - `appliesTo`: Every product, or only the ones in `targets`. Left out, it is "all".
     * - `targets`: The products on sale when `appliesTo` is `some`. Each names a product, and optionally one variant of it.
     * - `startsAt` (required): When it starts, as a date and time.
     * - `endsAt` (required): When it ends, as a date and time. After `startsAt`, and not already past.
     * - `couponRule`: What coupons do while the sale runs. `rest`: a coupon counts only the items in the cart that are not on sale. `all`: coupons work on sale items too. `none`: no coupon works anywhere in the store. Left out, it is "rest".
     * - `exceptions`: Up to 100 coupons or coupon categories that `couponRule` is turned around for.
     * - `enabled`: Whether the sale runs when its time comes. Left out, it is true.
     * - `showBar`: Whether the storefront shows the sale's countdown bar. Left out, it is true.
     *
     * @param array{
     *     tz?: string,
     *     name: string,
     *     discountType?: 'percent'|'fixed',
     *     value: int|float,
     *     appliesTo?: 'all'|'some',
     *     targets?: list<array{
     *         productId: string,
     *         variantId?: string
     *     }>,
     *     startsAt: string,
     *     endsAt: string,
     *     couponRule?: 'rest'|'all'|'none',
     *     exceptions?: list<array{
     *         kind: 'coupon'|'category',
     *         id: string
     *     }>,
     *     enabled?: bool,
     *     showBar?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     name: string,
     *     enabled: bool,
     *     status: string,
     *     discountType: string,
     *     value: int|float,
     *     appliesTo: string,
     *     targets: array<mixed>,
     *     startsAt: string,
     *     endsAt: string,
     *     couponRule: string,
     *     exceptions: array<mixed>,
     *     showBar: bool,
     *     orders: int|float,
     *     revenue: int|float,
     *     dateCreated: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/sales/create-a-sale
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('sales.create', [], $params, $options);
    }

    /**
     * **Get a sale**
     *
     * One sale, with the products it covers and its coupon exceptions.
     *
     * Needs the `sales.read` permission (Read Sales).
     *
     * @param string $saleId The sale.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     name: string,
     *     enabled: bool,
     *     status: string,
     *     discountType: string,
     *     value: int|float,
     *     appliesTo: string,
     *     targets: array<mixed>,
     *     startsAt: string,
     *     endsAt: string,
     *     couponRule: string,
     *     exceptions: array<mixed>,
     *     showBar: bool,
     *     orders: int|float,
     *     revenue: int|float,
     *     dateCreated: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/sales/get-a-sale
     */
    public function show(string $saleId, array $options = []): mixed
    {
        return $this->caller->call('sales.show', [$saleId], [], $options);
    }

    /**
     * **Update a sale**
     *
     * Saves the sale whole: send every field as it should be, not only what changed.
     *
     * Needs the `sales.write` permission (Change Sales).
     *
     * Fields:
     *
     * - `tz`: The time zone `startsAt` and `endsAt` are read in when they name none, as an IANA name. Left out, UTC.
     * - `name` (required): What the sale is called, up to 60 characters. Buyers see it on the storefront's countdown.
     * - `discountType`: A share of each price, or an amount in the store's currency. Left out, it is "percent".
     * - `value` (required): How much comes off: above 0 and up to 100 for `percent`, an amount with at most 2 decimals for `fixed`.
     * - `appliesTo`: Every product, or only the ones in `targets`. Left out, it is "all".
     * - `targets`: The products on sale when `appliesTo` is `some`. Each names a product, and optionally one variant of it.
     * - `startsAt` (required): When it starts, as a date and time.
     * - `endsAt` (required): When it ends, as a date and time. After `startsAt`, and not already past.
     * - `couponRule`: What coupons do while the sale runs. `rest`: a coupon counts only the items in the cart that are not on sale. `all`: coupons work on sale items too. `none`: no coupon works anywhere in the store. Left out, it is "rest".
     * - `exceptions`: Up to 100 coupons or coupon categories that `couponRule` is turned around for.
     * - `enabled`: Whether the sale runs when its time comes. Left out, it is true.
     * - `showBar`: Whether the storefront shows the sale's countdown bar. Left out, it is true.
     *
     * @param string $saleId The sale.
     * @param array{
     *     tz?: string,
     *     name: string,
     *     discountType?: 'percent'|'fixed',
     *     value: int|float,
     *     appliesTo?: 'all'|'some',
     *     targets?: list<array{
     *         productId: string,
     *         variantId?: string
     *     }>,
     *     startsAt: string,
     *     endsAt: string,
     *     couponRule?: 'rest'|'all'|'none',
     *     exceptions?: list<array{
     *         kind: 'coupon'|'category',
     *         id: string
     *     }>,
     *     enabled?: bool,
     *     showBar?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/sales/update-a-sale
     */
    public function update(string $saleId, array $params, array $options = []): mixed
    {
        return $this->caller->call('sales.update', [$saleId], $params, $options);
    }

    /**
     * **Delete a sale**
     *
     * Removes the sale. Orders placed during it keep the prices they were charged.
     *
     * Needs the `sales.write` permission (Change Sales).
     *
     * @param string $saleId The sale.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     deleted: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/sales/delete-a-sale
     */
    public function delete(string $saleId, array $options = []): mixed
    {
        return $this->caller->call('sales.delete', [$saleId], [], $options);
    }

    /**
     * **Switch a sale on or off**
     *
     * Changes whether the sale runs, without sending the rest of it.
     *
     * Needs the `sales.write` permission (Change Sales).
     *
     * Fields:
     *
     * - `enabled` (required): Whether the sale runs when its time comes.
     *
     * @param string $saleId The sale.
     * @param array{
     *     enabled: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     name: string,
     *     enabled: bool,
     *     status: string,
     *     discountType: string,
     *     value: int|float,
     *     appliesTo: string,
     *     targets: array<mixed>,
     *     startsAt: string,
     *     endsAt: string,
     *     couponRule: string,
     *     exceptions: array<mixed>,
     *     showBar: bool,
     *     orders: int|float,
     *     revenue: int|float,
     *     dateCreated: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/sales/switch-a-sale-on-or-off
     */
    public function setEnabled(string $saleId, array $params, array $options = []): mixed
    {
        return $this->caller->call('sales.setEnabled', [$saleId], $params, $options);
    }
}
