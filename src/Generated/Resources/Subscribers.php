<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Subscribers
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **Get subscriber figures**
     *
     * `asking`, whether the checkout asks buyers "Email me news and offers", and `figures` for the period: `subscribed` now, `joined` in the period, `asked` (paid orders whose box was shown) and `rate` (the share of those ticked), `unsubscribed` in the period, and `sent`, the emails Cart Recovery and Win-Back sent in it.
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
     *     asking: bool,
     *     figures: array{
     *         subscribed: int|float,
     *         joined: int|float,
     *         asked: int|float,
     *         rate: int|float,
     *         unsubscribed: int|float,
     *         sent: int|float
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/email-marketing/get-subscriber-figures
     */
    public function summary(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('subscribers.summary', [], $params, $options);
    }

    /**
     * **Change asking at checkout**
     *
     * Whether the checkout shows buyers an unticked box above Pay, "Email me news and offers from" the store, on checkouts they start on the store, in the embed and in the Checkout Kit. Never on an invoice or a payment link. Switched off, nobody new subscribes, and everybody subscribed stays so.
     *
     * Needs the `marketing.write` permission (Change Email Marketing).
     *
     * Fields:
     *
     * - `on` (required): Ask, or not.
     *
     * @param array{
     *     on: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     asking: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/email-marketing/change-asking-at-checkout
     */
    public function asking(array $params, array $options = []): mixed
    {
        return $this->caller->call('subscribers.asking', [], $params, $options);
    }

    /**
     * **List subscribers**
     *
     * Who said yes to the store's news and offers, newest first, 25 a page: `subscribedAt`, `source` and `where` (the store's checkout, the embed or the Checkout Kit), `orderId` (the order whose box was ticked; they became a subscriber when it was paid), and for one who said no since, `unsubscribedAt` and `unsubscribedBy` (`email`, a link in an email; `seller`; `key`).
     *
     * Needs the `marketing.read` permission (Read Email Marketing).
     *
     * Fields:
     *
     * - `show`: Only these. Left out, it is "all".
     * - `search`: Part of an email address.
     * - `page`: Which page of the list. The first is 1. Left out, it is 1.
     *
     * @param array{
     *     show?: 'all'|'subscribed'|'unsubscribed',
     *     search?: string,
     *     page?: int
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\Page<array{
     *     email: string,
     *     customerId: string,
     *     subscribed: bool,
     *     subscribedAt: string,
     *     source: string,
     *     where: string,
     *     orderId: string,
     *     unsubscribedAt: mixed,
     *     unsubscribedBy: mixed
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/email-marketing/list-subscribers
     */
    public function list(array $params = [], array $options = []): \Shoply\Page
    {
        return $this->caller->call('subscribers.list', [], $params, $options);
    }

    /**
     * **Export subscribers**
     *
     * The subscribers the same filters would list, as a CSV file. Add `check=1` for `{ rows }`, how many it would have, which is not counted. A store exports at most 30 files every 10 minutes, every kind together, whoever asks: after that the answer is 429.
     *
     * Needs the `marketing.read` permission (Read Email Marketing). It is one of the heavier reads, and is counted against a smaller budget of its own: 60 a minute for each key.
     *
     * Fields:
     *
     * - `show`: Only these. Left out, it is "all".
     * - `search`: Part of an email address.
     * - `check`: `1` for how many rows the file would have, as `{ rows }`, in place of the file.
     *
     * @param array{
     *     show?: 'all'|'subscribed'|'unsubscribed',
     *     search?: string,
     *     check?: '1'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\File
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/email-marketing/export-subscribers
     */
    public function export(array $params = [], array $options = []): \Shoply\File
    {
        return $this->caller->call('subscribers.export', [], $params, $options);
    }

    /**
     * **Unsubscribe a subscriber**
     *
     * No more Win-Back to this address. They become a subscriber again only by ticking the box on another order they pay. 404 for an address that never said yes. Answers the subscriber.
     *
     * Needs the `marketing.write` permission (Change Email Marketing).
     *
     * Fields:
     *
     * - `email` (required): Their email address.
     *
     * @param array{
     *     email: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     email: string,
     *     customerId: mixed,
     *     subscribed: bool,
     *     subscribedAt: string,
     *     source: string,
     *     where: string,
     *     orderId: string,
     *     unsubscribedAt: string,
     *     unsubscribedBy: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/email-marketing/unsubscribe-a-subscriber
     */
    public function unsubscribe(array $params, array $options = []): mixed
    {
        return $this->caller->call('subscribers.unsubscribe', [], $params, $options);
    }
}
