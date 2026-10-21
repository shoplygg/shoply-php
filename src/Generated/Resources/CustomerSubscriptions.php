<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class CustomerSubscriptions
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List subscriptions**
     *
     * The buyer's subscriptions at the store, with each one's renewal waiting to be paid, if any. `meta` says what the store lets a buyer do: cancel (and whether at once or when what was paid for runs out), undo a cancellation, pause and for how long, and give another card.
     *
     * Needs the buyer's token: `Authorization: Bearer shoply_ct_...`, from Sign in with the code.
     *
     * It is counted for the buyer's token: 300 reads in ten minutes.
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     email: string,
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
     *     endedAt: mixed,
     *     revoked: bool,
     *     pausedAt: mixed,
     *     resumeAt: mixed,
     *     pausedBy: mixed,
     *     renewsWith: mixed,
     *     autoRenews: bool,
     *     chargeTried: int|float,
     *     chargeNextAt: mixed,
     *     createdAt: string,
     *     pausesLeft: int|float
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customer-api/list-subscriptions
     */
    public function list(array $options = []): mixed
    {
        return $this->caller->call('customer.subscriptions.list', [], [], $options);
    }

    /**
     * **Cancel a subscription**
     *
     * As the store's setting says: when what was paid for runs out, or at once. Refused with `cancel_off` where the store does not let buyers cancel. Answers the list again.
     *
     * Needs the buyer's token: `Authorization: Bearer shoply_ct_...`, from Sign in with the code.
     *
     * It is counted for the buyer's token: 30 changes in ten minutes.
     *
     * @param string $subscriptionId One of the buyer's subscriptions, from List subscriptions.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     email: string,
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
     *     endedAt: mixed,
     *     revoked: bool,
     *     pausedAt: mixed,
     *     resumeAt: mixed,
     *     pausedBy: mixed,
     *     renewsWith: mixed,
     *     autoRenews: bool,
     *     chargeTried: int|float,
     *     chargeNextAt: mixed,
     *     createdAt: string,
     *     pausesLeft: int|float
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customer-api/cancel-a-subscription
     */
    public function cancel(string $subscriptionId, array $options = []): mixed
    {
        return $this->caller->call('customer.subscriptions.cancel', [$subscriptionId], [], $options);
    }

    /**
     * **Undo a cancellation**
     *
     * Keeps a subscription cancelled for the end of its period renewing, until that period runs out, where the store allows it (`undo_off`). Answers the list again.
     *
     * Needs the buyer's token: `Authorization: Bearer shoply_ct_...`, from Sign in with the code.
     *
     * It is counted for the buyer's token: 30 changes in ten minutes.
     *
     * @param string $subscriptionId One of the buyer's subscriptions, from List subscriptions.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     email: string,
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
     *     endedAt: mixed,
     *     revoked: bool,
     *     pausedAt: mixed,
     *     resumeAt: mixed,
     *     pausedBy: mixed,
     *     renewsWith: mixed,
     *     autoRenews: bool,
     *     chargeTried: int|float,
     *     chargeNextAt: mixed,
     *     createdAt: string,
     *     pausesLeft: int|float
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customer-api/undo-a-cancellation
     */
    public function undo(string $subscriptionId, array $options = []): mixed
    {
        return $this->caller->call('customer.subscriptions.undo', [$subscriptionId], [], $options);
    }

    /**
     * **Pause a subscription**
     *
     * Nothing renews until it resumes, and where the store takes access back its keys and files are hidden until then too. It resumes by itself after `days`, or sooner with Resume a subscription. Up to the store's longest pause, as often a year as it allows (`pausesLeft` on each subscription). Refused with `pause_off` where the store does not let buyers pause. Answers the list again.
     *
     * Needs the buyer's token: `Authorization: Bearer shoply_ct_...`, from Sign in with the code.
     *
     * It is counted for the buyer's token: 30 changes in ten minutes.
     *
     * Fields:
     *
     * - `days` (required): How long, from 1 to the store's longest pause (`pauseDays` in `meta`).
     *
     * @param string $subscriptionId One of the buyer's subscriptions, from List subscriptions.
     * @param array{
     *     days: int
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     email: string,
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
     *     endedAt: mixed,
     *     revoked: bool,
     *     pausedAt: string,
     *     resumeAt: string,
     *     pausedBy: string,
     *     renewsWith: mixed,
     *     autoRenews: bool,
     *     chargeTried: int|float,
     *     chargeNextAt: mixed,
     *     createdAt: string,
     *     pausesLeft: int|float
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customer-api/pause-a-subscription
     */
    public function pause(string $subscriptionId, array $params, array $options = []): mixed
    {
        return $this->caller->call('customer.subscriptions.pause', [$subscriptionId], $params, $options);
    }

    /**
     * **Resume a subscription**
     *
     * Ends a pause the buyer started, now. One the store paused is the store's to end. Answers the list again.
     *
     * Needs the buyer's token: `Authorization: Bearer shoply_ct_...`, from Sign in with the code.
     *
     * It is counted for the buyer's token: 30 changes in ten minutes.
     *
     * @param string $subscriptionId One of the buyer's subscriptions, from List subscriptions.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     email: string,
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
     *     endedAt: mixed,
     *     revoked: bool,
     *     pausedAt: mixed,
     *     resumeAt: mixed,
     *     pausedBy: mixed,
     *     renewsWith: mixed,
     *     autoRenews: bool,
     *     chargeTried: int|float,
     *     chargeNextAt: mixed,
     *     createdAt: string,
     *     pausesLeft: int|float
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customer-api/resume-a-subscription
     */
    public function resume(string $subscriptionId, array $options = []): mixed
    {
        return $this->caller->call('customer.subscriptions.resume', [$subscriptionId], [], $options);
    }

    /**
     * **Give another card**
     *
     * The address of Stripe's own page where the buyer gives another card for a subscription charged by itself, where the store allows it (`canChangeCard`). Send the buyer there. Once they are done, Stripe sends them back to the store's customer panel, which says whether the card was saved.
     *
     * Needs the buyer's token: `Authorization: Bearer shoply_ct_...`, from Sign in with the code.
     *
     * It is counted for the buyer's token: 30 changes in ten minutes.
     *
     * @param string $subscriptionId One of the buyer's subscriptions, from List subscriptions.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customer-api/give-another-card
     */
    public function card(string $subscriptionId, array $options = []): mixed
    {
        return $this->caller->call('customer.subscriptions.card', [$subscriptionId], [], $options);
    }
}
