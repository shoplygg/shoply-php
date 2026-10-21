<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Upsells
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List upsells**
     *
     * Every upsell the store has, a kind at a time in the store's order, with the times each was shown, the paid orders that took it and what those lines came to over a period. A store holds up to 200.
     *
     * Needs the `upsells.read` permission (Read Upsells).
     *
     * Fields:
     *
     * - `range`: The period: `today`, `7d`, `30d`, `this_month`, `last_month`, `this_year`, `custom` with `from` and `to`, or `all`. Left out, it is "30d".
     * - `from`: With `range` `custom`: the first day, as YYYY-MM-DD.
     * - `to`: With `range` `custom`: the last day, as YYYY-MM-DD.
     * - `tz`: The time zone the days are read in, as an IANA name. Left out, UTC.
     *
     * @param array{
     *     range?: string,
     *     from?: string,
     *     to?: string,
     *     tz?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     kind: string,
     *     name: string,
     *     enabled: bool,
     *     sells: string,
     *     productId: mixed,
     *     variantId: mixed,
     *     productName: mixed,
     *     productImage: mixed,
     *     variantLabel: mixed,
     *     variantPrice: mixed,
     *     price: int|float,
     *     cost: mixed,
     *     message: string,
     *     offered: string,
     *     charged: string,
     *     trigger: string,
     *     minSubtotal: mixed,
     *     discountType: string,
     *     discountValue: int|float,
     *     words: string,
     *     startsAt: mixed,
     *     endsAt: mixed,
     *     firstOrders: bool,
     *     hideOwned: bool,
     *     targets: list<array{
     *         type: string,
     *         id: string,
     *         name: string
     *     }>,
     *     shown: int|float,
     *     taken: int|float,
     *     revenue: int|float,
     *     dateCreated: string,
     *     updatedAt: string
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/upsells/list-upsells
     */
    public function list(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('upsells.list', [], $params, $options);
    }

    /**
     * **Create an upsell**
     *
     * Adds an upsell of one kind. What it needs depends on the kind: see each field. A store holds up to 200.
     *
     * Needs the `upsells.write` permission (Change Upsells).
     *
     * Fields:
     *
     * - `tz`: The time zone `startsAt` and `endsAt` are read in when they name none, as an IANA name. Left out, UTC.
     * - `kind` (required): What kind of upsell it is. Set when it is made, and never changes.
     * - `name`: Up to 80 characters. An add-on that is a plain extra needs one: it is what the buyer reads.
     * - `sells`: An add-on only: a plain extra, or one of the store's products. Left out, it is "product".
     * - `productId`: What it sells, or for `together` what is shown. Not for a plain extra.
     * - `variantId`: Which of the product's variants. Optional for `together`.
     * - `price`: An add-on's price as an add-on, in the store's currency.
     * - `cost`: A plain extra's cost for one, for Finance.
     * - `message`: A plain extra's message to the buyer after payment, up to 2,000 characters.
     * - `offered`: An add-on: the buyer ticks it, it is ticked for them, or it is always in the order. Left out, it is "optional".
     * - `charged`: An add-on: once an order, or for each unit of its line. Left out, it is "order".
     * - `trigger`: A cart or checkout offer: what it asks for in the cart. Left out, it is "product".
     * - `minSubtotal`: With `trigger` `amount`: the cart total it asks for.
     * - `discountType`: A cart, checkout or upgrade offer: what it takes off its product, on that order only. Left out, it is "none".
     * - `discountValue`: How much: above 0 and up to 100 for `percent`, an amount for `amount`.
     * - `targets`: Up to 100. What an add-on is offered with (products or categories), what a cart or checkout offer asks for, what `together` is shown under and what an upgrade replaces (products).
     * - `words`: The line over it where the buyer meets it, up to 80 characters. Left out, the buyer's language's own words.
     * - `startsAt`: When it starts, as a date and time. Left out, now.
     * - `endsAt`: When it ends, as a date and time. Left out, never.
     * - `firstOrders`: A checkout offer only, since the checkout is where the buyer is known: offered only to a buyer who has never paid at the store. Left out, it is false.
     * - `hideOwned`: A checkout offer only: not offered to a buyer who has bought it before. Left out, it is false.
     * - `enabled`: Whether it is offered. Left out, it is true.
     *
     * @param array{
     *     tz?: string,
     *     kind: 'addon'|'cart'|'checkout'|'together'|'upgrade',
     *     name?: string,
     *     sells?: 'extra'|'product',
     *     productId?: string,
     *     variantId?: string,
     *     price?: int|float,
     *     cost?: int|float,
     *     message?: string,
     *     offered?: 'optional'|'ticked'|'included',
     *     charged?: 'order'|'item',
     *     trigger?: 'product'|'category'|'amount',
     *     minSubtotal?: int|float,
     *     discountType?: 'none'|'percent'|'amount',
     *     discountValue?: int|float,
     *     targets?: list<array{
     *         type: 'product'|'category',
     *         id: string
     *     }>,
     *     words?: string,
     *     startsAt?: string,
     *     endsAt?: string,
     *     firstOrders?: bool,
     *     hideOwned?: bool,
     *     enabled?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     kind: string,
     *     name: string,
     *     enabled: bool,
     *     sells: string,
     *     productId: mixed,
     *     variantId: mixed,
     *     productName: mixed,
     *     productImage: mixed,
     *     variantLabel: mixed,
     *     variantPrice: mixed,
     *     price: int|float,
     *     cost: mixed,
     *     message: string,
     *     offered: string,
     *     charged: string,
     *     trigger: string,
     *     minSubtotal: mixed,
     *     discountType: string,
     *     discountValue: int|float,
     *     words: string,
     *     startsAt: mixed,
     *     endsAt: mixed,
     *     firstOrders: bool,
     *     hideOwned: bool,
     *     targets: list<array{
     *         type: string,
     *         id: string,
     *         name: string
     *     }>,
     *     shown: int|float,
     *     taken: int|float,
     *     revenue: int|float,
     *     dateCreated: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/upsells/create-an-upsell
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('upsells.create', [], $params, $options);
    }

    /**
     * **Sort upsells**
     *
     * Puts one kind's upsells in a new order. The first that applies is the one shown where only one is.
     *
     * Needs the `upsells.write` permission (Change Upsells).
     *
     * Fields:
     *
     * - `kind` (required): Which kind.
     * - `ids` (required): Its upsells, in their new order.
     *
     * @param array{
     *     kind: 'addon'|'cart'|'checkout'|'together'|'upgrade',
     *     ids: list<string>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     sorted: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/upsells/sort-upsells
     */
    public function sort(array $params, array $options = []): mixed
    {
        return $this->caller->call('upsells.sort', [], $params, $options);
    }

    /**
     * **Change upsell settings**
     *
     * Whether a product's page also shows what the store's own orders most often have with it.
     *
     * Needs the `upsells.write` permission (Change Upsells).
     *
     * Fields:
     *
     * - `boughtTogetherAuto` (required): Whether what is bought together is worked out from the store's orders too.
     *
     * @param array{
     *     boughtTogetherAuto: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     boughtTogetherAuto: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/upsells/change-upsell-settings
     */
    public function settings(array $params, array $options = []): mixed
    {
        return $this->caller->call('upsells.settings', [], $params, $options);
    }

    /**
     * **Update an upsell**
     *
     * Saves the upsell whole: send every field as it should be, not only what changed. Its kind does not change.
     *
     * Needs the `upsells.write` permission (Change Upsells).
     *
     * Fields:
     *
     * - `tz`: The time zone `startsAt` and `endsAt` are read in when they name none, as an IANA name. Left out, UTC.
     * - `kind` (required): What kind of upsell it is. Set when it is made, and never changes.
     * - `name`: Up to 80 characters. An add-on that is a plain extra needs one: it is what the buyer reads.
     * - `sells`: An add-on only: a plain extra, or one of the store's products. Left out, it is "product".
     * - `productId`: What it sells, or for `together` what is shown. Not for a plain extra.
     * - `variantId`: Which of the product's variants. Optional for `together`.
     * - `price`: An add-on's price as an add-on, in the store's currency.
     * - `cost`: A plain extra's cost for one, for Finance.
     * - `message`: A plain extra's message to the buyer after payment, up to 2,000 characters.
     * - `offered`: An add-on: the buyer ticks it, it is ticked for them, or it is always in the order. Left out, it is "optional".
     * - `charged`: An add-on: once an order, or for each unit of its line. Left out, it is "order".
     * - `trigger`: A cart or checkout offer: what it asks for in the cart. Left out, it is "product".
     * - `minSubtotal`: With `trigger` `amount`: the cart total it asks for.
     * - `discountType`: A cart, checkout or upgrade offer: what it takes off its product, on that order only. Left out, it is "none".
     * - `discountValue`: How much: above 0 and up to 100 for `percent`, an amount for `amount`.
     * - `targets`: Up to 100. What an add-on is offered with (products or categories), what a cart or checkout offer asks for, what `together` is shown under and what an upgrade replaces (products).
     * - `words`: The line over it where the buyer meets it, up to 80 characters. Left out, the buyer's language's own words.
     * - `startsAt`: When it starts, as a date and time. Left out, now.
     * - `endsAt`: When it ends, as a date and time. Left out, never.
     * - `firstOrders`: A checkout offer only, since the checkout is where the buyer is known: offered only to a buyer who has never paid at the store. Left out, it is false.
     * - `hideOwned`: A checkout offer only: not offered to a buyer who has bought it before. Left out, it is false.
     * - `enabled`: Whether it is offered. Left out, it is true.
     *
     * @param string $upsellId The upsell.
     * @param array{
     *     tz?: string,
     *     kind: 'addon'|'cart'|'checkout'|'together'|'upgrade',
     *     name?: string,
     *     sells?: 'extra'|'product',
     *     productId?: string,
     *     variantId?: string,
     *     price?: int|float,
     *     cost?: int|float,
     *     message?: string,
     *     offered?: 'optional'|'ticked'|'included',
     *     charged?: 'order'|'item',
     *     trigger?: 'product'|'category'|'amount',
     *     minSubtotal?: int|float,
     *     discountType?: 'none'|'percent'|'amount',
     *     discountValue?: int|float,
     *     targets?: list<array{
     *         type: 'product'|'category',
     *         id: string
     *     }>,
     *     words?: string,
     *     startsAt?: string,
     *     endsAt?: string,
     *     firstOrders?: bool,
     *     hideOwned?: bool,
     *     enabled?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     kind: string,
     *     name: string,
     *     enabled: bool,
     *     sells: string,
     *     productId: mixed,
     *     variantId: mixed,
     *     productName: mixed,
     *     productImage: mixed,
     *     variantLabel: mixed,
     *     variantPrice: mixed,
     *     price: int|float,
     *     cost: mixed,
     *     message: string,
     *     offered: string,
     *     charged: string,
     *     trigger: string,
     *     minSubtotal: mixed,
     *     discountType: string,
     *     discountValue: int|float,
     *     words: string,
     *     startsAt: mixed,
     *     endsAt: mixed,
     *     firstOrders: bool,
     *     hideOwned: bool,
     *     targets: list<array{
     *         type: string,
     *         id: string,
     *         name: string
     *     }>,
     *     shown: int|float,
     *     taken: int|float,
     *     revenue: int|float,
     *     dateCreated: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/upsells/update-an-upsell
     */
    public function update(string $upsellId, array $params, array $options = []): mixed
    {
        return $this->caller->call('upsells.update', [$upsellId], $params, $options);
    }

    /**
     * **Delete an upsell**
     *
     * Removes the upsell. Orders that took it keep their lines as they were.
     *
     * Needs the `upsells.write` permission (Change Upsells).
     *
     * @param string $upsellId The upsell.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     deleted: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/upsells/delete-an-upsell
     */
    public function delete(string $upsellId, array $options = []): mixed
    {
        return $this->caller->call('upsells.delete', [$upsellId], [], $options);
    }

    /**
     * **Switch an upsell on or off**
     *
     * Changes whether the upsell is offered, without sending the rest of it.
     *
     * Needs the `upsells.write` permission (Change Upsells).
     *
     * Fields:
     *
     * - `enabled` (required): Whether it is offered.
     *
     * @param string $upsellId The upsell.
     * @param array{
     *     enabled: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     kind: string,
     *     name: string,
     *     enabled: bool,
     *     sells: string,
     *     productId: mixed,
     *     variantId: mixed,
     *     productName: mixed,
     *     productImage: mixed,
     *     variantLabel: mixed,
     *     variantPrice: mixed,
     *     price: int|float,
     *     cost: mixed,
     *     message: string,
     *     offered: string,
     *     charged: string,
     *     trigger: string,
     *     minSubtotal: mixed,
     *     discountType: string,
     *     discountValue: int|float,
     *     words: string,
     *     startsAt: mixed,
     *     endsAt: mixed,
     *     firstOrders: bool,
     *     hideOwned: bool,
     *     targets: list<array{
     *         type: string,
     *         id: string,
     *         name: string
     *     }>,
     *     shown: int|float,
     *     taken: int|float,
     *     revenue: int|float,
     *     dateCreated: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/upsells/switch-an-upsell-on-or-off
     */
    public function setEnabled(string $upsellId, array $params, array $options = []): mixed
    {
        return $this->caller->call('upsells.setEnabled', [$upsellId], $params, $options);
    }
}
