<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Customers
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List customers**
     *
     * The store's customers, a page at a time, each with how many orders they have paid for, what they have spent, their balance and their `tags`: Shoply's two first (`vip` and `disputed`, worked out from their orders as they are read), then the store's own.
     *
     * Needs the `customers.read` permission (Read Customers).
     *
     * Fields:
     *
     * - `page`: Which page of the list. The first is 1. Left out, it is 1.
     * - `perPage`: How many a page holds. Left out, it is 20.
     * - `search`: Part of an email address.
     * - `sort`: What the list is ordered by, largest or latest first. Left out, it is "newest".
     * - `only`: Only customers who are affiliates, or who are subscribed to the store's news and offers.
     * - `tag`: Only customers wearing this tag: `vip`, `disputed`, or the ID of one of the store's own.
     * - `range`: Only customers first seen in this period.
     * - `from`: Only customers first seen on or after this day, as `YYYY-MM-DD`. With `to`, in place of `range`.
     * - `to`: Only customers first seen on or before this day, as `YYYY-MM-DD`.
     * - `tz`: The time zone those days are in, as an IANA name. Left out, UTC.
     *
     * @param array{
     *     page?: int,
     *     perPage?: int,
     *     search?: string,
     *     sort?: 'newest'|'spent'|'orders'|'recent'|'balance',
     *     only?: 'affiliates'|'subscribed',
     *     tag?: string,
     *     range?: 'today'|'yesterday'|'7d'|'30d'|'this_week'|'last_week'|'this_month'|'last_month'|'this_year',
     *     from?: string,
     *     to?: string,
     *     tz?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\Page<array{
     *     id: string,
     *     emailAddress: string,
     *     dateCreated: string,
     *     totalOrders: int|float,
     *     totalSpend: int|float,
     *     paidOrders: int|float,
     *     lastOrderAt: mixed,
     *     balance: int|float,
     *     affiliateState: mixed,
     *     tags: list<array{
     *         id: string,
     *         name: string,
     *         tone: string,
     *         automatic: bool
     *     }>
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customers/list-customers
     */
    public function list(array $params = [], array $options = []): \Shoply\Page
    {
        return $this->caller->call('customers.list', [], $params, $options);
    }

    /**
     * **Create a customer**
     *
     * Adds an address to the customer list before it has ordered, so it can be given a balance or made an affiliate. An address that is already a customer is answered as it is, with `meta.alreadyExisted` saying so.
     *
     * Needs the `customers.write` permission (Change Customers).
     *
     * Fields:
     *
     * - `email` (required): The customer's email address.
     *
     * @param array{
     *     email: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     emailAddress: string,
     *     dateCreated: string,
     *     totalOrders: int|float,
     *     totalSpend: int|float,
     *     paidOrders: int|float,
     *     lastOrderAt: mixed,
     *     balance: int|float,
     *     affiliateState: mixed
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customers/create-a-customer
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('customers.create', [], $params, $options);
    }

    /**
     * **Export customers**
     *
     * The customers the same filters would list, as a CSV file: each one's email, when they were first seen, the orders they paid for and what they spent, their first and last paid order, their store balance, their affiliate code and balance where they have one, their tags, and whether they are subscribed to the store's news and offers. Every customer the filters match is in the file, however many: it is sent as it is read. Add `check=1` for `{ rows }`, how many it would have, which is not counted. A store exports at most 30 files every 10 minutes, orders, customers, fraud events and blacklist rules together, whoever asks: after that the answer is 429.
     *
     * Needs the `customers.read` permission (Read Customers). It is one of the heavier reads, and is counted against a smaller budget of its own: 60 a minute for each key.
     *
     * Fields:
     *
     * - `search`: Part of an email address.
     * - `sort`: What the file is ordered by, largest or latest first. Left out, it is "newest".
     * - `only`: Only customers who are affiliates, or who are subscribed to the store's news and offers.
     * - `tag`: Only customers wearing this tag: `vip`, `disputed`, or the ID of one of the store's own.
     * - `check`: `1` for how many rows the file would have, as `{ rows }`, in place of the file. Not counted against the store's exports, and refused with 429 where none are left.
     * - `range`: Only customers first seen in this period.
     * - `from`: Only customers first seen on or after this day, as `YYYY-MM-DD`. With `to`, in place of `range`.
     * - `to`: Only customers first seen on or before this day, as `YYYY-MM-DD`.
     * - `tz`: The time zone those days are in, as an IANA name. Left out, UTC.
     *
     * @param array{
     *     search?: string,
     *     sort?: 'newest'|'spent'|'orders'|'recent'|'balance',
     *     only?: 'affiliates'|'subscribed',
     *     tag?: string,
     *     check?: '1',
     *     range?: 'today'|'yesterday'|'7d'|'30d'|'this_week'|'last_week'|'this_month'|'last_month'|'this_year',
     *     from?: string,
     *     to?: string,
     *     tz?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\File
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customers/export-customers
     */
    public function export(array $params = [], array $options = []): \Shoply\File
    {
        return $this->caller->call('customers.export', [], $params, $options);
    }

    /**
     * **Get customer figures**
     *
     * The four figures over the customers list, each beside the period before it. With no period named, the last 30 days.
     *
     * Needs the `customers.read` permission (Read Customers).
     *
     * Fields:
     *
     * - `range`: Only customers first seen in this period.
     * - `from`: Only customers first seen on or after this day, as `YYYY-MM-DD`. With `to`, in place of `range`.
     * - `to`: Only customers first seen on or before this day, as `YYYY-MM-DD`.
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
     *     range: array{
     *         preset: string,
     *         from: string,
     *         to: string
     *     },
     *     currencyCode: string,
     *     customers: array{
     *         total: int|float,
     *         change: mixed
     *     },
     *     newCustomers: array{
     *         count: int|float,
     *         previous: int|float,
     *         change: mixed
     *     },
     *     returning: array{
     *         rate: int|float,
     *         returning: int|float,
     *         customers: int|float,
     *         change: mixed
     *     },
     *     averageSpend: array{
     *         value: int|float,
     *         previous: int|float,
     *         change: mixed
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customers/get-customer-figures
     */
    public function stats(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('customers.stats', [], $params, $options);
    }

    /**
     * **Get a customer**
     *
     * One customer: their orders, their balance and its history, their `tags`, whether they are blacklisted, and their affiliate figures if they are one.
     *
     * Needs the `customers.read` permission (Read Customers).
     *
     * @param string $customerId The customer.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     balance: int|float,
     *     balanceAtCheckout: bool,
     *     tags: list<array{
     *         id: string,
     *         name: string,
     *         tone: string,
     *         automatic: bool
     *     }>,
     *     balanceHistory: list<array{
     *         id: string,
     *         kind: string,
     *         amount: int|float,
     *         balanceAfter: int|float,
     *         currencyCode: string,
     *         note: string,
     *         orderId: mixed,
     *         by: string,
     *         dateCreated: string
     *     }>,
     *     affiliate: mixed,
     *     blacklisted: bool,
     *     blacklistedBy: array<mixed>,
     *     blacklistRules: int|float,
     *     knownAddresses: int|float,
     *     id: string,
     *     emailAddress: string,
     *     dateCreated: string,
     *     totalOrders: int|float,
     *     totalSpend: int|float,
     *     paidOrders: int|float,
     *     lastOrderAt: mixed,
     *     currencyCode: string,
     *     ordersTruncated: bool,
     *     orders: array<mixed>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customers/get-a-customer
     */
    public function show(string $customerId, array $options = []): mixed
    {
        return $this->caller->call('customers.show', [$customerId], [], $options);
    }

    /**
     * **Change a customer's balance**
     *
     * Adds to, takes from or sets the customer's balance at the store, which they can spend at checkout. Send an `Idempotency-Key` with this request, so that a retry does not credit twice. Answers the customer with the new balance and its history.
     *
     * Needs the `customers.balance` permission (Change Balances).
     *
     * Fields:
     *
     * - `mode` (required): Add to it, take from it, or set it to exactly this.
     * - `amount` (required): How much, in the store's currency, with at most 2 decimals.
     * - `note`: Why, up to 500 characters. Kept in the balance's history.
     *
     * @param string $customerId The customer.
     * @param array{
     *     mode: 'add'|'subtract'|'set',
     *     amount: int|float,
     *     note?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     balance: int|float,
     *     balanceAtCheckout: bool,
     *     tags: list<array{
     *         id: string,
     *         name: string,
     *         tone: string,
     *         automatic: bool
     *     }>,
     *     balanceHistory: list<array{
     *         id: string,
     *         kind: string,
     *         amount: int|float,
     *         balanceAfter: int|float,
     *         currencyCode: string,
     *         note: string,
     *         orderId: mixed,
     *         by: string,
     *         dateCreated: string
     *     }>,
     *     affiliate: mixed,
     *     blacklisted: bool,
     *     blacklistedBy: array<mixed>,
     *     blacklistRules: int|float,
     *     knownAddresses: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customers/change-a-customers-balance
     */
    public function setBalance(string $customerId, array $params, array $options = []): mixed
    {
        return $this->caller->call('customers.setBalance', [$customerId], $params, $options);
    }

    /**
     * **Blacklist a customer**
     *
     * Stops the customer buying: their email is added to the store's blacklist, and with `addresses` the IP addresses their orders came from. Their open checkouts are refused from this moment.
     *
     * Needs the `customers.write` permission (Change Customers).
     *
     * Fields:
     *
     * - `addresses`: Whether to blacklist the IP addresses their orders came from too, up to 20. Left out, it is true.
     * - `note`: Why. Kept with the rules it makes.
     *
     * @param string $customerId The customer.
     * @param array{
     *     addresses?: bool,
     *     note?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     balance: int|float,
     *     balanceAtCheckout: bool,
     *     tags: list<array{
     *         id: string,
     *         name: string,
     *         tone: string,
     *         automatic: bool
     *     }>,
     *     balanceHistory: list<array{
     *         id: string,
     *         kind: string,
     *         amount: int|float,
     *         balanceAfter: int|float,
     *         currencyCode: string,
     *         note: string,
     *         orderId: mixed,
     *         by: string,
     *         dateCreated: string
     *     }>,
     *     affiliate: mixed,
     *     blacklisted: bool,
     *     blacklistedBy: list<array{
     *         id: string,
     *         type: string,
     *         value: string,
     *         part: string
     *     }>,
     *     blacklistRules: int|float,
     *     knownAddresses: int|float,
     *     added: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customers/blacklist-a-customer
     */
    public function blacklist(string $customerId, array $params = [], array $options = []): mixed
    {
        return $this->caller->call('customers.blacklist', [$customerId], $params, $options);
    }

    /**
     * **Clear a customer from the blacklist**
     *
     * Takes the customer off the blacklist: the rules their page or a dispute of theirs added, any rule on their email, and with `addresses` the rules on an IP address their orders came from. A rule that covers other buyers too (a domain, a range) stays: the customer's `blacklistedBy` lists each rule still refusing them.
     *
     * Needs the `customers.write` permission (Change Customers).
     *
     * Fields:
     *
     * - `addresses`: Whether to take off the rules on the IP addresses their orders came from too, which someone added by hand. Left out, it is true.
     *
     * @param string $customerId The customer.
     * @param array{
     *     addresses?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     balance: int|float,
     *     balanceAtCheckout: bool,
     *     tags: list<array{
     *         id: string,
     *         name: string,
     *         tone: string,
     *         automatic: bool
     *     }>,
     *     balanceHistory: list<array{
     *         id: string,
     *         kind: string,
     *         amount: int|float,
     *         balanceAfter: int|float,
     *         currencyCode: string,
     *         note: string,
     *         orderId: mixed,
     *         by: string,
     *         dateCreated: string
     *     }>,
     *     affiliate: mixed,
     *     blacklisted: bool,
     *     blacklistedBy: array<mixed>,
     *     blacklistRules: int|float,
     *     knownAddresses: int|float,
     *     removed: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customers/clear-a-customer-from-the-blacklist
     */
    public function unblacklist(string $customerId, array $params = [], array $options = []): mixed
    {
        return $this->caller->call('customers.unblacklist', [$customerId], $params, $options);
    }

    /**
     * **Set a customer's tags**
     *
     * The customer's own tags become exactly these: any not listed is taken off, any new one is put on, and each is sent as `customer.tagged` or `customer.untagged`. Shoply's two are not set here. Answers their tags.
     *
     * Needs the `customers.tags` permission (Change Tags).
     *
     * Fields:
     *
     * - `tags` (required): The IDs of the store's tags they wear.
     *
     * @param string $customerId The customer.
     * @param array{
     *     tags: list<string>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     name: string,
     *     tone: string,
     *     automatic: bool
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customers/set-a-customers-tags
     */
    public function setTags(string $customerId, array $params, array $options = []): mixed
    {
        return $this->caller->call('customers.setTags', [$customerId], $params, $options);
    }

    /**
     * **Put a tag on a customer**
     *
     * One of the store's tags on the customer. One they already wear changes nothing. Answers their tags.
     *
     * Needs the `customers.tags` permission (Change Tags).
     *
     * @param string $customerId The customer.
     * @param string $tagId The tag.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     name: string,
     *     tone: string,
     *     automatic: bool
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customers/put-a-tag-on-a-customer
     */
    public function tag(string $customerId, string $tagId, array $options = []): mixed
    {
        return $this->caller->call('customers.tag', [$customerId, $tagId], [], $options);
    }

    /**
     * **Take a tag off a customer**
     *
     * One of the store's tags off the customer. One they do not wear changes nothing. Answers their tags.
     *
     * Needs the `customers.tags` permission (Change Tags).
     *
     * @param string $customerId The customer.
     * @param string $tagId The tag.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array<mixed>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customers/take-a-tag-off-a-customer
     */
    public function untag(string $customerId, string $tagId, array $options = []): mixed
    {
        return $this->caller->call('customers.untag', [$customerId, $tagId], [], $options);
    }
}
