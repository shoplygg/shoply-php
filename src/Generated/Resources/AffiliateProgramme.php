<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class AffiliateProgramme
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **Get the affiliate programme**
     *
     * The programme's settings: whether it is on, the rates a new affiliate gets, and what an affiliate may do for themselves.
     *
     * Needs the `affiliates.read` permission (Read Affiliates).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     enabled: bool,
     *     defaultCommission: int|float,
     *     defaultDiscount: int|float,
     *     selfSignup: bool,
     *     ownLinks: bool,
     *     toStore: bool,
     *     payouts: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/affiliates/get-the-affiliate-programme
     */
    public function show(array $options = []): mixed
    {
        return $this->caller->call('affiliateProgramme.show', [], [], $options);
    }

    /**
     * **Update the affiliate programme**
     *
     * Changes the programme's settings. Only what is sent changes. Switched off, no link takes anything off or earns anything, and the customer panel says nothing of affiliates.
     *
     * Needs the `affiliates.write` permission (Change Affiliates).
     *
     * Fields:
     *
     * - `enabled`: Whether the programme is on.
     * - `defaultCommission`: The commission a new affiliate gets, in percent: above 0, up to 90.
     * - `defaultDiscount`: The discount a new affiliate's link gives buyers, in percent: 0 to 90.
     * - `selfSignup`: Whether a customer may join from the customer panel.
     * - `ownLinks`: Whether an affiliate may change the code their link ends in.
     * - `toStore`: Whether an affiliate may move commission to their store balance.
     * - `payouts`: Whether an affiliate may ask for a payout.
     *
     * @param array{
     *     enabled?: bool,
     *     defaultCommission?: int|float,
     *     defaultDiscount?: int|float,
     *     selfSignup?: bool,
     *     ownLinks?: bool,
     *     toStore?: bool,
     *     payouts?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     enabled: bool,
     *     defaultCommission: int|float,
     *     defaultDiscount: int|float,
     *     selfSignup: bool,
     *     ownLinks: bool,
     *     toStore: bool,
     *     payouts: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/affiliates/update-the-affiliate-programme
     */
    public function update(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('affiliateProgramme.update', [], $params, $options);
    }
}
