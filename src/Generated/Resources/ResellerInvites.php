<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class ResellerInvites
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List invite links**
     *
     * The links a business joins the panel by, the newest first, each with its `code` (the link is `meta.joinAddress` followed by it), the tier it starts them in, how many have joined through it (`uses`) and how many may, when it ends, whether it is switched on (`enabled`) and whether it can still be used (`live`). `meta.limits` says how many may be live at once on the store's plan, and how many are.
     *
     * Needs the `resellers.read` permission (Read Resellers).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     name: string,
     *     code: string,
     *     tierId: string,
     *     tierName: string,
     *     maxUses: int|float,
     *     uses: int|float,
     *     endsAt: string,
     *     enabled: bool,
     *     live: bool
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/list-invite-links
     */
    public function list(array $options = []): mixed
    {
        return $this->caller->call('resellerInvites.list', [], [], $options);
    }

    /**
     * **Create an invite link**
     *
     * Makes a link a business joins the panel by, with their website, an email address and a password, and no approval. Refused with `reseller_invite_limit` where the store's plan has as many on as it holds.
     *
     * Needs the `resellers.write` permission (Change Resellers).
     *
     * Fields:
     *
     * - `name`: What the link is called on the dashboard, up to 60 characters. Resellers never see it. Needed to make one.
     * - `tierId`: The tier whoever joins through it starts in. Empty or left out, none: they pay the Reseller Price.
     * - `maxUses`: How many may join through it, 1 to 100,000. Empty or left out, no limit.
     * - `endsAt`: When it stops working, as a date and time. Empty or left out, never.
     * - `enabled`: Whether it works. Left out, it is true.
     *
     * @param array{
     *     name?: string,
     *     tierId?: string,
     *     maxUses?: int,
     *     endsAt?: string,
     *     enabled?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     name: string,
     *     code: string,
     *     tierId: string,
     *     tierName: string,
     *     maxUses: int|float,
     *     uses: int|float,
     *     endsAt: mixed,
     *     enabled: bool,
     *     live: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/create-an-invite-link
     */
    public function create(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('resellerInvites.create', [], $params, $options);
    }

    /**
     * **Update an invite link**
     *
     * Only what is sent changes: send `enabled: false` to switch a link off. Its address stays the same.
     *
     * Needs the `resellers.write` permission (Change Resellers).
     *
     * Fields:
     *
     * - `name`: What the link is called on the dashboard, up to 60 characters. Resellers never see it. Needed to make one.
     * - `tierId`: The tier whoever joins through it starts in. Empty or left out, none: they pay the Reseller Price.
     * - `maxUses`: How many may join through it, 1 to 100,000. Empty or left out, no limit.
     * - `endsAt`: When it stops working, as a date and time. Empty or left out, never.
     * - `enabled`: Whether it works. Left out, it is true.
     *
     * @param string $inviteId The invite link.
     * @param array{
     *     name?: string,
     *     tierId?: string,
     *     maxUses?: int,
     *     endsAt?: string,
     *     enabled?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     name: string,
     *     code: string,
     *     tierId: string,
     *     tierName: string,
     *     maxUses: int|float,
     *     uses: int|float,
     *     endsAt: string,
     *     enabled: bool,
     *     live: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/update-an-invite-link
     */
    public function update(string $inviteId, array $params = [], array $options = []): mixed
    {
        return $this->caller->call('resellerInvites.update', [$inviteId], $params, $options);
    }

    /**
     * **Delete an invite link**
     *
     * Whoever joined through it stays a reseller; only the link goes. Answers the links that are left.
     *
     * Needs the `resellers.write` permission (Change Resellers).
     *
     * @param string $inviteId The invite link.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array<mixed>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/delete-an-invite-link
     */
    public function delete(string $inviteId, array $options = []): mixed
    {
        return $this->caller->call('resellerInvites.delete', [$inviteId], [], $options);
    }
}
