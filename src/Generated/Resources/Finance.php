<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Finance
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **Get finance access**
     *
     * Whether the store may use Finance yet (`open`), and what its business details still lack if not (`missing`). They are set in the dashboard's settings.
     *
     * Needs the `finance.read` permission (Read Finance).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     open: bool,
     *     missing: array<mixed>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/finance/get-finance-access
     */
    public function access(array $options = []): mixed
    {
        return $this->caller->call('finance.access', [], [], $options);
    }

    /**
     * **Get profit**
     *
     * What the store kept in a period and how that is made up, beside the period before: net sales, the cost of goods, payment fees, affiliate commission, expenses and net profit, twelve months of sales and profit, and every product with what each variant sold and cost. A sale is what the buyer paid: at its sale price, after its coupon and any affiliate link's discount, without tax. Payment fees are worked out from the rates the store typed, never read from a provider, so they can be slightly off. A store makes at most 20 reports every 10 minutes, counting this one, the other report, their files and the dashboard's Generate Report together: after that the answer is 429. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `finance.read` permission (Read Finance). It is one of the heavier reads, and is counted against a smaller budget of its own: 60 a minute for each key.
     *
     * Fields:
     *
     * - `range`: The period. Left out, it is "this_month".
     * - `from`: The first day of a period of your own, as `YYYY-MM-DD`. With `to`, in place of `range`.
     * - `to`: Its last day, as `YYYY-MM-DD`.
     * - `tz`: The time zone those days are in, as an IANA name. Left out, UTC.
     *
     * @param array{
     *     range?: 'today'|'yesterday'|'7d'|'30d'|'this_week'|'last_week'|'this_month'|'last_month'|'this_year',
     *     from?: string,
     *     to?: string,
     *     tz?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     period: array{
     *         from: string,
     *         to: string,
     *         label: string,
     *         previousFrom: string,
     *         previousTo: string,
     *         previousLabel: string
     *     },
     *     currency: string,
     *     now: array{
     *         netSales: int|float,
     *         orders: int|float,
     *         costOfGoods: int|float,
     *         fees: int|float,
     *         commission: int|float,
     *         expenses: int|float,
     *         profit: int|float,
     *         margin: int|float,
     *         units: int|float,
     *         uncosted: int|float
     *     },
     *     previous: array{
     *         netSales: int|float,
     *         orders: int|float,
     *         costOfGoods: int|float,
     *         fees: int|float,
     *         commission: int|float,
     *         expenses: int|float,
     *         profit: int|float,
     *         margin: mixed,
     *         units: int|float,
     *         uncosted: int|float
     *     },
     *     perOrder: int|float,
     *     average: int|float,
     *     breakEven: array{
     *         orders: int|float,
     *         reachedOn: mixed,
     *         each: int|float
     *     },
     *     fees: array{
     *         rated: bool,
     *         unrated: list<string>
     *     },
     *     months: list<array{
     *         month: string,
     *         sales: int|float,
     *         profit: int|float
     *     }>,
     *     products: list<array{
     *         id: string,
     *         name: string,
     *         image: mixed,
     *         expenses: int|float,
     *         variants: list<array{
     *             id: string,
     *             label: string,
     *             price: int|float,
     *             costAmount: int|float,
     *             costPercent: mixed,
     *             sold: int|float,
     *             sales: int|float,
     *             cost: int|float,
     *             uncosted: int|float,
     *             profit: mixed
     *         }>,
     *         sold: int|float,
     *         sales: int|float,
     *         cost: int|float,
     *         uncosted: int|float,
     *         profit: mixed,
     *         costSet: string
     *     }>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/finance/get-profit
     */
    public function profit(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('finance.profit', [], $params, $options);
    }

    /**
     * **Get the books**
     *
     * The books for a period: the profit and loss line by line beside the period before, where the buyers were, and what each payment method took in. Gross sales are at the prices before any sale, and what sales, discounts, refunds and chargebacks took off is a line each; affiliate commission is a cost of sales. Tax collected is not income and is in none of it but the tax report. A store makes at most 20 reports every 10 minutes, counting this one, the other report, their files and the dashboard's Generate Report together: after that the answer is 429. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `finance.read` permission (Read Finance). It is one of the heavier reads, and is counted against a smaller budget of its own: 60 a minute for each key.
     *
     * Fields:
     *
     * - `range`: The period. Left out, it is "this_month".
     * - `from`: The first day of a period of your own, as `YYYY-MM-DD`. With `to`, in place of `range`.
     * - `to`: Its last day, as `YYYY-MM-DD`.
     * - `tz`: The time zone those days are in, as an IANA name. Left out, UTC.
     *
     * @param array{
     *     range?: 'today'|'yesterday'|'7d'|'30d'|'this_week'|'last_week'|'this_month'|'last_month'|'this_year',
     *     from?: string,
     *     to?: string,
     *     tz?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     period: array{
     *         from: string,
     *         to: string,
     *         label: string,
     *         previousFrom: string,
     *         previousTo: string,
     *         previousLabel: string
     *     },
     *     currency: string,
     *     business: list<string>,
     *     lines: list<array{
     *         kind: string,
     *         label: string
     *     }>,
     *     tax: array{
     *         now: int|float,
     *         previous: int|float
     *     },
     *     now: array{
     *         netSales: int|float,
     *         grossProfit: int|float,
     *         expenses: int|float,
     *         profit: int|float,
     *         margin: int|float
     *     },
     *     previous: array{
     *         netSales: int|float,
     *         grossProfit: int|float,
     *         expenses: int|float,
     *         profit: int|float,
     *         margin: mixed
     *     },
     *     checks: list<array{
     *         text: string,
     *         href: string,
     *         action: string
     *     }>,
     *     counts: array{
     *         orders: int|float,
     *         expenses: int|float
     *     },
     *     countries: list<array{
     *         country: string,
     *         name: string,
     *         orders: int|float,
     *         amount: int|float,
     *         share: int|float
     *     }>,
     *     methods: list<array{
     *         provider: string,
     *         name: string,
     *         orders: int|float,
     *         volume: int|float,
     *         fees: int|float,
     *         rated: bool,
     *         net: int|float
     *     }>,
     *     taxReport: array{
     *         rows: array<mixed>,
     *         taxable: int|float,
     *         tax: int|float
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/finance/get-the-books
     */
    public function accounting(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('finance.accounting', [], $params, $options);
    }

    /**
     * **Export the books**
     *
     * One of a period's files: `statement` (the profit and loss as a PDF, or as a CSV with `format=csv`), `countries`, `transactions` or `tax` (each a CSV), or `pack`, a ZIP of all of them with the expenses beside them. A store makes at most 20 reports every 10 minutes, counting this one, the other report, their files and the dashboard's Generate Report together: after that the answer is 429. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `finance.read` permission (Read Finance). It is one of the heavier reads, and is counted against a smaller budget of its own: 60 a minute for each key.
     *
     * Fields:
     *
     * - `range`: The period. Left out, it is "this_month".
     * - `from`: The first day of a period of your own, as `YYYY-MM-DD`. With `to`, in place of `range`.
     * - `to`: Its last day, as `YYYY-MM-DD`.
     * - `tz`: The time zone those days are in, as an IANA name. Left out, UTC.
     * - `format`: For `statement`: `csv` for a spreadsheet in place of the PDF.
     *
     * @param string $what Which file: `statement`, `countries`, `transactions`, `tax` or `pack`.
     * @param array{
     *     range?: 'today'|'yesterday'|'7d'|'30d'|'this_week'|'last_week'|'this_month'|'last_month'|'this_year',
     *     from?: string,
     *     to?: string,
     *     tz?: string,
     *     format?: 'csv'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\File
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/finance/export-the-books
     */
    public function export(string $what, array $params = [], array $options = []): \Shoply\File
    {
        return $this->caller->call('finance.export', [$what], $params, $options);
    }

    /**
     * **Set a variant's cost**
     *
     * What one sale of a variant costs the store, as an amount or as a share of what it sold for: what the buyer paid for it, after its sale price and discounts, without tax. Send neither to clear it. The cost is stamped onto each order line when the order is paid, so a later change does not rewrite old months. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `finance.write` permission (Change Finance).
     *
     * Fields:
     *
     * - `amount`: The cost of one, in the store's currency.
     * - `percent`: Or the cost as a percent of what each one sold for.
     * - `applyToPast`: Whether to give this cost to the lines already sold that have none. `past` in the answer says how many such lines there are. Left out, it is false.
     *
     * @param string $variantId The variant.
     * @param array{
     *     amount?: int|float,
     *     percent?: int|float,
     *     applyToPast?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     variantId: string,
     *     costAmount: int|float,
     *     costPercent: mixed,
     *     stamped: int|float,
     *     past: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/finance/set-a-variants-cost
     */
    public function setCost(string $variantId, array $params = [], array $options = []): mixed
    {
        return $this->caller->call('finance.setCost', [$variantId], $params, $options);
    }

    /**
     * **Get payment fee rates**
     *
     * The rate the store has typed for each payment provider: what that provider keeps of a payment, as a percent and a fixed amount. Profit takes payment fees from these. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `finance.read` permission (Read Finance).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     currency: string,
     *     rates: list<array{
     *         provider: string,
     *         name: string,
     *         percent: int|float,
     *         fixed: int|float
     *     }>,
     *     limits: array{
     *         percent: int|float,
     *         fixed: int|float
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/finance/get-payment-fee-rates
     */
    public function paymentCosts(array $options = []): mixed
    {
        return $this->caller->call('finance.paymentCosts', [], [], $options);
    }

    /**
     * **Set payment fee rates**
     *
     * Saves the rates for the providers named. A refusal names the provider and the field: `stripe.percent`. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `finance.write` permission (Change Finance).
     *
     * Fields:
     *
     * - `rates` (required): A rate a provider.
     *
     * @param array{
     *     rates: list<array{
     *         provider: string,
     *         percent?: int|float,
     *         fixed?: int|float
     *     }>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     provider: string,
     *     name: string,
     *     percent: int|float,
     *     fixed: int|float
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/finance/set-payment-fee-rates
     */
    public function setPaymentCosts(array $params, array $options = []): mixed
    {
        return $this->caller->call('finance.setPaymentCosts', [], $params, $options);
    }
}
