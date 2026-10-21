<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Orders
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List orders**
     *
     * The store's orders, a page at a time, newest first unless sorted otherwise. `meta.statusCounts` says how many orders are in each status, and `meta.stats` what the orders matched come to.
     *
     * Needs the `orders.read` permission (Read Orders).
     *
     * Fields:
     *
     * - `page`: Which page of the list. The first is 1. Left out, it is 1.
     * - `perPage`: How many a page holds, up to 100. Left out, it is 20.
     * - `status`: Only orders in this status.
     * - `gateway`: Only orders paid with this payment method, by its name in the payment methods list.
     * - `search`: An order's ID, or part of a buyer's email.
     * - `sort`: What the list is ordered by. Left out, it is "created_at".
     * - `direction`: Which way it is ordered. Left out, it is "desc".
     * - `range`: Only orders placed in this period.
     * - `from`: Only orders placed on or after this day, as `YYYY-MM-DD`. With `to`, in place of `range`.
     * - `to`: Only orders placed on or before this day, as `YYYY-MM-DD`.
     * - `tz`: The time zone the days of `range`, `from` and `to` are in, as an IANA name. Left out, UTC.
     *
     * @param array{
     *     page?: int,
     *     perPage?: int,
     *     status?: 'pending'|'completed'|'refunded'|'cancelled'|'chargeback',
     *     gateway?: string,
     *     search?: string,
     *     sort?: 'created_at'|'amount'|'email'|'status',
     *     direction?: 'asc'|'desc',
     *     range?: 'today'|'yesterday'|'7d'|'30d'|'this_week'|'last_week'|'this_month'|'last_month'|'this_year',
     *     from?: string,
     *     to?: string,
     *     tz?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\Page<array{
     *     id: string,
     *     dateCreated: string,
     *     email: string,
     *     customerId: string,
     *     productId: string,
     *     productName: string,
     *     variantId: string,
     *     variantName: string,
     *     itemCount: int|float,
     *     subtotal: int|float,
     *     discount: int|float,
     *     fee: int|float,
     *     balanceUsed: int|float,
     *     tax: mixed,
     *     amount: int|float,
     *     currencyCode: string,
     *     charged: mixed,
     *     status: string,
     *     gateway: string,
     *     couponCode: mixed,
     *     returning: bool,
     *     country: mixed,
     *     billing: array{
     *         name: string,
     *         line1: string,
     *         line2: string,
     *         city: string,
     *         state: string,
     *         postalCode: string,
     *         country: string
     *     },
     *     ip: mixed,
     *     userAgent: mixed,
     *     source: string,
     *     subscriptionId: mixed,
     *     transactionId: mixed,
     *     paidAt: mixed,
     *     note: string,
     *     customFields: array<mixed>,
     *     emailState: string,
     *     emailError: string,
     *     emailAttempts: int|float,
     *     emailSentAt: mixed,
     *     notifyState: string,
     *     notifyError: string,
     *     notifyAttempts: int|float,
     *     notifySentAt: mixed,
     *     summary: string,
     *     items: list<array{
     *         id: string,
     *         productId: string,
     *         productName: string,
     *         variantId: string,
     *         variantName: string,
     *         amount: int|float,
     *         unitPrice: int|float,
     *         quantity: int|float,
     *         lineTotal: int|float,
     *         upsellId: mixed,
     *         addonOf: mixed,
     *         deliveredKeys: array<mixed>,
     *         redeliveryCount: int|float,
     *         lastRedeliveredAt: mixed,
     *         deliveryInstructions: string,
     *         dynamicState: string,
     *         dynamicMessage: string,
     *         dynamicItems: array<mixed>,
     *         previousDynamicItems: array<mixed>,
     *         dynamicDeliveredAt: mixed,
     *         dynamicError: string,
     *         dynamicAttempts: int|float
     *     }>,
     *     invoice: mixed
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/orders/list-orders
     */
    public function list(array $params = [], array $options = []): \Shoply\Page
    {
        return $this->caller->call('orders.list', [], $params, $options);
    }

    /**
     * **Export orders**
     *
     * The orders the same filters would list, as a CSV file: a row an order with every field its page shows (when it was paid, the fee, tax, balance and affiliate in it, the currency it was charged in, the billing address), or a row a product line with `rows=lines`. The first thirteen columns are always Order ID, Created, Email, Status, Payment, Currency, Subtotal, Discount, Total, Coupon, Country, Items and Products, in that order. No delivered key is in it. Every order the filters match is in the file, however many: it is sent as it is read, with no length given. Add `check=1` for `{ rows }`, how many it would have, which is not counted. A store exports at most 30 files every 10 minutes, orders, customers, fraud events and blacklist rules together, whoever asks: after that the answer is 429.
     *
     * Needs the `orders.read` permission (Read Orders). It is one of the heavier reads, and is counted against a smaller budget of its own: 60 a minute for each key.
     *
     * Fields:
     *
     * - `status`: Only orders in this status.
     * - `gateway`: Only orders paid with this payment method, by its name in the payment methods list.
     * - `search`: An order's ID, or part of a buyer's email.
     * - `sort`: What the list is ordered by. Left out, it is "created_at".
     * - `direction`: Which way it is ordered. Left out, it is "desc".
     * - `range`: Only orders placed in this period.
     * - `from`: Only orders placed on or after this day, as `YYYY-MM-DD`. With `to`, in place of `range`.
     * - `to`: Only orders placed on or before this day, as `YYYY-MM-DD`.
     * - `tz`: The time zone the days of `range`, `from` and `to` are in, as an IANA name. Left out, UTC.
     * - `rows`: What a row is: an order, or one product line of one. Left out, it is "orders".
     * - `check`: `1` for how many rows the file would have, as `{ rows }`, in place of the file. Not counted against the store's exports, and refused with 429 where none are left.
     *
     * @param array{
     *     status?: 'pending'|'completed'|'refunded'|'cancelled'|'chargeback',
     *     gateway?: string,
     *     search?: string,
     *     sort?: 'created_at'|'amount'|'email'|'status',
     *     direction?: 'asc'|'desc',
     *     range?: 'today'|'yesterday'|'7d'|'30d'|'this_week'|'last_week'|'this_month'|'last_month'|'this_year',
     *     from?: string,
     *     to?: string,
     *     tz?: string,
     *     rows?: 'orders'|'lines',
     *     check?: '1'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\File
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/orders/export-orders
     */
    public function export(array $params = [], array $options = []): \Shoply\File
    {
        return $this->caller->call('orders.export', [], $params, $options);
    }

    /**
     * **Get an order**
     *
     * One order with everything its page shows: its lines and what each delivered, its payments, the buyer, its timeline, where it came from, `refund`, which says which ways it can be refunded, and `requests`: what Shoply sent your servers about it, each try of each webhook about the order and each line's dynamic delivery, newest first, with the first 300 characters of what came back. `customPayment` is for an order paid with one of your custom payment methods, and null for any other: the method's name, `status` (`open`, `review` while it waits for you to approve or reject it, `paid` or `rejected`), the amount, and `proof`, what the buyer sent when they said they paid (the reference, whether a proof of payment was sent, and when).
     *
     * Needs the `orders.read` permission (Read Orders).
     *
     * @param string $orderId The order. The ID in a checkout's address is the order's ID.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     dateCreated: string,
     *     email: string,
     *     customerId: string,
     *     productId: string,
     *     productName: string,
     *     variantId: string,
     *     variantName: string,
     *     itemCount: int|float,
     *     subtotal: int|float,
     *     discount: int|float,
     *     fee: int|float,
     *     balanceUsed: int|float,
     *     tax: mixed,
     *     amount: int|float,
     *     currencyCode: string,
     *     charged: mixed,
     *     status: string,
     *     gateway: string,
     *     couponCode: mixed,
     *     returning: bool,
     *     country: mixed,
     *     billing: array{
     *         name: string,
     *         line1: string,
     *         line2: string,
     *         city: string,
     *         state: string,
     *         postalCode: string,
     *         country: string
     *     },
     *     ip: mixed,
     *     userAgent: mixed,
     *     source: string,
     *     subscriptionId: mixed,
     *     transactionId: string,
     *     paidAt: string,
     *     note: string,
     *     customFields: array<mixed>,
     *     emailState: string,
     *     emailError: string,
     *     emailAttempts: int|float,
     *     emailSentAt: string,
     *     notifyState: string,
     *     notifyError: string,
     *     notifyAttempts: int|float,
     *     notifySentAt: mixed,
     *     summary: string,
     *     items: list<array{
     *         id: string,
     *         productId: string,
     *         productName: string,
     *         variantId: string,
     *         variantName: string,
     *         amount: int|float,
     *         unitPrice: int|float,
     *         quantity: int|float,
     *         lineTotal: int|float,
     *         upsellId: mixed,
     *         addonOf: mixed,
     *         deliveredKeys: list<string>,
     *         redeliveryCount: int|float,
     *         lastRedeliveredAt: mixed,
     *         deliveryInstructions: string,
     *         dynamicState: string,
     *         dynamicMessage: string,
     *         dynamicItems: array<mixed>,
     *         previousDynamicItems: array<mixed>,
     *         dynamicDeliveredAt: mixed,
     *         dynamicError: string,
     *         dynamicAttempts: int|float,
     *         redeliverable: bool,
     *         stockAvailable: int|float,
     *         previousKeys: array<mixed>
     *     }>,
     *     refund: array{
     *         amount: int|float,
     *         currency: string,
     *         fromBalance: int|float,
     *         paid: int|float,
     *         source: array{
     *             available: bool,
     *             why: string,
     *             provider: string,
     *             name: string
     *         },
     *         balance: array{
     *             available: bool,
     *             why: string
     *         },
     *         record: array{
     *             available: bool,
     *             why: string
     *         }
     *     },
     *     productSlug: string,
     *     imageUrl: mixed,
     *     customer: array{
     *         id: string,
     *         emailAddress: string,
     *         dateCreated: string
     *     },
     *     visit: mixed,
     *     affiliate: mixed,
     *     timeline: list<array{
     *         id: string,
     *         kind: string,
     *         detail: string,
     *         actor: string,
     *         at: string
     *     }>,
     *     testPayment: bool,
     *     payments: array<mixed>,
     *     invoice: mixed,
     *     disputes: array<mixed>,
     *     review: mixed,
     *     requests: array<mixed>,
     *     customPayment: mixed,
     *     customerTotals: array{
     *         totalOrders: int|float,
     *         totalSpend: int|float,
     *         paidOrders: int|float
     *     },
     *     customerOrders: list<array{
     *         id: string,
     *         productName: string,
     *         variantName: string,
     *         itemCount: int|float,
     *         amount: int|float,
     *         status: string,
     *         dateCreated: string
     *     }>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/orders/get-an-order
     */
    public function show(string $orderId, array $options = []): mixed
    {
        return $this->caller->call('orders.show', [$orderId], [], $options);
    }

    /**
     * **Get an order's network**
     *
     * What is known about the connection the order was placed from: its provider, and whether it looks like a VPN, a proxy or a data centre. Asked of a lookup service when it is called, so it is a route of its own.
     *
     * Needs the `orders.read` permission (Read Orders). It is one of the heavier reads, and is counted against a smaller budget of its own: 60 a minute for each key.
     *
     * @param string $orderId The order. The ID in a checkout's address is the order's ID.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/orders/get-an-orders-network
     */
    public function network(string $orderId, array $options = []): mixed
    {
        return $this->caller->call('orders.network', [$orderId], [], $options);
    }

    /**
     * **Get an order's PDF**
     *
     * The order's invoice as a PDF file. Every order has one, paid or not.
     *
     * Needs the `orders.read` permission (Read Orders). It is one of the heavier reads, and is counted against a smaller budget of its own: 60 a minute for each key.
     *
     * @param string $orderId The order. The ID in a checkout's address is the order's ID.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\File
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/orders/get-an-orders-pdf
     */
    public function pdf(string $orderId, array $options = []): \Shoply\File
    {
        return $this->caller->call('orders.pdf', [$orderId], [], $options);
    }

    /**
     * **Mark an order as paid**
     *
     * Completes a pending or cancelled order as a payment would: it is delivered, its receipt is sent and it counts as revenue. For money that reached you some other way.
     *
     * Refused if any line cannot be delivered in full, so an order is never half delivered. Refused for an order that was refunded or charged back, and for a checkout the buyer never pressed Pay on, which has nobody to deliver to.
     *
     * Needs the `orders.fulfil` permission (Deliver Orders).
     *
     * Fields:
     *
     * - `transactionId`: Your own reference for the payment, up to 100 characters. Shown on the order.
     *
     * @param string $orderId The order. The ID in a checkout's address is the order's ID.
     * @param array{
     *     transactionId?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     status: string,
     *     dynamic: array<mixed>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/orders/mark-an-order-as-paid
     */
    public function markPaid(string $orderId, array $params = [], array $options = []): mixed
    {
        return $this->caller->call('orders.markPaid', [$orderId], $params, $options);
    }

    /**
     * **Refund an order**
     *
     * Refunds a completed order, all of it. Which `destination` an order can take is in `refund` on the order: a payment method that cannot send money back (crypto, always) can only be refunded as store credit or recorded.
     *
     * Send an `Idempotency-Key` with this request. The order is marked refunded only once the payment provider has said the money is on its way, or the buyer has been credited.
     *
     * Needs the `orders.refund` permission (Refund Orders).
     *
     * Fields:
     *
     * - `destination` (required): `source`: back through the payment provider, to what paid. `balance`: credit on the buyer's balance at the store. `record`: only marked as refunded, because you returned the money yourself.
     * - `reason` (required): Why.
     * - `amount`: For `balance` only: how much to credit, from 0.01 up to what was paid, with at most 2 decimals. Left out, all of it.
     *
     * @param string $orderId The order. The ID in a checkout's address is the order's ID.
     * @param array{
     *     destination: 'source'|'balance'|'record',
     *     reason: 'requested'|'duplicate'|'fraudulent'|'other',
     *     amount?: int|float
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     status: string,
     *     destination: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/orders/refund-an-order
     */
    public function refund(string $orderId, array $params, array $options = []): mixed
    {
        return $this->caller->call('orders.refund', [$orderId], $params, $options);
    }

    /**
     * **Deliver an order again**
     *
     * Gives the buyer fresh license keys for the order's lines and emails them. The keys those lines held before are revoked, not returned to stock, so this costs stock: it is for a key that did not work.
     *
     * It goes to the order's own email address. Sending an order to another address is done in the dashboard.
     *
     * One order is delivered again at most ten times an hour, whoever asks: after that the answer is 429.
     *
     * Needs the `orders.fulfil` permission (Deliver Orders).
     *
     * Fields:
     *
     * - `itemIds`: The order's lines to act on, by their IDs. Left out, every line it applies to.
     *
     * @param string $orderId The order. The ID in a checkout's address is the order's ID.
     * @param array{
     *     itemIds?: list<int>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     items: list<array{
     *         id: int|float,
     *         productName: string,
     *         variantName: string,
     *         keys: list<string>
     *     }>,
     *     email: array{
     *         state: string,
     *         reason: string
     *     },
     *     dynamic: array<mixed>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/orders/deliver-an-order-again
     */
    public function redeliver(string $orderId, array $params = [], array $options = []): mixed
    {
        return $this->caller->call('orders.redeliver', [$orderId], $params, $options);
    }

    /**
     * **Retry a dynamic delivery**
     *
     * Asks your delivery endpoint again for the lines whose dynamic delivery failed. Nothing is revoked: those lines never delivered anything. A store may ask for 150 of these in ten minutes.
     *
     * Needs the `orders.fulfil` permission (Deliver Orders).
     *
     * Fields:
     *
     * - `itemIds`: The order's lines to act on, by their IDs. Left out, every line it applies to.
     *
     * @param string $orderId The order. The ID in a checkout's address is the order's ID.
     * @param array{
     *     itemIds?: list<int>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/orders/retry-a-dynamic-delivery
     */
    public function retryDelivery(string $orderId, array $params = [], array $options = []): mixed
    {
        return $this->caller->call('orders.retryDelivery', [$orderId], $params, $options);
    }

    /**
     * **Send an order's email again**
     *
     * Sends the order's delivery email again, with what it delivered, to the order's own email address. One customer's order emails are sent again at most five times an hour at your store, across all their orders and whoever asks: after that the answer is 429.
     *
     * Needs the `orders.fulfil` permission (Deliver Orders). It sends an email, and is counted against a budget of its own: 60 in ten minutes for each key.
     *
     * @param string $orderId The order. The ID in a checkout's address is the order's ID.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/orders/send-an-orders-email-again
     */
    public function resendEmail(string $orderId, array $options = []): mixed
    {
        return $this->caller->call('orders.resendEmail', [$orderId], [], $options);
    }

    /**
     * **Approve a payment to check**
     *
     * Approves the payment a buyer says they made with one of the store's custom payment methods, and completes the order as a payment would: its keys are delivered and its receipt sent. Only for an order whose payment waits for review (an `order.payment_submitted` webhook says so). Shoply never sees that money: approve once you have seen it arrive. Answers the order's ID, its `status`, and `dynamic`, what each dynamic delivery answered. One that cannot deliver (short of stock) is refused with why, and still waits.
     *
     * Needs the `orders.fulfil` permission (Deliver Orders).
     *
     * @param string $orderId The order. The ID in a checkout's address is the order's ID.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     status: string,
     *     dynamic: array<mixed>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/orders/approve-a-payment-to-check
     */
    public function approvePayment(string $orderId, array $options = []): mixed
    {
        return $this->caller->call('orders.approvePayment', [$orderId], [], $options);
    }

    /**
     * **Reject a payment to check**
     *
     * Rejects the payment a buyer says they made with a custom method, and cancels the order. Its coupon's use is handed back, and the buyer is not emailed.
     *
     * Needs the `orders.fulfil` permission (Deliver Orders).
     *
     * @param string $orderId The order. The ID in a checkout's address is the order's ID.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     status: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/orders/reject-a-payment-to-check
     */
    public function rejectPayment(string $orderId, array $options = []): mixed
    {
        return $this->caller->call('orders.rejectPayment', [$orderId], [], $options);
    }

    /**
     * **Get an order's proof of payment**
     *
     * The picture a buyer sent with a payment made with a custom method, as the file itself: a PNG, JPEG or WebP. Under the permission that approves the payment, since it is what the payment is checked by. 404 where the order has none.
     *
     * Needs the `orders.fulfil` permission (Deliver Orders).
     *
     * @param string $orderId The order. The ID in a checkout's address is the order's ID.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/orders/get-an-orders-proof-of-payment
     */
    public function proof(string $orderId, array $options = []): mixed
    {
        return $this->caller->call('orders.proof', [$orderId], [], $options);
    }

    /**
     * **Write an order's note**
     *
     * Sets the store's own note on the order. The buyer never sees it.
     *
     * Needs the `orders.write` permission (Change Orders).
     *
     * Fields:
     *
     * - `note` (required): The note. Empty clears it.
     * - `expectedNote`: The note as you last read it. Sent, the change is refused with `stale_write` if somebody has changed it since.
     *
     * @param string $orderId The order. The ID in a checkout's address is the order's ID.
     * @param array{
     *     note: string,
     *     expectedNote?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/orders/write-an-orders-note
     */
    public function setNote(string $orderId, array $params, array $options = []): mixed
    {
        return $this->caller->call('orders.setNote', [$orderId], $params, $options);
    }
}
