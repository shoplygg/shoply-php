<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class FraudEvents
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List fraud events**
     *
     * What fraud protection did, newest first: the checkouts it refused and why, and every change to the blacklist and its settings. `meta.counts` says how many events of each reason the same filters match.
     *
     * Needs the `fraud.read` permission (Read Fraud Protection).
     *
     * Fields:
     *
     * - `page`: Which page of the list. The first is 1. Left out, it is 1.
     * - `perPage`: How many a page holds. Left out, it is 20.
     * - `reason`: Only events of this reason. `changes` is every change to the rules and settings.
     * - `search`: Part of an email address, an IP address or a rule's value.
     * - `range`: Only events in this period.
     * - `from`: Only events on or after this day, as `YYYY-MM-DD`. With `to`, in place of `range`.
     * - `to`: Only events on or before this day, as `YYYY-MM-DD`.
     * - `tz`: The time zone those days are in, as an IANA name. Left out, UTC.
     *
     * @param array{
     *     page?: int,
     *     perPage?: int,
     *     reason?: 'blacklist'|'vpn'|'country'|'unpaid_limit'|'dispute'|'refund'|'changes',
     *     search?: string,
     *     range?: 'today'|'yesterday'|'7d'|'30d'|'this_week'|'last_week'|'this_month'|'last_month'|'this_year',
     *     from?: string,
     *     to?: string,
     *     tz?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\Page<array{
     *     id: string,
     *     reason: string,
     *     orderId: mixed,
     *     email: string,
     *     ip: string,
     *     country: string,
     *     ruleId: mixed,
     *     ruleType: string,
     *     ruleValue: string,
     *     detail: string,
     *     attempts: int|float,
     *     by: array{
     *         name: string,
     *         email: string
     *     },
     *     dateCreated: string,
     *     lastAt: string,
     *     network: mixed
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/fraud-protection/list-fraud-events
     */
    public function list(array $params = [], array $options = []): \Shoply\Page
    {
        return $this->caller->call('fraudEvents.list', [], $params, $options);
    }

    /**
     * **Export fraud events**
     *
     * The events the same filters would list, as a CSV file, newest first: when each happened and how many attempts it gathered, what it was, the email, IP address, country and order, the rule it matched or the change that was made and by whom, and what a lookup of the address already knew (its provider and network, where it is, and whether it looked like a VPN, a data centre or a phone). Nothing is looked up to write the file: an address never looked up has those empty. Every event the filters match is in the file, however many: it is sent as it is read. Add `check=1` for `{ rows }`, how many it would have, which is not counted. A store exports at most 30 files every 10 minutes, orders, customers, fraud events and blacklist rules together, whoever asks: after that the answer is 429.
     *
     * Needs the `fraud.read` permission (Read Fraud Protection). It is one of the heavier reads, and is counted against a smaller budget of its own: 60 a minute for each key.
     *
     * Fields:
     *
     * - `reason`: Only events of this reason. `changes` is every change to the rules and settings.
     * - `search`: Part of an email address, an IP address or a rule's value.
     * - `check`: `1` for how many rows the file would have, as `{ rows }`, in place of the file. Not counted against the store's exports, and refused with 429 where none are left.
     * - `range`: Only events in this period.
     * - `from`: Only events on or after this day, as `YYYY-MM-DD`. With `to`, in place of `range`.
     * - `to`: Only events on or before this day, as `YYYY-MM-DD`.
     * - `tz`: The time zone those days are in, as an IANA name. Left out, UTC.
     *
     * @param array{
     *     reason?: 'blacklist'|'vpn'|'country'|'unpaid_limit'|'dispute'|'refund'|'changes',
     *     search?: string,
     *     check?: '1',
     *     range?: 'today'|'yesterday'|'7d'|'30d'|'this_week'|'last_week'|'this_month'|'last_month'|'this_year',
     *     from?: string,
     *     to?: string,
     *     tz?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\File
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/fraud-protection/export-fraud-events
     */
    public function export(array $params = [], array $options = []): \Shoply\File
    {
        return $this->caller->call('fraudEvents.export', [], $params, $options);
    }

    /**
     * **Get a fraud event's network**
     *
     * What is known about the connection an event came from: its provider, and whether it looks like a VPN, a proxy or a data centre.
     *
     * Needs the `fraud.read` permission (Read Fraud Protection). It is one of the heavier reads, and is counted against a smaller budget of its own: 60 a minute for each key.
     *
     * @param string $eventId The event.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/fraud-protection/get-a-fraud-events-network
     */
    public function network(string $eventId, array $options = []): mixed
    {
        return $this->caller->call('fraudEvents.network', [$eventId], [], $options);
    }
}
