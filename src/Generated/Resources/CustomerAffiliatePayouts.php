<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class CustomerAffiliatePayouts
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **Ask for a payout**
     *
     * Asks the seller to pay the affiliate, where the store allows payouts. The amount comes off their affiliate balance now and goes back if the seller declines or the request is taken back. One at a time. Shoply moves no money: the seller pays it and marks it paid.
     *
     * Needs the buyer's token: `Authorization: Bearer shoply_ct_...`, from Sign in with the code.
     *
     * It is counted for the buyer's token: 30 changes in ten minutes.
     *
     * Fields:
     *
     * - `amount` (required): How much, in the store's currency, up to their affiliate balance.
     * - `details` (required): How they want to be paid, in their own words.
     *
     * @param array{
     *     amount: int|float,
     *     details: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     member: bool,
     *     canJoin: bool,
     *     offered: array{
     *         commission: int|float,
     *         discount: int|float
     *     },
     *     active: bool,
     *     code: string,
     *     link: string,
     *     linkStart: string,
     *     commission: int|float,
     *     discount: int|float,
     *     clicks: int|float,
     *     orders: int|float,
     *     earned: array{
     *         amount: int|float,
     *         currencyCode: string
     *     },
     *     balance: array{
     *         amount: int|float,
     *         currencyCode: string
     *     },
     *     paidOut: array{
     *         amount: int|float,
     *         currencyCode: string
     *     },
     *     can: array{
     *         editLink: bool,
     *         toStore: bool,
     *         payouts: bool
     *     },
     *     payout: array{
     *         id: string,
     *         amount: int|float,
     *         currencyCode: string,
     *         details: string,
     *         status: string,
     *         note: string,
     *         dateRequested: string,
     *         dateResolved: mixed
     *     },
     *     payouts: list<array{
     *         id: string,
     *         amount: int|float,
     *         currencyCode: string,
     *         details: string,
     *         status: string,
     *         note: string,
     *         dateRequested: string,
     *         dateResolved: mixed
     *     }>,
     *     changes: list<array{
     *         id: string,
     *         kind: string,
     *         amount: int|float,
     *         balanceAfter: int|float,
     *         currencyCode: string,
     *         dateCreated: string
     *     }>,
     *     limits: array{
     *         codeMin: int|float,
     *         codeMax: int|float,
     *         details: int|float
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customer-api/ask-for-a-payout
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('customer.affiliate.payouts.create', [], $params, $options);
    }

    /**
     * **Take back a payout request**
     *
     * Takes back a request the seller has not answered, and puts its amount back on the affiliate balance. One already answered is `payout_answered`.
     *
     * Needs the buyer's token: `Authorization: Bearer shoply_ct_...`, from Sign in with the code.
     *
     * It is counted for the buyer's token: 30 changes in ten minutes.
     *
     * @param string $payoutId The waiting request, `payout` on the affiliate page.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     member: bool,
     *     canJoin: bool,
     *     offered: array{
     *         commission: int|float,
     *         discount: int|float
     *     },
     *     active: bool,
     *     code: string,
     *     link: string,
     *     linkStart: string,
     *     commission: int|float,
     *     discount: int|float,
     *     clicks: int|float,
     *     orders: int|float,
     *     earned: array{
     *         amount: int|float,
     *         currencyCode: string
     *     },
     *     balance: array{
     *         amount: int|float,
     *         currencyCode: string
     *     },
     *     paidOut: array{
     *         amount: int|float,
     *         currencyCode: string
     *     },
     *     can: array{
     *         editLink: bool,
     *         toStore: bool,
     *         payouts: bool
     *     },
     *     payout: mixed,
     *     payouts: list<array{
     *         id: string,
     *         amount: int|float,
     *         currencyCode: string,
     *         details: string,
     *         status: string,
     *         note: string,
     *         dateRequested: string,
     *         dateResolved: string
     *     }>,
     *     changes: list<array{
     *         id: string,
     *         kind: string,
     *         amount: int|float,
     *         balanceAfter: int|float,
     *         currencyCode: string,
     *         dateCreated: string
     *     }>,
     *     limits: array{
     *         codeMin: int|float,
     *         codeMax: int|float,
     *         details: int|float
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customer-api/take-back-a-payout-request
     */
    public function cancel(string $payoutId, array $options = []): mixed
    {
        return $this->caller->call('customer.affiliate.payouts.cancel', [$payoutId], [], $options);
    }
}
