<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Resellers
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **Get the reseller overview**
     *
     * What the workspace's Overview shows: the panel (`panel`: whether it is on, its currency and smallest top-up), its address, the last 30 days' figures (`figures`: sales, orders and top-ups, and `balanceHeld`, every reseller's balance added up), what waits on the store (`waiting`, most pressing first: the panel off, nothing for sale, no invite link on, a product running out of keys) and the five resellers who spent most in 30 days (`top`). None of it is in the store's own figures: a reseller's purchases and top-ups are never its orders or revenue.
     *
     * Needs the `resellers.read` permission (Read Resellers). It is one of the heavier reads, and is counted against a smaller budget of its own: 60 a minute for each key.
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     panel: array{
     *         enabled: bool,
     *         currency: string,
     *         minTopup: int|float
     *     },
     *     address: string,
     *     figures: array{
     *         resellers: int|float,
     *         paused: int|float,
     *         sales30: int|float,
     *         orders30: int|float,
     *         topups30: int|float,
     *         topupCount30: int|float,
     *         balanceHeld: int|float
     *     },
     *     waiting: list<array{
     *         kind: string,
     *         line: string,
     *         hint: string,
     *         productId: string
     *     }>,
     *     top: list<array{
     *         id: string,
     *         name: string,
     *         website: string,
     *         email: string,
     *         tierId: string,
     *         tierName: string,
     *         tierDiscount: int|float,
     *         discount: mixed,
     *         paysOff: int|float,
     *         balance: int|float,
     *         status: string,
     *         members: int|float,
     *         spent30: int|float,
     *         lastOrderAt: string,
     *         joinedAt: string,
     *         removedAt: mixed
     *     }>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/get-the-reseller-overview
     */
    public function overview(array $options = []): mixed
    {
        return $this->caller->call('resellers.overview', [], [], $options);
    }

    /**
     * **Get the panel's settings**
     *
     * Whether the panel is on, its currency and its smallest top-up. `meta` has its addresses (`address`, its own domain once it is live; `shoplyAddress`, always its store's myshoply.gg one; `joinAddress`, what an invite link starts with), the invite links and tiers, `balanceHeld`, the bounds a smallest top-up is held to, and the currencies it can be in.
     *
     * Needs the `resellers.read` permission (Read Resellers).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     enabled: bool,
     *     currency: string,
     *     minTopup: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/get-the-panels-settings
     */
    public function settings(array $options = []): mixed
    {
        return $this->caller->call('resellers.settings', [], [], $options);
    }

    /**
     * **Update the panel's settings**
     *
     * Only what is sent changes. Switched off, nobody can join, sign in or buy, and every balance and order is kept. The currency changes only while every reseller's balance is zero.
     *
     * Needs the `resellers.write` permission (Change Resellers).
     *
     * Fields:
     *
     * - `enabled`: Whether the panel is on.
     * - `currency`: The currency its prices and balances are in, as a three-letter code.
     * - `minTopup`: The smallest top-up a reseller can make, 5.00 to 100,000.00.
     *
     * @param array{
     *     enabled?: bool,
     *     currency?: string,
     *     minTopup?: int|float
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     enabled: bool,
     *     currency: string,
     *     minTopup: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/update-the-panels-settings
     */
    public function updateSettings(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('resellers.updateSettings', [], $params, $options);
    }

    /**
     * **Get the panel's domain**
     *
     * The panel's own domain, if it has one, with where it stands (`status`, and `checks`: whether it points here, whether its TXT record has proved it the store's, and whether its certificate is issued), and `cnameTarget`. The panel has a domain of its own as the store does: point a CNAME record for it at `cnameTarget`, and it goes live once that is seen and its certificate is issued. Its store's myshoply.gg address answers too, always.
     *
     * Needs the `resellers.read` permission (Read Resellers).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     domain: mixed,
     *     cnameTarget: string,
     *     available: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/get-the-panels-domain
     */
    public function domain(array $options = []): mixed
    {
        return $this->caller->call('resellers.domain', [], [], $options);
    }

    /**
     * **Connect a domain to the panel**
     *
     * The panel has a domain of its own as the store does: point a CNAME record for it at `cnameTarget`, and it goes live once that is seen and its certificate is issued. Its store's myshoply.gg address answers too, always. A panel has one domain: remove it to connect another. Only a key the store's owner made can do this.
     *
     * Needs the `resellers.write` permission (Change Resellers). Only a key the store's owner made, or an app the owner connected, can call it: one made by somebody on the store's team is refused (`owner_only`).
     *
     * Fields:
     *
     * - `hostname` (required): The domain, with no `https://` in front.
     *
     * @param array{
     *     hostname: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/connect-a-domain-to-the-panel
     */
    public function connectDomain(array $params, array $options = []): mixed
    {
        return $this->caller->call('resellers.connectDomain', [], $params, $options);
    }

    /**
     * **Remove the panel's domain**
     *
     * Disconnects the panel's own domain. It goes on answering at its store's myshoply.gg address. Only a key the store's owner made can do this.
     *
     * Needs the `resellers.write` permission (Change Resellers). Only a key the store's owner made, or an app the owner connected, can call it: one made by somebody on the store's team is refused (`owner_only`).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/remove-the-panels-domain
     */
    public function removeDomain(array $options = []): mixed
    {
        return $this->caller->call('resellers.removeDomain', [], [], $options);
    }

    /**
     * **List resellers**
     *
     * Every reseller of the store, the newest first, but those removed: a business, by the website it joined with (`name`), with its owner's email address, its tier and its own discount (`paysOff` is what it pays off every Reseller Price), its `balance`, whether it is `active` or `paused`, how many are on its team, and what it spent in 30 days. `meta.limit` is how many resellers the store's plan holds, so the list is not paged.
     *
     * Needs the `resellers.read` permission (Read Resellers).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     name: string,
     *     website: string,
     *     email: string,
     *     tierId: mixed,
     *     tierName: mixed,
     *     tierDiscount: mixed,
     *     discount: mixed,
     *     paysOff: int|float,
     *     balance: int|float,
     *     status: string,
     *     members: int|float,
     *     spent30: int|float,
     *     lastOrderAt: mixed,
     *     joinedAt: string,
     *     removedAt: mixed
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/list-resellers
     */
    public function list(array $options = []): mixed
    {
        return $this->caller->call('resellers.list', [], [], $options);
    }

    /**
     * **Get a reseller**
     *
     * One reseller as the list has them, with the invite link they joined by (`inviteName`) and their `team`: each member's email address, whether they are its owner, and what they may do (`permissions`, from `catalogue`). `meta.history` is their balance line by line, the newest 50 first. A reseller the store removed is still answered, with `removedAt` and no team.
     *
     * Needs the `resellers.read` permission (Read Resellers).
     *
     * @param string $resellerId The reseller.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     name: string,
     *     website: string,
     *     email: string,
     *     tierId: string,
     *     tierName: string,
     *     tierDiscount: int|float,
     *     discount: mixed,
     *     paysOff: int|float,
     *     balance: int|float,
     *     status: string,
     *     members: int|float,
     *     spent30: int|float,
     *     lastOrderAt: string,
     *     joinedAt: string,
     *     removedAt: mixed,
     *     inviteName: mixed,
     *     team: list<array{
     *         id: string,
     *         email: string,
     *         owner: bool,
     *         permissions: list<string>,
     *         access: array{
     *             buy: bool,
     *             topup: bool,
     *             keys: bool,
     *             api: bool
     *         },
     *         twoFactor: bool,
     *         verified: bool,
     *         lastSeenAt: mixed,
     *         joinedAt: string
     *     }>,
     *     catalogue: list<array{
     *         id: string,
     *         label: string,
     *         permissions: list<array{
     *             key: string,
     *             label: string,
     *             about: string,
     *             needs: array<mixed>
     *         }>
     *     }>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/get-a-reseller
     */
    public function get(string $resellerId, array $options = []): mixed
    {
        return $this->caller->call('resellers.get', [$resellerId], [], $options);
    }

    /**
     * **Update a reseller**
     *
     * Only what is sent changes. A paused reseller signs in and reads their orders, and cannot buy or top up. Refused with `reseller_removed` for one the store removed.
     *
     * Needs the `resellers.write` permission (Change Resellers).
     *
     * Fields:
     *
     * - `tierId`: Their tier. Empty, none.
     * - `discount`: Their own discount off every Reseller Price, in percent, 0.01 to 99.99, in place of their tier's. Null or empty, none.
     * - `status`: Whether they can buy and top up.
     *
     * @param string $resellerId The reseller.
     * @param array{
     *     tierId?: string,
     *     discount?: int|float,
     *     status?: 'active'|'paused'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     name: string,
     *     website: string,
     *     email: string,
     *     tierId: string,
     *     tierName: string,
     *     tierDiscount: int|float,
     *     discount: mixed,
     *     paysOff: int|float,
     *     balance: int|float,
     *     status: string,
     *     members: int|float,
     *     spent30: int|float,
     *     lastOrderAt: mixed,
     *     joinedAt: string,
     *     removedAt: mixed,
     *     inviteName: mixed,
     *     team: list<array{
     *         id: string,
     *         email: string,
     *         owner: bool,
     *         permissions: list<string>,
     *         access: array{
     *             buy: bool,
     *             topup: bool,
     *             keys: bool,
     *             api: bool
     *         },
     *         twoFactor: bool,
     *         verified: bool,
     *         lastSeenAt: mixed,
     *         joinedAt: string
     *     }>,
     *     catalogue: list<array{
     *         id: string,
     *         label: string,
     *         permissions: list<array{
     *             key: string,
     *             label: string,
     *             about: string,
     *             needs: array<mixed>
     *         }>
     *     }>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/update-a-reseller
     */
    public function update(string $resellerId, array $params = [], array $options = []): mixed
    {
        return $this->caller->call('resellers.update', [$resellerId], $params, $options);
    }

    /**
     * **Remove a reseller**
     *
     * Removes a reseller from the store: their team can no longer sign in, and their API keys, delivery URLs and team invites are deleted. Their records are kept: their orders and top-ups stay in List reseller orders and List top-ups, and Get a reseller still answers them, with `removedAt` and their balance history. Refused with `reseller_has_balance` while they hold a balance: set it to zero first. A removed reseller is in no list of resellers, and does not count against the store's plan.
     *
     * Needs the `resellers.write` permission (Change Resellers).
     *
     * @param string $resellerId The reseller.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     removed: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/remove-a-reseller
     */
    public function delete(string $resellerId, array $options = []): mixed
    {
        return $this->caller->call('resellers.delete', [$resellerId], [], $options);
    }

    /**
     * **Change a reseller's balance**
     *
     * Adds to, takes from or sets a reseller's balance, which never goes below zero or past 1,000,000. Shoply moves no money: this is for what you settled with them yourself. The note is what they read in their own history. A removed reseller's balance does not move. Send an `Idempotency-Key` with this request.
     *
     * Needs the `resellers.balance` permission (Change Reseller Balances).
     *
     * Fields:
     *
     * - `mode` (required): Add to it, take from it, or set it to exactly this.
     * - `amount` (required): How much, in the panel's currency, with at most 2 decimals.
     * - `note`: Why, up to 500 characters. The reseller reads it.
     *
     * @param string $resellerId The reseller.
     * @param array{
     *     mode: 'add'|'subtract'|'set',
     *     amount: int|float,
     *     note?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     name: string,
     *     website: string,
     *     email: string,
     *     tierId: string,
     *     tierName: string,
     *     tierDiscount: int|float,
     *     discount: mixed,
     *     paysOff: int|float,
     *     balance: int|float,
     *     status: string,
     *     members: int|float,
     *     spent30: int|float,
     *     lastOrderAt: mixed,
     *     joinedAt: string,
     *     removedAt: mixed,
     *     inviteName: mixed,
     *     team: list<array{
     *         id: string,
     *         email: string,
     *         owner: bool,
     *         permissions: list<string>,
     *         access: array{
     *             buy: bool,
     *             topup: bool,
     *             keys: bool,
     *             api: bool
     *         },
     *         twoFactor: bool,
     *         verified: bool,
     *         lastSeenAt: mixed,
     *         joinedAt: string
     *     }>,
     *     catalogue: list<array{
     *         id: string,
     *         label: string,
     *         permissions: list<array{
     *             key: string,
     *             label: string,
     *             about: string,
     *             needs: array<mixed>
     *         }>
     *     }>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/change-a-resellers-balance
     */
    public function setBalance(string $resellerId, array $params, array $options = []): mixed
    {
        return $this->caller->call('resellers.setBalance', [$resellerId], $params, $options);
    }

    /**
     * **Change what a reseller's member may do**
     *
     * Saves a member's permissions whole. What a permission leans on is added with it. The team's owner can always do everything, so theirs is refused.
     *
     * Needs the `resellers.write` permission (Change Resellers).
     *
     * Fields:
     *
     * - `permissions` (required): What they may do, by name: `products.view`, `products.buy`, `orders.view`, `orders.keys`, `balance.view`, `balance.topup`, `api.keys`, `api.urls`, `team.view`, `team.manage`, `alerts.manage`.
     *
     * @param string $resellerId The reseller.
     * @param string $memberId The member, from the reseller's `team`.
     * @param array{
     *     permissions: list<string>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     name: string,
     *     website: string,
     *     email: string,
     *     tierId: string,
     *     tierName: string,
     *     tierDiscount: int|float,
     *     discount: mixed,
     *     paysOff: int|float,
     *     balance: int|float,
     *     status: string,
     *     members: int|float,
     *     spent30: int|float,
     *     lastOrderAt: mixed,
     *     joinedAt: string,
     *     removedAt: mixed,
     *     inviteName: mixed,
     *     team: list<array{
     *         id: string,
     *         email: string,
     *         owner: bool,
     *         permissions: list<string>,
     *         access: array{
     *             buy: bool,
     *             topup: bool,
     *             keys: bool,
     *             api: bool
     *         },
     *         twoFactor: bool,
     *         verified: bool,
     *         lastSeenAt: mixed,
     *         joinedAt: string
     *     }>,
     *     catalogue: list<array{
     *         id: string,
     *         label: string,
     *         permissions: list<array{
     *             key: string,
     *             label: string,
     *             about: string,
     *             needs: array<mixed>
     *         }>
     *     }>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/change-what-a-resellers-member-may-do
     */
    public function updateMember(string $resellerId, string $memberId, array $params, array $options = []): mixed
    {
        return $this->caller->call('resellers.updateMember', [$resellerId, $memberId], $params, $options);
    }

    /**
     * **Remove a reseller's member**
     *
     * Takes one person off a reseller's team. Their sessions and the API keys they made stop working. The team's owner cannot be removed.
     *
     * Needs the `resellers.write` permission (Change Resellers).
     *
     * @param string $resellerId The reseller.
     * @param string $memberId The member, from the reseller's `team`.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     name: string,
     *     website: string,
     *     email: string,
     *     tierId: string,
     *     tierName: string,
     *     tierDiscount: int|float,
     *     discount: mixed,
     *     paysOff: int|float,
     *     balance: int|float,
     *     status: string,
     *     members: int|float,
     *     spent30: int|float,
     *     lastOrderAt: string,
     *     joinedAt: string,
     *     removedAt: mixed,
     *     inviteName: mixed,
     *     team: list<array{
     *         id: string,
     *         email: string,
     *         owner: bool,
     *         permissions: list<string>,
     *         access: array{
     *             buy: bool,
     *             topup: bool,
     *             keys: bool,
     *             api: bool
     *         },
     *         twoFactor: bool,
     *         verified: bool,
     *         lastSeenAt: mixed,
     *         joinedAt: string
     *     }>,
     *     catalogue: list<array{
     *         id: string,
     *         label: string,
     *         permissions: list<array{
     *             key: string,
     *             label: string,
     *             about: string,
     *             needs: array<mixed>
     *         }>
     *     }>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/remove-a-resellers-member
     */
    public function removeMember(string $resellerId, string $memberId, array $options = []): mixed
    {
        return $this->caller->call('resellers.removeMember', [$resellerId, $memberId], [], $options);
    }
}
