<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Analytics
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **Get the overview**
     *
     * A period's headline figures (revenue, orders, customers and the rest), the same figures for the period before, and a day by day series. What the dashboard's home page draws.
     *
     * Needs the `analytics.read` permission (Read Analytics). It is one of the heavier reads, and is counted against a smaller budget of its own: 60 a minute for each key.
     *
     * Fields:
     *
     * - `range`: The period. Left out, it is "30d".
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
     *     store: array{
     *         id: string,
     *         name: string,
     *         slug: string
     *     },
     *     range: array{
     *         preset: string,
     *         from: string,
     *         to: string,
     *         days: int|float,
     *         timezone: string,
     *         inProgress: bool
     *     },
     *     currencyCode: string,
     *     totals: array{
     *         revenue: int|float,
     *         orders: int|float,
     *         completedOrders: int|float,
     *         newCustomers: int|float,
     *         averageOrderValue: int|float,
     *         visitors: int|float,
     *         conversionRate: int|float,
     *         recovered: array{
     *             revenue: int|float,
     *             orders: int|float
     *         }
     *     },
     *     previous: array{
     *         revenue: int|float,
     *         orders: int|float,
     *         newCustomers: int|float,
     *         averageOrderValue: int|float,
     *         visitors: int|float,
     *         conversionRate: int|float
     *     },
     *     change: array{
     *         revenue: mixed,
     *         orders: mixed,
     *         newCustomers: mixed,
     *         averageOrderValue: mixed,
     *         visitors: mixed,
     *         conversionRate: mixed
     *     },
     *     funnel: list<array{
     *         key: string,
     *         count: int|float,
     *         previousCount: int|float,
     *         rate: int|float,
     *         previousRate: int|float,
     *         change: mixed
     *     }>,
     *     returningCustomers: array{
     *         customers: int|float,
     *         returning: int|float,
     *         rate: int|float,
     *         previous: array{
     *             customers: int|float,
     *             returning: int|float,
     *             rate: int|float
     *         },
     *         change: mixed
     *     },
     *     series: array{
     *         bucket: string,
     *         points: list<array{
     *             at: string,
     *             revenue: int|float,
     *             orders: int|float,
     *             previousAt: string,
     *             previousRevenue: int|float,
     *             previousOrders: int|float
     *         }>
     *     },
     *     customerSeries: array{
     *         bucket: string,
     *         points: list<array{
     *             at: string,
     *             customers: int|float,
     *             previousAt: string,
     *             previousCustomers: int|float
     *         }>
     *     },
     *     statusCounts: array{
     *         completed: int|float,
     *         pending: int|float,
     *         refunded: int|float,
     *         cancelled: int|float,
     *         chargeback: int|float
     *     },
     *     statusTotals: array{
     *         completed: array{
     *             orders: int|float,
     *             amount: int|float
     *         },
     *         pending: array{
     *             orders: int|float,
     *             amount: int|float
     *         },
     *         refunded: array{
     *             orders: int|float,
     *             amount: int|float
     *         },
     *         cancelled: array{
     *             orders: int|float,
     *             amount: int|float
     *         },
     *         chargeback: array{
     *             orders: int|float,
     *             amount: int|float
     *         }
     *     },
     *     week: list<list<int|float>>,
     *     topCountries: list<array{
     *         key: string,
     *         orders: int|float,
     *         revenue: int|float,
     *         share: int|float
     *     }>,
     *     topPaymentMethods: list<array{
     *         key: string,
     *         orders: int|float,
     *         revenue: int|float,
     *         share: int|float
     *     }>,
     *     topProducts: list<array{
     *         productName: string,
     *         units: int|float,
     *         orders: int|float,
     *         revenue: int|float
     *     }>,
     *     lifetime: array{
     *         products: int|float,
     *         orders: int|float,
     *         customers: int|float,
     *         categories: int|float
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/analytics/get-the-overview
     */
    public function overview(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('analytics.overview', [], $params, $options);
    }

    /**
     * **Get the visits report**
     *
     * A period's visits and what they went on to buy: visitors, where they came from by channel, website, campaign and affiliate, the pages they landed on, countries and devices. A sale is given to the last visit its buyer began before it, within 30 days. An order with no visit behind it (one made by hand, an invoice) counts in the totals and in none of the lists that say where sales came from.
     *
     * Needs the `analytics.read` permission (Read Analytics). It is one of the heavier reads, and is counted against a smaller budget of its own: 60 a minute for each key.
     *
     * Fields:
     *
     * - `range`: The period. Left out, it is "30d".
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
     *     store: array{
     *         id: string,
     *         name: string,
     *         slug: string
     *     },
     *     range: array{
     *         preset: string,
     *         from: string,
     *         to: string,
     *         days: int|float,
     *         timezone: string,
     *         inProgress: bool
     *     },
     *     currencyCode: string,
     *     totals: array{
     *         sessions: int|float,
     *         visitors: int|float,
     *         pageViews: int|float,
     *         orders: int|float,
     *         revenue: int|float,
     *         visitOrders: int|float,
     *         visitRevenue: int|float,
     *         viewsPerSession: int|float,
     *         avgEngagedSeconds: int|float,
     *         measuredSessions: int|float,
     *         bounceRate: int|float,
     *         cartRate: int|float,
     *         conversionRate: int|float
     *     },
     *     previous: array{
     *         sessions: int|float,
     *         visitors: int|float,
     *         pageViews: int|float,
     *         orders: int|float,
     *         revenue: int|float,
     *         visitOrders: int|float,
     *         visitRevenue: int|float,
     *         viewsPerSession: int|float,
     *         avgEngagedSeconds: int|float,
     *         measuredSessions: int|float,
     *         bounceRate: int|float,
     *         cartRate: int|float,
     *         conversionRate: int|float
     *     },
     *     change: array{
     *         sessions: mixed,
     *         visitors: mixed,
     *         pageViews: mixed,
     *         orders: mixed,
     *         revenue: mixed,
     *         visitOrders: mixed,
     *         visitRevenue: mixed,
     *         viewsPerSession: mixed,
     *         avgEngagedSeconds: mixed,
     *         bounceRate: mixed,
     *         cartRate: mixed,
     *         conversionRate: mixed
     *     },
     *     series: array{
     *         bucket: string,
     *         points: list<array{
     *             at: string,
     *             sessions: int|float,
     *             views: int|float,
     *             previousAt: string,
     *             previousSessions: int|float,
     *             previousViews: int|float
     *         }>
     *     },
     *     pages: array{
     *         rows: array<mixed>,
     *         distinct: int|float,
     *         views: int|float,
     *         coversFrom: string,
     *         retentionDays: int|float
     *     },
     *     landing: array{
     *         rows: array<mixed>,
     *         distinct: int|float
     *     },
     *     exit: array{
     *         rows: array<mixed>,
     *         distinct: int|float
     *     },
     *     channels: array{
     *         rows: array<mixed>,
     *         distinct: int|float
     *     },
     *     referrers: array{
     *         rows: array<mixed>,
     *         distinct: int|float
     *     },
     *     devices: array{
     *         rows: array<mixed>,
     *         distinct: int|float
     *     },
     *     browsers: array{
     *         rows: array<mixed>,
     *         distinct: int|float
     *     },
     *     systems: array{
     *         rows: array<mixed>,
     *         distinct: int|float
     *     },
     *     campaigns: array{
     *         rows: array<mixed>,
     *         distinct: int|float
     *     },
     *     sources: array{
     *         rows: array<mixed>,
     *         distinct: int|float
     *     },
     *     campaignSales: array<mixed>,
     *     engines: array{
     *         rows: array<mixed>,
     *         sessions: int|float
     *     },
     *     affiliates: array<mixed>,
     *     countries: array{
     *         rows: array<mixed>,
     *         distinct: int|float
     *     },
     *     cities: array{
     *         rows: array<mixed>
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/analytics/get-the-visits-report
     */
    public function report(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('analytics.report', [], $params, $options);
    }

    /**
     * **Get the live view**
     *
     * What is happening on the store now: who is on it and where, the checkouts and orders of the last ten minutes, and the day's running totals.
     *
     * Needs the `analytics.read` permission (Read Analytics).
     *
     * Fields:
     *
     * - `tz`: The time zone "today" is in, as an IANA name. Left out, UTC.
     *
     * @param array{
     *     tz?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     windowMinutes: int|float,
     *     currencyCode: string,
     *     home: array{
     *         countryCode: string,
     *         country: string,
     *         latitude: int|float,
     *         longitude: int|float
     *     },
     *     now: array{
     *         visitors: int|float,
     *         carted: int|float,
     *         checkingOut: int|float,
     *         purchased: int|float
     *     },
     *     today: array{
     *         sessions: int|float,
     *         views: int|float,
     *         orders: int|float,
     *         revenue: int|float,
     *         from: string,
     *         timezone: string
     *     },
     *     visitors: array<mixed>,
     *     orders: array<mixed>,
     *     topPages: array<mixed>,
     *     topLocations: array<mixed>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/analytics/get-the-live-view
     */
    public function live(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('analytics.live', [], $params, $options);
    }

    /**
     * **Get visitors now**
     *
     * How many visitors are on the store now: one number, counted over the last ten minutes.
     *
     * Needs the `analytics.read` permission (Read Analytics).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     visitors: int|float,
     *     windowMinutes: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/analytics/get-visitors-now
     */
    public function visitorsNow(array $options = []): mixed
    {
        return $this->caller->call('analytics.visitorsNow', [], [], $options);
    }

    /**
     * **Get the search report**
     *
     * How the store was found in a search engine over a period: clicks, impressions, click rate and position, over time and by search, page, country and device. From an engine the store has connected in the dashboard. With none connected it is refused with `search_unavailable`. Neither engine has figures for today.
     *
     * Needs the `analytics.read` permission (Read Analytics). It is one of the heavier reads, and is counted against a smaller budget of its own: 60 a minute for each key.
     *
     * Fields:
     *
     * - `provider`: Which engine. Left out, it is "google".
     * - `range`: The period. Left out, it is "30d".
     * - `from`: The first day of a period of your own, as `YYYY-MM-DD`. With `to`, in place of `range`.
     * - `to`: Its last day, as `YYYY-MM-DD`.
     * - `tz`: The time zone those days are in, as an IANA name. Left out, UTC.
     * - `dimension`: To ask about one thing: what kind of thing `value` is.
     * - `value`: The one search, page, country or device to ask about.
     * - `find`: Only rows of one list that contain these words.
     * - `findIn`: Which list `find` narrows.
     *
     * @param array{
     *     provider?: 'google'|'bing',
     *     range?: 'today'|'yesterday'|'7d'|'30d'|'this_week'|'last_week'|'this_month'|'last_month'|'this_year',
     *     from?: string,
     *     to?: string,
     *     tz?: string,
     *     dimension?: 'query'|'page'|'country'|'device',
     *     value?: string,
     *     find?: string,
     *     findIn?: 'query'|'page'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/analytics/get-the-search-report
     */
    public function search(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('analytics.search', [], $params, $options);
    }
}
