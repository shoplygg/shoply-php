<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class FraudSettings
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **Get fraud settings**
     *
     * What the store refuses before an order is made: VPNs and proxies, countries, and buyers who have disputed a payment.
     *
     * Needs the `fraud.read` permission (Read Fraud Protection).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     blockVpn: bool,
     *     blockOnDispute: bool,
     *     blockedCountries: array<mixed>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/fraud-protection/get-fraud-settings
     */
    public function show(array $options = []): mixed
    {
        return $this->caller->call('fraudSettings.show', [], [], $options);
    }

    /**
     * **Update fraud settings**
     *
     * Saves the two switches as they are sent. `blockedCountries` changes only when it is sent.
     *
     * Needs the `fraud.write` permission (Change Fraud Protection).
     *
     * Fields:
     *
     * - `blockVpn` (required): Whether checkouts from a VPN, a proxy or a data centre are refused.
     * - `blockOnDispute`: Whether a buyer who disputes a payment is blacklisted. Left out, it is true.
     * - `blockedCountries`: The countries checkouts are refused from, as two-letter codes. An empty list blocks none.
     *
     * @param array{
     *     blockVpn: bool,
     *     blockOnDispute?: bool,
     *     blockedCountries?: list<string>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     blockVpn: bool,
     *     blockOnDispute: bool,
     *     blockedCountries: list<string>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/fraud-protection/update-fraud-settings
     */
    public function update(array $params, array $options = []): mixed
    {
        return $this->caller->call('fraudSettings.update', [], $params, $options);
    }
}
