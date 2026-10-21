<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Subscriptions
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List subscriptions**
     *
     * The store's subscriptions, newest first, 25 a page. A subscription's `status` is `active`, `renewal_due` (its renewal is made and waits to be paid), `past_due` (the period ran out unpaid: it ends after the store's grace days), `paused`, `cancelling` (it ends when what was paid for runs out), `cancelled` or `expired`. `renewsWith` is the card kept for one paid through Stripe, NMI, Authorize.net, Tagada, Mollie, MONEI, Adyen or Square (`provider`, `name`, `label` once named, and `canChange`, whether its buyer may give another on Stripe's own page), and null for one renewed by email; `autoRenews` says whether its next renewal is charged to it by itself. `meta.figures` is what the dashboard shows over the list, `meta.attention` the past due ones, and `meta.plans` which options are sold as subscriptions.
     *
     * Needs the `subscriptions.read` permission (Read Subscriptions).
     *
     * Fields:
     *
     * - `page`: Which page of the list. The first is 1. Left out, it is 1.
     * - `show`: Only these: running and not cancelling, past due, paused, cancelling, or ended (cancelled and expired). Left out, it is "all".
     * - `variant`: Only subscriptions to this option, by its ID.
     * - `search`: Part of a buyer's email.
     *
     * @param array{
     *     page?: int,
     *     show?: 'all'|'active'|'attention'|'paused'|'cancelling'|'ended',
     *     variant?: string,
     *     search?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\Page<array{
     *     id: string,
     *     email: string,
     *     customerId: mixed,
     *     productId: string,
     *     variantId: string,
     *     productName: string,
     *     variantName: string,
     *     quantity: int|float,
     *     price: int|float,
     *     currency: string,
     *     every: int|float,
     *     unit: string,
     *     status: string,
     *     periodEnd: string,
     *     graceEnd: mixed,
     *     renewalOrderId: mixed,
     *     renewalUrl: mixed,
     *     firstOrderId: string,
     *     cycles: int|float,
     *     remindedAt: mixed,
     *     endedAt: mixed,
     *     revoked: bool,
     *     pausedAt: mixed,
     *     resumeAt: mixed,
     *     pausedBy: mixed,
     *     renewsWith: mixed,
     *     autoRenews: bool,
     *     chargeTried: int|float,
     *     chargeNextAt: mixed,
     *     createdAt: string
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/subscriptions/list-subscriptions
     */
    public function list(array $params = [], array $options = []): \Shoply\Page
    {
        return $this->caller->call('subscriptions.list', [], $params, $options);
    }

    /**
     * **Get subscription settings**
     *
     * What a buyer may do for themselves from their customer panel, when renewal reminders go, how long a past due one is kept, and whether an ended one's keys and files are taken back. `meta.plans` is the store's plans and `meta.limits` the ceilings each setting is held to.
     *
     * Needs the `subscriptions.read` permission (Read Subscriptions).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     cancelOn: bool,
     *     cancelMode: string,
     *     undoOn: bool,
     *     pauseOn: bool,
     *     pauseDays: int|float,
     *     pausesAYear: int|float,
     *     remindersOn: bool,
     *     reminderDays: list<int|float>,
     *     graceDays: int|float,
     *     revokeOn: bool,
     *     autoOn: bool,
     *     cardChangeOn: bool,
     *     chargeTries: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/subscriptions/get-subscription-settings
     */
    public function settings(array $options = []): mixed
    {
        return $this->caller->call('subscriptions.settings', [], [], $options);
    }

    /**
     * **Change subscription settings**
     *
     * Changes the settings named and keeps the rest. A change reaches every subscription from then on, the running ones included.
     *
     * Needs the `subscriptions.write` permission (Change Subscriptions).
     *
     * Fields:
     *
     * - `cancelOn`: Whether a buyer may cancel from their customer panel.
     * - `cancelMode`: When a buyer's cancellation takes effect: when what was paid for runs out, or straight away.
     * - `undoOn`: Whether a buyer may take a cancellation back before it takes effect.
     * - `pauseOn`: Whether a buyer may pause from their customer panel.
     * - `pauseDays`: The longest a buyer may pause for, from 1 to 365 days.
     * - `pausesAYear`: How many times in a year a buyer may pause, from 1 to 12.
     * - `remindersOn`: Whether the buyer is reminded before a renewal is due.
     * - `reminderDays`: How many days before it is due each reminder goes: up to 5, each from 1 to 30.
     * - `graceDays`: How long a renewal may go unpaid after the period runs out before the subscription ends, from 0 to 30 days.
     * - `revokeOn`: Whether an ended or paused subscription's keys and files are hidden from its buyer.
     * - `autoOn`: Whether a card paid with through Stripe, Authorize.net, Tagada, Mollie, MONEI, Adyen or Square, or through NMI where its Keep Cards for Subscriptions is on, is kept and each renewal charged to it by itself. Off, every renewal is paid by an emailed link.
     * - `cardChangeOn`: Whether a renewal a buyer pays by its link with another card keeps that card, and a buyer whose card is kept through Stripe may give another on Stripe's own page.
     * - `chargeTries`: How many times a declined card is tried, one a day while the grace days last, from 1 to 5.
     *
     * @param array{
     *     cancelOn?: bool,
     *     cancelMode?: 'end'|'now',
     *     undoOn?: bool,
     *     pauseOn?: bool,
     *     pauseDays?: int,
     *     pausesAYear?: int,
     *     remindersOn?: bool,
     *     reminderDays?: list<int>,
     *     graceDays?: int,
     *     revokeOn?: bool,
     *     autoOn?: bool,
     *     cardChangeOn?: bool,
     *     chargeTries?: int
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     cancelOn: bool,
     *     cancelMode: string,
     *     undoOn: bool,
     *     pauseOn: bool,
     *     pauseDays: int|float,
     *     pausesAYear: int|float,
     *     remindersOn: bool,
     *     reminderDays: list<int|float>,
     *     graceDays: int|float,
     *     revokeOn: bool,
     *     autoOn: bool,
     *     cardChangeOn: bool,
     *     chargeTries: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/subscriptions/change-subscription-settings
     */
    public function updateSettings(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('subscriptions.updateSettings', [], $params, $options);
    }

    /**
     * **List subscription plans**
     *
     * Which of the store's options are sold as subscriptions, each with how often it renews and how many subscriptions to it are running. An option on this list is sold only as a subscription, and bought on its own.
     *
     * Needs the `subscriptions.read` permission (Read Subscriptions).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     variantId: string,
     *     productId: string,
     *     productName: string,
     *     variantName: string,
     *     price: int|float,
     *     every: int|float,
     *     unit: string,
     *     running: int|float,
     *     automatic: int|float
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/subscriptions/list-subscription-plans
     */
    public function plans(array $options = []): mixed
    {
        return $this->caller->call('subscriptions.plans', [], [], $options);
    }

    /**
     * **Sell options as subscriptions**
     *
     * Makes options subscriptions, or changes how often one renews. A change reaches new subscriptions only: a running one renews as it started. A store has up to 200 plans. The answer is every plan the store has.
     *
     * Needs the `subscriptions.write` permission (Change Subscriptions).
     *
     * Fields:
     *
     * - `items` (required): The options and how often each renews.
     *
     * @param array{
     *     items: list<array{
     *         variantId: string,
     *         every: int,
     *         unit: 'day'|'week'|'month'|'year'
     *     }>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     variantId: string,
     *     productId: string,
     *     productName: string,
     *     variantName: string,
     *     price: int|float,
     *     every: int|float,
     *     unit: string,
     *     running: int|float,
     *     automatic: int|float
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/subscriptions/sell-options-as-subscriptions
     */
    public function savePlans(array $params, array $options = []): mixed
    {
        return $this->caller->call('subscriptions.savePlans', [], $params, $options);
    }

    /**
     * **Sell an option once again**
     *
     * The option is sold once again from now on. Subscriptions already running to it go on renewing until they are cancelled. The answer is every plan left.
     *
     * Needs the `subscriptions.write` permission (Change Subscriptions).
     *
     * @param string $variantId The option.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array<mixed>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/subscriptions/sell-an-option-once-again
     */
    public function removePlan(string $variantId, array $options = []): mixed
    {
        return $this->caller->call('subscriptions.removePlan', [$variantId], [], $options);
    }

    /**
     * **Get a subscription**
     *
     * The subscription as `data`, with `meta.history` (what happened to it, newest first) and `meta.orders` (its first order and every renewal). An order's `subscriptionId` names the subscription it started or renewed.
     *
     * Needs the `subscriptions.read` permission (Read Subscriptions).
     *
     * @param string $subscriptionId The subscription.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     email: string,
     *     customerId: mixed,
     *     productId: string,
     *     variantId: string,
     *     productName: string,
     *     variantName: string,
     *     quantity: int|float,
     *     price: int|float,
     *     currency: string,
     *     every: int|float,
     *     unit: string,
     *     status: string,
     *     periodEnd: string,
     *     graceEnd: mixed,
     *     renewalOrderId: mixed,
     *     renewalUrl: mixed,
     *     firstOrderId: string,
     *     cycles: int|float,
     *     remindedAt: mixed,
     *     endedAt: mixed,
     *     revoked: bool,
     *     pausedAt: mixed,
     *     resumeAt: mixed,
     *     pausedBy: mixed,
     *     renewsWith: mixed,
     *     autoRenews: bool,
     *     chargeTried: int|float,
     *     chargeNextAt: mixed,
     *     createdAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/subscriptions/get-a-subscription
     */
    public function show(string $subscriptionId, array $options = []): mixed
    {
        return $this->caller->call('subscriptions.show', [$subscriptionId], [], $options);
    }

    /**
     * **Cancel a subscription**
     *
     * At the end of what was paid for, or straight away. A past due or paused one ends straight away whichever is asked. A renewal waiting to be paid is cancelled. Whatever the store lets its buyers do, the store may always cancel. The subscription as `data`, with `meta.history` (what happened to it, newest first) and `meta.orders` (its first order and every renewal).
     *
     * Needs the `subscriptions.write` permission (Change Subscriptions).
     *
     * Fields:
     *
     * - `when`: When it ends. Left out, it is "end".
     *
     * @param string $subscriptionId The subscription.
     * @param array{
     *     when?: 'end'|'now'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     email: string,
     *     customerId: mixed,
     *     productId: string,
     *     variantId: string,
     *     productName: string,
     *     variantName: string,
     *     quantity: int|float,
     *     price: int|float,
     *     currency: string,
     *     every: int|float,
     *     unit: string,
     *     status: string,
     *     periodEnd: string,
     *     graceEnd: mixed,
     *     renewalOrderId: mixed,
     *     renewalUrl: mixed,
     *     firstOrderId: string,
     *     cycles: int|float,
     *     remindedAt: mixed,
     *     endedAt: mixed,
     *     revoked: bool,
     *     pausedAt: mixed,
     *     resumeAt: mixed,
     *     pausedBy: mixed,
     *     renewsWith: mixed,
     *     autoRenews: bool,
     *     chargeTried: int|float,
     *     chargeNextAt: mixed,
     *     createdAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/subscriptions/cancel-a-subscription
     */
    public function cancel(string $subscriptionId, array $params = [], array $options = []): mixed
    {
        return $this->caller->call('subscriptions.cancel', [$subscriptionId], $params, $options);
    }

    /**
     * **Undo a cancellation**
     *
     * Takes back a cancellation that has not taken effect yet, so it renews again. Refused with 409 for one that has ended, or whose option was deleted. The subscription as `data`, with `meta.history` (what happened to it, newest first) and `meta.orders` (its first order and every renewal).
     *
     * Needs the `subscriptions.write` permission (Change Subscriptions).
     *
     * @param string $subscriptionId The subscription.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     email: string,
     *     customerId: mixed,
     *     productId: string,
     *     variantId: string,
     *     productName: string,
     *     variantName: string,
     *     quantity: int|float,
     *     price: int|float,
     *     currency: string,
     *     every: int|float,
     *     unit: string,
     *     status: string,
     *     periodEnd: string,
     *     graceEnd: mixed,
     *     renewalOrderId: mixed,
     *     renewalUrl: mixed,
     *     firstOrderId: string,
     *     cycles: int|float,
     *     remindedAt: mixed,
     *     endedAt: mixed,
     *     revoked: bool,
     *     pausedAt: mixed,
     *     resumeAt: mixed,
     *     pausedBy: mixed,
     *     renewsWith: mixed,
     *     autoRenews: bool,
     *     chargeTried: int|float,
     *     chargeNextAt: mixed,
     *     createdAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/subscriptions/undo-a-cancellation
     */
    public function undo(string $subscriptionId, array $options = []): mixed
    {
        return $this->caller->call('subscriptions.undo', [$subscriptionId], [], $options);
    }

    /**
     * **Pause a subscription**
     *
     * Starts at once: nothing renews, a renewal waiting to be paid is cancelled, and where the store takes access back its keys and files are hidden until it resumes. The days left of what was paid for are kept: it renews that much later. It resumes by itself after `days`. The buyer is emailed. The subscription as `data`, with `meta.history` (what happened to it, newest first) and `meta.orders` (its first order and every renewal).
     *
     * Needs the `subscriptions.write` permission (Change Subscriptions).
     *
     * Fields:
     *
     * - `days` (required): How long, from 1 to 365 days.
     *
     * @param string $subscriptionId The subscription.
     * @param array{
     *     days: int
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     email: string,
     *     customerId: mixed,
     *     productId: string,
     *     variantId: string,
     *     productName: string,
     *     variantName: string,
     *     quantity: int|float,
     *     price: int|float,
     *     currency: string,
     *     every: int|float,
     *     unit: string,
     *     status: string,
     *     periodEnd: string,
     *     graceEnd: mixed,
     *     renewalOrderId: mixed,
     *     renewalUrl: mixed,
     *     firstOrderId: string,
     *     cycles: int|float,
     *     remindedAt: mixed,
     *     endedAt: mixed,
     *     revoked: bool,
     *     pausedAt: string,
     *     resumeAt: string,
     *     pausedBy: string,
     *     renewsWith: mixed,
     *     autoRenews: bool,
     *     chargeTried: int|float,
     *     chargeNextAt: mixed,
     *     createdAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/subscriptions/pause-a-subscription
     */
    public function pause(string $subscriptionId, array $params, array $options = []): mixed
    {
        return $this->caller->call('subscriptions.pause', [$subscriptionId], $params, $options);
    }

    /**
     * **Resume a subscription**
     *
     * Ends a pause now, whoever paused it. Refused with 409 for one that is not paused. The subscription as `data`, with `meta.history` (what happened to it, newest first) and `meta.orders` (its first order and every renewal).
     *
     * Needs the `subscriptions.write` permission (Change Subscriptions).
     *
     * @param string $subscriptionId The subscription.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     email: string,
     *     customerId: mixed,
     *     productId: string,
     *     variantId: string,
     *     productName: string,
     *     variantName: string,
     *     quantity: int|float,
     *     price: int|float,
     *     currency: string,
     *     every: int|float,
     *     unit: string,
     *     status: string,
     *     periodEnd: string,
     *     graceEnd: mixed,
     *     renewalOrderId: mixed,
     *     renewalUrl: mixed,
     *     firstOrderId: string,
     *     cycles: int|float,
     *     remindedAt: mixed,
     *     endedAt: mixed,
     *     revoked: bool,
     *     pausedAt: mixed,
     *     resumeAt: mixed,
     *     pausedBy: mixed,
     *     renewsWith: mixed,
     *     autoRenews: bool,
     *     chargeTried: int|float,
     *     chargeNextAt: mixed,
     *     createdAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/subscriptions/resume-a-subscription
     */
    public function resume(string $subscriptionId, array $options = []): mixed
    {
        return $this->caller->call('subscriptions.resume', [$subscriptionId], [], $options);
    }

    /**
     * **Add free days**
     *
     * Moves its next renewal later by that many days, at no charge, and every renewal after it with it. The subscription as `data`, with `meta.history` (what happened to it, newest first) and `meta.orders` (its first order and every renewal).
     *
     * Needs the `subscriptions.write` permission (Change Subscriptions).
     *
     * Fields:
     *
     * - `days` (required): How many, from 1 to 365.
     *
     * @param string $subscriptionId The subscription.
     * @param array{
     *     days: int
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     email: string,
     *     customerId: mixed,
     *     productId: string,
     *     variantId: string,
     *     productName: string,
     *     variantName: string,
     *     quantity: int|float,
     *     price: int|float,
     *     currency: string,
     *     every: int|float,
     *     unit: string,
     *     status: string,
     *     periodEnd: string,
     *     graceEnd: mixed,
     *     renewalOrderId: mixed,
     *     renewalUrl: mixed,
     *     firstOrderId: string,
     *     cycles: int|float,
     *     remindedAt: mixed,
     *     endedAt: mixed,
     *     revoked: bool,
     *     pausedAt: mixed,
     *     resumeAt: mixed,
     *     pausedBy: mixed,
     *     renewsWith: mixed,
     *     autoRenews: bool,
     *     chargeTried: int|float,
     *     chargeNextAt: mixed,
     *     createdAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/subscriptions/add-free-days
     */
    public function addDays(string $subscriptionId, array $params, array $options = []): mixed
    {
        return $this->caller->call('subscriptions.addDays', [$subscriptionId], $params, $options);
    }

    /**
     * **Email the renewal again**
     *
     * Sends the buyer the link to pay their renewal again, for one whose renewal is waiting. Once an hour a subscription, and 20 every 10 minutes a store, whoever asks: after that the answer is 429. Refused with 409 where no renewal is waiting. The subscription as `data`, with `meta.history` (what happened to it, newest first) and `meta.orders` (its first order and every renewal).
     *
     * Needs the `subscriptions.write` permission (Change Subscriptions). It sends an email, and is counted against a budget of its own: 60 in ten minutes for each key.
     *
     * @param string $subscriptionId The subscription.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     email: string,
     *     customerId: mixed,
     *     productId: string,
     *     variantId: string,
     *     productName: string,
     *     variantName: string,
     *     quantity: int|float,
     *     price: int|float,
     *     currency: string,
     *     every: int|float,
     *     unit: string,
     *     status: string,
     *     periodEnd: string,
     *     graceEnd: mixed,
     *     renewalOrderId: string,
     *     renewalUrl: string,
     *     firstOrderId: string,
     *     cycles: int|float,
     *     remindedAt: string,
     *     endedAt: mixed,
     *     revoked: bool,
     *     pausedAt: mixed,
     *     resumeAt: mixed,
     *     pausedBy: mixed,
     *     renewsWith: mixed,
     *     autoRenews: bool,
     *     chargeTried: int|float,
     *     chargeNextAt: mixed,
     *     createdAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/subscriptions/email-the-renewal-again
     */
    public function email(string $subscriptionId, array $options = []): mixed
    {
        return $this->caller->call('subscriptions.email', [$subscriptionId], [], $options);
    }
}
