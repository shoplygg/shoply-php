<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Blacklist
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List blacklist rules**
     *
     * The store's blacklist, a page at a time. A buyer who matches a rule that is in force cannot start or pay for a checkout. A store holds up to 10,000 rules.
     *
     * Needs the `fraud.read` permission (Read Fraud Protection).
     *
     * Fields:
     *
     * - `page`: Which page of the list. The first is 1. Left out, it is 1.
     * - `perPage`: How many a page holds. Left out, it is 20.
     * - `status`: Only rules that are in force, or only ones switched off.
     * - `type`: Only rules of this type.
     * - `search`: Part of a rule's value or note.
     *
     * @param array{
     *     page?: int,
     *     perPage?: int,
     *     status?: 'enabled'|'disabled',
     *     type?: 'email'|'domain'|'ip'|'cidr'|'asn'|'isp'|'city',
     *     search?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\Page<array{
     *     id: string,
     *     type: string,
     *     value: string,
     *     label: string,
     *     note: string,
     *     enabled: bool,
     *     source: string,
     *     customerId: mixed,
     *     orderId: mixed,
     *     hits: int|float,
     *     lastHitAt: mixed,
     *     dateCreated: string,
     *     updatedAt: string
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/blacklist/list-blacklist-rules
     */
    public function list(array $params = [], array $options = []): \Shoply\Page
    {
        return $this->caller->call('blacklist.list', [], $params, $options);
    }

    /**
     * **Create a blacklist rule**
     *
     * Adds a rule. Something already on the blacklist is refused.
     *
     * Needs the `fraud.write` permission (Change Fraud Protection).
     *
     * Fields:
     *
     * - `type` (required): What the rule matches: an email address, an email domain, an IP address, a range of them (`cidr`), a network by its number (`asn`) or its provider's name (`isp`), or a city. Countries are blocked in the settings instead.
     * - `value` (required): What to match.
     * - `note`: Why, up to 500 characters.
     * - `enabled`: Whether the rule is in force. Left out, it is true.
     *
     * @param array{
     *     type: 'email'|'domain'|'ip'|'cidr'|'asn'|'isp'|'city',
     *     value: string,
     *     note?: string,
     *     enabled?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     type: string,
     *     value: string,
     *     label: string,
     *     note: string,
     *     enabled: bool,
     *     source: string,
     *     customerId: mixed,
     *     orderId: mixed,
     *     hits: int|float,
     *     lastHitAt: mixed,
     *     dateCreated: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/blacklist/create-a-blacklist-rule
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('blacklist.create', [], $params, $options);
    }

    /**
     * **Export blacklist rules**
     *
     * The rules the same filters would list, as a CSV file, newest first: each one's type, value and note, whether it is in force, when and how it was added, the customer or order it came from, and how many checkouts it has stopped. Every rule the filters match is in the file. Add `check=1` for `{ rows }`, how many it would have, which is not counted. A store exports at most 30 files every 10 minutes, orders, customers, fraud events and blacklist rules together, whoever asks: after that the answer is 429.
     *
     * Needs the `fraud.read` permission (Read Fraud Protection). It is one of the heavier reads, and is counted against a smaller budget of its own: 60 a minute for each key.
     *
     * Fields:
     *
     * - `status`: Only rules that are in force, or only ones switched off.
     * - `type`: Only rules of this type.
     * - `search`: Part of a rule's value or note.
     * - `check`: `1` for how many rows the file would have, as `{ rows }`, in place of the file. Not counted against the store's exports, and refused with 429 where none are left.
     *
     * @param array{
     *     status?: 'enabled'|'disabled',
     *     type?: 'email'|'domain'|'ip'|'cidr'|'asn'|'isp'|'city',
     *     search?: string,
     *     check?: '1'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\File
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/blacklist/export-blacklist-rules
     */
    public function export(array $params = [], array $options = []): \Shoply\File
    {
        return $this->caller->call('blacklist.export', [], $params, $options);
    }

    /**
     * **Update a blacklist rule**
     *
     * Saves the rule whole: send every field as it should be.
     *
     * Needs the `fraud.write` permission (Change Fraud Protection).
     *
     * Fields:
     *
     * - `type` (required): What the rule matches: an email address, an email domain, an IP address, a range of them (`cidr`), a network by its number (`asn`) or its provider's name (`isp`), or a city. Countries are blocked in the settings instead.
     * - `value` (required): What to match.
     * - `note`: Why, up to 500 characters.
     * - `enabled`: Whether the rule is in force. Left out, it is true.
     *
     * @param string $ruleId The rule.
     * @param array{
     *     type: 'email'|'domain'|'ip'|'cidr'|'asn'|'isp'|'city',
     *     value: string,
     *     note?: string,
     *     enabled?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     type: string,
     *     value: string,
     *     label: string,
     *     note: string,
     *     enabled: bool,
     *     source: string,
     *     customerId: mixed,
     *     orderId: mixed,
     *     hits: int|float,
     *     lastHitAt: mixed,
     *     dateCreated: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/blacklist/update-a-blacklist-rule
     */
    public function update(string $ruleId, array $params, array $options = []): mixed
    {
        return $this->caller->call('blacklist.update', [$ruleId], $params, $options);
    }

    /**
     * **Delete a blacklist rule**
     *
     * Removes the rule.
     *
     * Needs the `fraud.write` permission (Change Fraud Protection).
     *
     * @param string $ruleId The rule.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/blacklist/delete-a-blacklist-rule
     */
    public function delete(string $ruleId, array $options = []): mixed
    {
        return $this->caller->call('blacklist.delete', [$ruleId], [], $options);
    }

    /**
     * **Switch a blacklist rule on or off**
     *
     * Changes whether the rule is in force, without sending the rest of it.
     *
     * Needs the `fraud.write` permission (Change Fraud Protection).
     *
     * Fields:
     *
     * - `enabled` (required): Whether the rule is in force.
     *
     * @param string $ruleId The rule.
     * @param array{
     *     enabled: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     type: string,
     *     value: string,
     *     label: string,
     *     note: string,
     *     enabled: bool,
     *     source: string,
     *     customerId: mixed,
     *     orderId: mixed,
     *     hits: int|float,
     *     lastHitAt: mixed,
     *     dateCreated: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/blacklist/switch-a-blacklist-rule-on-or-off
     */
    public function setEnabled(string $ruleId, array $params, array $options = []): mixed
    {
        return $this->caller->call('blacklist.setEnabled', [$ruleId], $params, $options);
    }
}
