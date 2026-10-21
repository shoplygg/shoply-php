<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Invoices
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List invoices**
     *
     * The invoices the store has raised, a page at a time, newest first. An invoice is an order the store made for a buyer to pay: `orderId` is that order, and `payUrl` the page it is paid on. A payment link is listed with them (`kind` is `link`): an amount and what it is for (`title`), with no buyer on it (`email` is empty) until it is emailed to somebody or paid. One made in another currency than the store's says what the buyer is asked for in `charge`.
     *
     * Needs the `invoices.read` permission (Read Invoices).
     *
     * Fields:
     *
     * - `page`: Which page of the list. The first is 1. Left out, it is 1.
     * - `perPage`: How many a page holds, up to 100. Left out, it is 20.
     * - `status`: Only invoices whose order is in this status.
     * - `search`: An invoice's number, part of a buyer's email or name, or part of what a payment link is for.
     * - `kind`: Only invoices written for a buyer, or only payment links.
     *
     * @param array{
     *     page?: int,
     *     perPage?: int,
     *     status?: 'pending'|'completed'|'refunded'|'cancelled'|'chargeback',
     *     search?: string,
     *     kind?: 'invoice'|'link'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\Page<array{
     *     orderId: string,
     *     number: int|float,
     *     label: string,
     *     recipientName: string,
     *     note: string,
     *     gateways: list<string>,
     *     dueAt: string,
     *     overdue: bool,
     *     sentAt: mixed,
     *     sendCount: int|float,
     *     dateCreated: string,
     *     payUrl: string,
     *     kind: string,
     *     title: string,
     *     uses: mixed,
     *     linkOf: string,
     *     charge: mixed,
     *     email: string,
     *     amount: int|float,
     *     currencyCode: string,
     *     status: string,
     *     itemCount: int|float,
     *     paidAt: mixed
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/invoices/list-invoices
     */
    public function list(array $params = [], array $options = []): \Shoply\Page
    {
        return $this->caller->call('invoices.list', [], $params, $options);
    }

    /**
     * **Create an invoice**
     *
     * Raises an invoice: an order for a buyer to pay, with a page to pay it on. This is how a script makes an order. The answer has the order's ID (`orderId`) and the page it is paid on (`payUrl`), which you can hand to the buyer yourself.
     *
     * With `send` on, the invoice is also emailed to the buyer with its PDF. A store may email one invoice in five minutes, so a script that makes many leaves `send` off and delivers the link itself.
     *
     * A product line costs what the product costs. For any other price, add a line of your own with a `description` and a `unitPrice`. An invoice carries no automatic tax. A store may hold up to 2,000 unpaid invoices at once.
     *
     * Needs the `invoices.write` permission (Raise Invoices). It makes an order, and is counted against a budget of its own: 60 a minute for each key.
     *
     * Fields:
     *
     * - `email` (required): The buyer's email address.
     * - `name`: The buyer's name, up to 120 characters. Printed on the invoice.
     * - `note`: A note printed on the invoice, up to 1,000 characters.
     * - `dueDays`: How many days the buyer has to pay: 1 to 30. Left out, it is 7.
     * - `gateways` (required): The payment methods the buyer may pay with, by their names in the payment methods list. At least one the store has switched on.
     * - `items` (required): What is being charged for, up to 50 lines. Each is a product from the catalogue (`productId`, `variantId`, `quantity`) or a line of your own (`description`, `quantity`, `unitPrice`).
     * - `send`: Whether to email the invoice to the buyer now. Left out, it is true.
     *
     * @param array{
     *     email: string,
     *     name?: string,
     *     note?: string,
     *     dueDays?: int,
     *     gateways: list<string>,
     *     items: list<array{
     *         productId?: string,
     *         variantId?: string,
     *         description?: string,
     *         unitPrice?: int|float,
     *         quantity: int
     *     }>,
     *     send?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/invoices/create-an-invoice
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('invoices.create', [], $params, $options);
    }

    /**
     * **Send an invoice**
     *
     * Emails the invoice to the address on it, with its PDF. Only while it can still be paid, and one invoice email a store in five minutes.
     *
     * A payment link has no address on it until it is sent or paid, so the first send names one in `email`. The link is that buyer's from then on: the page it is paid on stops asking who is paying, and a later send with no `email` goes to the same address. It cannot be sent to another address once somebody has started paying it (`link_in_use`).
     *
     * A link that can be paid more than once stays nobody's: every send names an `email`, which is only where that one email goes, and it may be sent to as many people as you like at the same pace.
     *
     * Needs the `invoices.write` permission (Raise Invoices). It sends an email, and is counted against a budget of its own: 60 in ten minutes for each key.
     *
     * Fields:
     *
     * - `email`: For a payment link: the address to send it to. Left out, it goes to the address already on it.
     *
     * @param string $orderId The invoice's order.
     * @param array{
     *     email?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/invoices/send-an-invoice
     */
    public function send(string $orderId, array $params = [], array $options = []): mixed
    {
        return $this->caller->call('invoices.send', [$orderId], $params, $options);
    }

    /**
     * **Create a payment link**
     *
     * Makes a payment link: an invoice for an amount, with no buyer on it. `payUrl` in the answer is the link. Whoever opens it gives their email address and pays, and the order is theirs. It is an invoice in every other way: it is listed with them, has a number and a PDF, and is cancelled if it is not paid in seven days.
     *
     * A link is paid once unless `uses` says more. A link for more than one payment is never the order that is paid: each person who presses Pay on it is given an order and an invoice of their own, which names the link in `linkOf`, and the link's `uses` says how many times it has been paid and how many are left. The count is asked when Pay is pressed, so two people who press it for the last use at the same moment can both pay.
     *
     * It may be paid with whichever payment methods the store has switched on when it is made. It counts toward the 2,000 unpaid invoices a store may hold at once. To email it to somebody, send it (Send an invoice) with their address.
     *
     * With `currency`, the amount is in that currency and the buyer is charged exactly it, where the store may charge in it: its own currency always, and the others only while adaptive pricing is on. The order is then for the amount's worth in the store's currency at the rate of the moment.
     *
     * With `items`, the link sells products in place of an amount: it is for what they cost, in the store's own currency, and whoever pays is sent them as any buyer is. `amount` and `description` are then left out. What it sells has to be in stock when the link is made, and again each time somebody pays through a link for several payments (`out_of_stock`).
     *
     * It may be paid with every payment method the store has switched on, or with the ones named in `gateways`. It is open for seven days, or until `expiresAt`, or for `dueDays` days, up to 365.
     *
     * Needs the `invoices.write` permission (Raise Invoices). It makes an order, and is counted against a budget of its own: 60 a minute for each key.
     *
     * Fields:
     *
     * - `amount`: How much to ask for, above zero. Left out when `items` is sent.
     * - `description`: What it is for, up to 255 characters. The buyer sees it as the order's one line. Left out, the line is called Payment.
     * - `currency`: The currency the amount is in and the buyer is charged in, as a three-letter code. Left out, the store's own.
     * - `uses`: How many times the link can be paid: 1 to 1,000. Left out, it is 1.
     * - `items`: Products the link sells, in place of an amount: up to 50 lines.
     * - `gateways`: The payment methods it may be paid with, by their names in the payment methods list. Left out, every method the store has switched on.
     * - `expiresAt`: When it stops being payable, as a date and time, or a day (`YYYY-MM-DD`) for the end of that day. At least an hour from now and at most 365 days.
     * - `dueDays`: In place of `expiresAt`: how many days it is open, 1 to 365. Left out, it is 7.
     *
     * @param array{
     *     amount?: int|float,
     *     description?: string,
     *     currency?: string,
     *     uses?: int,
     *     items?: list<array{
     *         productId: string,
     *         variantId: string,
     *         quantity: int
     *     }>,
     *     gateways?: list<string>,
     *     expiresAt?: string,
     *     dueDays?: int
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     orderId: string,
     *     number: int|float,
     *     label: string,
     *     recipientName: string,
     *     note: string,
     *     gateways: list<string>,
     *     dueAt: string,
     *     overdue: bool,
     *     sentAt: mixed,
     *     sendCount: int|float,
     *     dateCreated: string,
     *     payUrl: string,
     *     kind: string,
     *     title: string,
     *     uses: mixed,
     *     linkOf: string,
     *     charge: mixed,
     *     email: string,
     *     amount: int|float,
     *     currencyCode: string,
     *     status: string,
     *     itemCount: int|float,
     *     paidAt: mixed
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/invoices/create-a-payment-link
     */
    public function link(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('invoices.link', [], $params, $options);
    }

    /**
     * **Delete a payment link**
     *
     * Removes a payment link nobody has paid or started to pay. Its address stops working for anyone who has it.
     *
     * Only a payment link, never an invoice (`not_a_link`). Not one that was paid, which is an order (`link_paid`), and not one somebody has pressed Pay on, in case their payment arrives (`link_in_use`): that one closes by itself on its due day.
     *
     * Needs the `invoices.write` permission (Raise Invoices).
     *
     * @param string $orderId The payment link's order.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/invoices/delete-a-payment-link
     */
    public function deleteLink(string $orderId, array $options = []): mixed
    {
        return $this->caller->call('invoices.deleteLink', [$orderId], [], $options);
    }
}
