<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class CustomerAffiliate
{
    public readonly CustomerAffiliatePayouts $payouts;

    public function __construct(private readonly Caller $caller)
    {
        $this->payouts = new CustomerAffiliatePayouts($this->caller);
    }

    /**
     * **Get the affiliate page**
     *
     * The buyer as an affiliate of the store: their link and its code, their rates, clicks and orders, what they have earned, their affiliate balance, their payouts and its history, and what the store lets them do (`can`). One who is not an affiliate is answered `member: false` with what joining would give them, where the store lets buyers join. A store with no programme answers `no_programme`.
     *
     * Needs the buyer's token: `Authorization: Bearer shoply_ct_...`, from Sign in with the code.
     *
     * It is counted for the buyer's token: 300 reads in ten minutes.
     *
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
     *     payouts: array<mixed>,
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
     * @see https://docs.shoply.gg/api-reference/customer-api/get-the-affiliate-page
     */
    public function show(array $options = []): mixed
    {
        return $this->caller->call('customer.affiliate.show', [], [], $options);
    }

    /**
     * **Join the affiliate programme**
     *
     * Makes the buyer an affiliate at the store's own rates, with a link that works at once, where the store lets buyers join. Answers the affiliate page.
     *
     * Needs the buyer's token: `Authorization: Bearer shoply_ct_...`, from Sign in with the code.
     *
     * It is counted for the buyer's token: 30 changes in ten minutes.
     *
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
     *     payouts: array<mixed>,
     *     changes: array<mixed>,
     *     limits: array{
     *         codeMin: int|float,
     *         codeMax: int|float,
     *         details: int|float
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customer-api/join-the-affiliate-programme
     */
    public function join(array $options = []): mixed
    {
        return $this->caller->call('customer.affiliate.join', [], [], $options);
    }

    /**
     * **Change the link's code**
     *
     * What the affiliate's link ends in, where the store lets affiliates choose it. The old link stops working. Answers the affiliate page.
     *
     * Needs the buyer's token: `Authorization: Bearer shoply_ct_...`, from Sign in with the code.
     *
     * It is counted for the buyer's token: 30 changes in ten minutes.
     *
     * Fields:
     *
     * - `code` (required): What the link ends in: letters, digits and dashes, as long as `limits` on the affiliate page says. One affiliate a code in a store.
     *
     * @param array{
     *     code: string
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
     *     payout: mixed,
     *     payouts: array<mixed>,
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
     * @see https://docs.shoply.gg/api-reference/customer-api/change-the-links-code
     */
    public function link(array $params, array $options = []): mixed
    {
        return $this->caller->call('customer.affiliate.link', [], $params, $options);
    }

    /**
     * **Move commission to store balance**
     *
     * Moves commission from the affiliate balance to the buyer's store balance, to spend at checkout, where the store allows it.
     *
     * Needs the buyer's token: `Authorization: Bearer shoply_ct_...`, from Sign in with the code.
     *
     * It is counted for the buyer's token: 30 changes in ten minutes.
     *
     * Fields:
     *
     * - `amount` (required): How much, in the store's currency, up to their affiliate balance.
     *
     * @param array{
     *     amount: int|float
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
     * @see https://docs.shoply.gg/api-reference/customer-api/move-commission-to-store-balance
     */
    public function toStore(array $params, array $options = []): mixed
    {
        return $this->caller->call('customer.affiliate.toStore', [], $params, $options);
    }
}
