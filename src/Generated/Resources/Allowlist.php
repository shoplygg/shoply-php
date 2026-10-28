<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Allowlist
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List allowlist entries**
     *
     * The store's allowlist, a page at a time: the buyers and addresses its fraud rules always let through. A buyer who matches an entry in force is let past the blacklist, the store's blocked countries and its VPN rule, even where a rule names them. The limit on unpaid orders still applies. An email entry lets through anybody who types that address at a checkout; an IP address or range is the stronger of the two. `hits` is how many checkouts an entry let through that a rule would have stopped. A store holds up to 1,000 entries.
     *
     * Needs the `fraud.read` permission (Read Fraud Protection).
     *
     * Fields:
     *
     * - `page`: Which page of the list. The first is 1. Left out, it is 1.
     * - `perPage`: How many a page holds. Left out, it is 20.
     * - `status`: Only entries that are in force, or only ones switched off.
     * - `type`: Only entries of this type.
     * - `search`: Part of an entry's value or note.
     *
     * @param array{
     *     page?: int,
     *     perPage?: int,
     *     status?: 'enabled'|'disabled',
     *     type?: 'email'|'ip'|'cidr',
     *     search?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\Page<array{
     *     id: string,
     *     type: string,
     *     value: string,
     *     note: string,
     *     enabled: bool,
     *     source: string,
     *     customerId: mixed,
     *     hits: int|float,
     *     lastHitAt: mixed,
     *     dateCreated: string,
     *     updatedAt: string
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/allowlist/list-allowlist-entries
     */
    public function list(array $params = [], array $options = []): \Shoply\Page
    {
        return $this->caller->call('allowlist.list', [], $params, $options);
    }

    /**
     * **Create an allowlist entry**
     *
     * Adds an entry. Something already on the allowlist is refused, and so is a store's 1,001st (`allowlist_full`).
     *
     * Needs the `fraud.write` permission (Change Fraud Protection).
     *
     * Fields:
     *
     * - `type` (required): What the entry lets through: an email address, an IP address, or a range of them (`cidr`).
     * - `value` (required): What to match.
     * - `note`: Why, up to 500 characters.
     * - `enabled`: Whether the entry is in force. Left out, it is true.
     *
     * @param array{
     *     type: 'email'|'ip'|'cidr',
     *     value: string,
     *     note?: string,
     *     enabled?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     type: string,
     *     value: string,
     *     note: string,
     *     enabled: bool,
     *     source: string,
     *     customerId: mixed,
     *     hits: int|float,
     *     lastHitAt: mixed,
     *     dateCreated: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/allowlist/create-an-allowlist-entry
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('allowlist.create', [], $params, $options);
    }

    /**
     * **Export allowlist entries**
     *
     * The entries the same filters would list, as a CSV file, newest first: each one's type, value and note, whether it is in force, when and how it was added, and how many checkouts it has let through. Add `check=1` for `{ rows }`, how many it would have, which is not counted. A store exports at most 30 files every 10 minutes, orders, customers, fraud events, blacklist rules and allowlist entries together, whoever asks: after that the answer is 429.
     *
     * Needs the `fraud.read` permission (Read Fraud Protection). It is one of the heavier reads, and is counted against a smaller budget of its own: 60 a minute for each key.
     *
     * Fields:
     *
     * - `status`: Only entries that are in force, or only ones switched off.
     * - `type`: Only entries of this type.
     * - `search`: Part of an entry's value or note.
     * - `check`: `1` for how many rows the file would have, as `{ rows }`, in place of the file. Not counted against the store's exports, and refused with 429 where none are left.
     *
     * @param array{
     *     status?: 'enabled'|'disabled',
     *     type?: 'email'|'ip'|'cidr',
     *     search?: string,
     *     check?: '1'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\File
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/allowlist/export-allowlist-entries
     */
    public function export(array $params = [], array $options = []): \Shoply\File
    {
        return $this->caller->call('allowlist.export', [], $params, $options);
    }

    /**
     * **Update an allowlist entry**
     *
     * Saves the entry whole: send every field as it should be.
     *
     * Needs the `fraud.write` permission (Change Fraud Protection).
     *
     * Fields:
     *
     * - `type` (required): What the entry lets through: an email address, an IP address, or a range of them (`cidr`).
     * - `value` (required): What to match.
     * - `note`: Why, up to 500 characters.
     * - `enabled`: Whether the entry is in force. Left out, it is true.
     *
     * @param string $entryId The entry.
     * @param array{
     *     type: 'email'|'ip'|'cidr',
     *     value: string,
     *     note?: string,
     *     enabled?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     type: string,
     *     value: string,
     *     note: string,
     *     enabled: bool,
     *     source: string,
     *     customerId: mixed,
     *     hits: int|float,
     *     lastHitAt: mixed,
     *     dateCreated: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/allowlist/update-an-allowlist-entry
     */
    public function update(string $entryId, array $params, array $options = []): mixed
    {
        return $this->caller->call('allowlist.update', [$entryId], $params, $options);
    }

    /**
     * **Delete an allowlist entry**
     *
     * Removes the entry.
     *
     * Needs the `fraud.write` permission (Change Fraud Protection).
     *
     * @param string $entryId The entry.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/allowlist/delete-an-allowlist-entry
     */
    public function delete(string $entryId, array $options = []): mixed
    {
        return $this->caller->call('allowlist.delete', [$entryId], [], $options);
    }

    /**
     * **Switch an allowlist entry on or off**
     *
     * Changes whether the entry is in force, without sending the rest of it.
     *
     * Needs the `fraud.write` permission (Change Fraud Protection).
     *
     * Fields:
     *
     * - `enabled` (required): Whether the entry is in force.
     *
     * @param string $entryId The entry.
     * @param array{
     *     enabled: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     type: string,
     *     value: string,
     *     note: string,
     *     enabled: bool,
     *     source: string,
     *     customerId: mixed,
     *     hits: int|float,
     *     lastHitAt: mixed,
     *     dateCreated: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/allowlist/switch-an-allowlist-entry-on-or-off
     */
    public function setEnabled(string $entryId, array $params, array $options = []): mixed
    {
        return $this->caller->call('allowlist.setEnabled', [$entryId], $params, $options);
    }
}
