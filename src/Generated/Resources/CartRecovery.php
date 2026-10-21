<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class CartRecovery
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **Get Cart Recovery**
     *
     * Cart Recovery's settings as `data`. `meta.figures` is the period's four figures: what it recovered, the checkouts left and what was in them, the share of emailed carts recovered, and the emails sent with how many buyers clicked and unsubscribed, each with the period before. `meta.set` is false where the store has never set it up, `meta.sendable` whether the store can send email at all, and `meta.choices` the delays and discounts each setting may take.
     *
     * Needs the `recovery.read` permission (Read Cart Recovery).
     *
     * Fields:
     *
     * - `range`: The period. Left out, it is "30d".
     * - `from`: The first day of a period of your own, as `YYYY-MM-DD`. With `to`, in place of `range`.
     * - `to`: Its last day, as `YYYY-MM-DD`.
     * - `tz`: The time zone those days are in, as an IANA name. Left out, UTC.
     *
     * @param array{
     *     range?: 'today'|'yesterday'|'7d'|'30d'|'this_week'|'last_week'|'this_month'|'last_month'|'this_year',
     *     from?: string,
     *     to?: string,
     *     tz?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     enabled: bool,
     *     firstOn: bool,
     *     firstMinutes: int|float,
     *     firstSubject: string,
     *     declinedOn: bool,
     *     declinedMinutes: int|float,
     *     declinedSubject: string,
     *     secondOn: bool,
     *     secondMinutes: int|float,
     *     secondSubject: string,
     *     secondPercent: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/cart-recovery/get-cart-recovery
     */
    public function show(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('cartRecovery.show', [], $params, $options);
    }

    /**
     * **Change Cart Recovery**
     *
     * Changes the settings named and keeps the rest. Switching it on writes to nobody who left a checkout before: only checkouts started after it was switched on are followed. The first email goes out a while after the buyer left, or in its place the declined card email after a card was turned down; the second, later, carries a coupon made for that buyer, good for 48 hours. An empty subject is the email's own.
     *
     * Needs the `recovery.write` permission (Change Cart Recovery).
     *
     * Fields:
     *
     * - `enabled`: Whether Cart Recovery writes to buyers at all.
     * - `firstOn`: Whether the first email is sent.
     * - `firstMinutes`: Minutes after the buyer left. One of 30, 60, 120, 240.
     * - `firstSubject`: Its subject, up to 150 characters.
     * - `declinedOn`: Whether the declined card email takes the first one's place after a card was turned down.
     * - `declinedMinutes`: Minutes after the decline. One of 5, 15, 30, 60.
     * - `declinedSubject`: Its subject, up to 150 characters.
     * - `secondOn`: Whether the second email is sent.
     * - `secondMinutes`: Minutes after the buyer left. One of 720, 1200, 1440, 2880.
     * - `secondSubject`: Its subject, up to 150 characters.
     * - `secondPercent`: The percent off its coupon. One of 0, 5, 10, 15, 20, 25. 0 sends it with no coupon.
     *
     * @param array{
     *     enabled?: bool,
     *     firstOn?: bool,
     *     firstMinutes?: int,
     *     firstSubject?: string,
     *     declinedOn?: bool,
     *     declinedMinutes?: int,
     *     declinedSubject?: string,
     *     secondOn?: bool,
     *     secondMinutes?: int,
     *     secondSubject?: string,
     *     secondPercent?: int
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     enabled: bool,
     *     firstOn: bool,
     *     firstMinutes: int|float,
     *     firstSubject: string,
     *     declinedOn: bool,
     *     declinedMinutes: int|float,
     *     declinedSubject: string,
     *     secondOn: bool,
     *     secondMinutes: int|float,
     *     secondSubject: string,
     *     secondPercent: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/cart-recovery/change-cart-recovery
     */
    public function update(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('cartRecovery.update', [], $params, $options);
    }

    /**
     * **List carts**
     *
     * The checkouts buyers left in the period, newest first, 25 a page, each with where it stands. A cart's `id` is its checkout's order ID. `state` is `waiting` (its first email is to come, `note` says when), `not_emailed` (it will not be written to, `note` says why), `first`, `declined` or `second` (the email it last had), `recovered`, `unsubscribed`, or `stopped` (let go with nothing sent). `emailedAt` and `secondEmailAt` are when its emails went, `couponCode` the second email's coupon, `clickedAt` when a browser first opened its button, and `recoveredOrderId` and `recoveredAt` the order that paid: the cart's own, or the checkout its button opened.
     *
     * Needs the `recovery.read` permission (Read Cart Recovery).
     *
     * Fields:
     *
     * - `range`: The period. Left out, it is "30d".
     * - `from`: The first day of a period of your own, as `YYYY-MM-DD`. With `to`, in place of `range`.
     * - `to`: Its last day, as `YYYY-MM-DD`.
     * - `tz`: The time zone those days are in, as an IANA name. Left out, UTC.
     * - `show`: Only these. Left out, it is "all".
     * - `search`: Part of a buyer's email.
     * - `page`: Which page of the list. The first is 1. Left out, it is 1.
     *
     * @param array{
     *     range?: 'today'|'yesterday'|'7d'|'30d'|'this_week'|'last_week'|'this_month'|'last_month'|'this_year',
     *     from?: string,
     *     to?: string,
     *     tz?: string,
     *     show?: 'all'|'waiting'|'emailed'|'recovered'|'unsubscribed'|'clicked',
     *     search?: string,
     *     page?: int
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\Page<array{
     *     id: string,
     *     email: string,
     *     total: int|float,
     *     currency: string,
     *     what: string,
     *     leftAt: string,
     *     state: string,
     *     note: string,
     *     clickedAt: mixed,
     *     emailedAt: mixed,
     *     secondEmailAt: mixed,
     *     couponCode: mixed,
     *     recoveredOrderId: mixed,
     *     recoveredAt: mixed
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/cart-recovery/list-carts
     */
    public function carts(array $params = [], array $options = []): \Shoply\Page
    {
        return $this->caller->call('cartRecovery.carts', [], $params, $options);
    }

    /**
     * **Get a cart**
     *
     * One cart as "List carts" has it, whatever its period. What the `cart.` webhooks send.
     *
     * Needs the `recovery.read` permission (Read Cart Recovery).
     *
     * @param string $cartId The cart, by its checkout's order ID.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     email: string,
     *     total: int|float,
     *     currency: string,
     *     what: string,
     *     leftAt: string,
     *     state: string,
     *     note: string,
     *     clickedAt: mixed,
     *     emailedAt: mixed,
     *     secondEmailAt: mixed,
     *     couponCode: mixed,
     *     recoveredOrderId: mixed,
     *     recoveredAt: mixed
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/cart-recovery/get-a-cart
     */
    public function cart(string $cartId, array $options = []): mixed
    {
        return $this->caller->call('cartRecovery.cart', [$cartId], [], $options);
    }
}
