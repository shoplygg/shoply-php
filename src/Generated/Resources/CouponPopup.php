<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class CouponPopup
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **Get the coupon pop-up**
     *
     * The pop-up that offers visitors of the storefront a coupon. A store that never set one up reads back the defaults, switched off. `unusable` says why buyers are not being shown it when its coupon no longer works.
     *
     * Needs the `coupons.read` permission (Read Coupons).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     enabled: bool,
     *     couponId: string,
     *     coupon: mixed,
     *     title: string,
     *     message: string,
     *     buttonText: string,
     *     opens: string,
     *     delaySeconds: int|float,
     *     frequency: string,
     *     updatedAt: mixed
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/coupon-pop-up/get-the-coupon-pop-up
     */
    public function show(array $options = []): mixed
    {
        return $this->caller->call('couponPopup.show', [], [], $options);
    }

    /**
     * **Update the coupon pop-up**
     *
     * Saves the pop-up whole. Switched off, it is saved as it is, finished or not. Switched on, it needs a title and a coupon buyers can use today.
     *
     * Needs the `coupons.write` permission (Change Coupons).
     *
     * Fields:
     *
     * - `enabled`: Whether the storefront shows it. Left out, it is false.
     * - `couponId`: The coupon it hands out.
     * - `title`: Its heading, up to 80 characters.
     * - `message`: The line under the heading, up to 240 characters.
     * - `buttonText`: What its button says, up to 30 characters.
     * - `opens`: After a wait, or when the visitor looks like leaving. Left out, it is "delay".
     * - `delaySeconds`: How long the wait is when `opens` is `delay`: 0 to 120 seconds. Left out, it is 5.
     * - `frequency`: How often one visitor sees it: on every page, once a visit, or once in that browser. Left out, it is "visit".
     *
     * @param array{
     *     enabled?: bool,
     *     couponId?: string,
     *     title?: string,
     *     message?: string,
     *     buttonText?: string,
     *     opens?: 'delay'|'leave',
     *     delaySeconds?: int,
     *     frequency?: 'page'|'visit'|'browser'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     enabled: bool,
     *     couponId: string,
     *     coupon: array{
     *         id: string,
     *         code: string,
     *         discountType: string,
     *         value: int|float,
     *         minSubtotal: int|float,
     *         expiresAt: mixed,
     *         appliesTo: string,
     *         unusable: string,
     *         pausedBySale: bool
     *     },
     *     title: string,
     *     message: string,
     *     buttonText: string,
     *     opens: string,
     *     delaySeconds: int|float,
     *     frequency: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/coupon-pop-up/update-the-coupon-pop-up
     */
    public function update(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('couponPopup.update', [], $params, $options);
    }
}
