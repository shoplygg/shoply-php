<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class WinBack
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **Get Win-Back**
     *
     * Win-Back's settings as `data`. `meta.figures` is the period's four figures: the revenue it won back (and the period before's), subscribers and the share of buyers asked who said yes, the share of buyers emailed who came back, and the emails sent with how many buyers clicked and unsubscribed. `meta.set` is false where the store has never set it up, `meta.asking` whether the checkout asks buyers for leave, `meta.sendable` whether the store can send email at all, `meta.audiences` the tags it may be narrowed to, and `meta.choices` what each setting may take.
     *
     * Needs the `marketing.read` permission (Read Email Marketing).
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
     *     firstDays: int|float,
     *     firstSubject: string,
     *     secondOn: bool,
     *     secondDays: int|float,
     *     secondSubject: string,
     *     secondPercent: int|float,
     *     audience: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/email-marketing/get-win-back
     */
    public function show(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('winBack.show', [], $params, $options);
    }

    /**
     * **Change Win-Back**
     *
     * Changes the settings named and keeps the rest. Win-Back writes only to subscribers: buyers who ticked "Email me news and offers" at checkout on an order they paid, and have not said no since. The first email goes the set number of days after a buyer's last completed order, if they have not ordered since; the second, days after the first, carries a coupon made for that buyer, good for 7 days. A buyer with a dispute on record is not written to. Switching it on also switches on asking at checkout, and `meta.askingTurnedOn` says so. An empty subject is the email's own.
     *
     * Needs the `marketing.write` permission (Change Email Marketing).
     *
     * Fields:
     *
     * - `enabled`: Whether Win-Back writes to anybody.
     * - `firstOn`: Whether the first email is sent.
     * - `firstDays`: Days after a buyer's last order. One of 14, 21, 30, 45, 60, 90.
     * - `firstSubject`: Its subject, up to 150 characters.
     * - `secondOn`: Whether the second email is sent.
     * - `secondDays`: Days after the first. One of 3, 7, 14, 21, 30.
     * - `secondSubject`: Its subject, up to 150 characters.
     * - `secondPercent`: The percent off its coupon. One of 0, 5, 10, 15, 20, 25. 0 sends it with no coupon.
     * - `audience`: Who is written to: empty for every subscriber, `vip`, or the ID of one of the store's tags.
     *
     * @param array{
     *     enabled?: bool,
     *     firstOn?: bool,
     *     firstDays?: int,
     *     firstSubject?: string,
     *     secondOn?: bool,
     *     secondDays?: int,
     *     secondSubject?: string,
     *     secondPercent?: int,
     *     audience?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     enabled: bool,
     *     firstOn: bool,
     *     firstDays: int|float,
     *     firstSubject: string,
     *     secondOn: bool,
     *     secondDays: int|float,
     *     secondSubject: string,
     *     secondPercent: int|float,
     *     audience: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/email-marketing/change-win-back
     */
    public function update(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('winBack.update', [], $params, $options);
    }

    /**
     * **List Win-Back buyers**
     *
     * The buyers Win-Back has written to or will within 7 days, the latest to have moved first, 25 a page. A buyer is here once for each time they go quiet. `state` is `due` (`dueAt` says when its first email goes), `first` or `second` (the email it last had), `won` (they ordered within 14 days of an email: `wonOrderId`, `wonAt`, `wonAfter`, `quietDays`), `unsubscribed`, or `stopped` (`stopped` says why: `ordered`, `off`, `audience`, `disputed`, `failed`). `orders` and `spent` are their completed orders at the store, `tags` theirs as on Get a customer, `couponCode` and `couponExpiresAt` the second email's coupon, and `clickedAt` when a browser first opened an email's button.
     *
     * Needs the `marketing.read` permission (Read Email Marketing).
     *
     * Fields:
     *
     * - `show`: Only these. Left out, it is "all".
     * - `search`: Part of a buyer's email.
     * - `page`: Which page of the list. The first is 1. Left out, it is 1.
     *
     * @param array{
     *     show?: 'all'|'due'|'emailed'|'won'|'unsubscribed'|'clicked',
     *     search?: string,
     *     page?: int
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\Page<array{
     *     id: string,
     *     email: string,
     *     customerId: string,
     *     orders: int|float,
     *     spent: int|float,
     *     tags: array<mixed>,
     *     state: string,
     *     stopped: mixed,
     *     lastOrderId: string,
     *     lastOrderAt: string,
     *     what: string,
     *     nextStep: string,
     *     dueAt: string,
     *     emailedAt: mixed,
     *     secondEmailAt: mixed,
     *     clickedAt: mixed,
     *     couponCode: mixed,
     *     couponExpiresAt: mixed,
     *     wonOrderId: mixed,
     *     wonAt: mixed,
     *     wonAfter: mixed,
     *     quietDays: mixed,
     *     unsubscribedAt: mixed
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/email-marketing/list-win-back-buyers
     */
    public function buyers(array $params = [], array $options = []): \Shoply\Page
    {
        return $this->caller->call('winBack.buyers', [], $params, $options);
    }

    /**
     * **Get a Win-Back buyer**
     *
     * One buyer as "List Win-Back buyers" has them. What the `winback.` webhooks send.
     *
     * Needs the `marketing.read` permission (Read Email Marketing).
     *
     * @param string $buyerId The buyer's row, its `id` in the list.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     email: string,
     *     customerId: string,
     *     orders: int|float,
     *     spent: int|float,
     *     tags: array<mixed>,
     *     state: string,
     *     stopped: mixed,
     *     lastOrderId: string,
     *     lastOrderAt: string,
     *     what: string,
     *     nextStep: string,
     *     dueAt: string,
     *     emailedAt: mixed,
     *     secondEmailAt: mixed,
     *     clickedAt: mixed,
     *     couponCode: mixed,
     *     couponExpiresAt: mixed,
     *     wonOrderId: mixed,
     *     wonAt: mixed,
     *     wonAfter: mixed,
     *     quietDays: mixed,
     *     unsubscribedAt: mixed
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/email-marketing/get-a-win-back-buyer
     */
    public function buyer(string $buyerId, array $options = []): mixed
    {
        return $this->caller->call('winBack.buyer', [$buyerId], [], $options);
    }
}
