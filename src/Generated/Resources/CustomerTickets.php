<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class CustomerTickets
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List support tickets**
     *
     * The buyer's support tickets at the store, the latest message first. `status` is `open` (waiting on the store), `answered` or `resolved`. `meta.on` is whether the store takes tickets (off, the list is empty and nothing can be opened), `meta.canOpen` whether the buyer may open one now (one open ticket at a time), `meta.orders` the orders a ticket can be about, each with its `label`, and `meta.limits` what a message may hold.
     *
     * Needs the buyer's token: `Authorization: Bearer shoply_ct_...`, from Sign in with the code.
     *
     * It is counted for the buyer's token: 300 reads in ten minutes.
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     orderId: string,
     *     subject: string,
     *     status: string,
     *     messages: int|float,
     *     pictures: int|float,
     *     lastMessageAt: string,
     *     lastFrom: string,
     *     lastLine: string,
     *     firstReplyAt: string,
     *     answeredAt: string,
     *     resolvedAt: mixed,
     *     resolvedBy: mixed,
     *     createdAt: string,
     *     updatedAt: string
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customer-api/list-support-tickets
     */
    public function list(array $options = []): mixed
    {
        return $this->caller->call('customer.tickets.list', [], [], $options);
    }

    /**
     * **Open a support ticket**
     *
     * Opens a ticket with its first message, which the store is told of. One open ticket a buyer at a time (`ticket_open`), 250 open at a store (`store_full`), and 100 messages a day a buyer (`daily_limit`). Refused with `tickets_off` where the store takes none. Pictures are sent from the customer panel. Answers the ticket as Get a support ticket does, and the list in `meta`.
     *
     * Needs the buyer's token: `Authorization: Bearer shoply_ct_...`, from Sign in with the code.
     *
     * It is counted for the buyer's token: 30 changes in ten minutes.
     *
     * Fields:
     *
     * - `subject` (required): What it is about, up to 100 characters.
     * - `message` (required): The first message, up to 500 characters.
     * - `order`: The order it is about, one of `meta.orders` on List support tickets. Left out, something else.
     *
     * @param array{
     *     subject: string,
     *     message: string,
     *     order?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     orderId: string,
     *     subject: string,
     *     status: string,
     *     messages: int|float,
     *     pictures: int|float,
     *     lastMessageAt: string,
     *     lastFrom: string,
     *     lastLine: string,
     *     firstReplyAt: mixed,
     *     answeredAt: mixed,
     *     resolvedAt: mixed,
     *     resolvedBy: mixed,
     *     createdAt: string,
     *     updatedAt: string,
     *     conversation: list<array{
     *         id: string,
     *         from: string,
     *         body: string,
     *         html: string,
     *         pictures: array<mixed>,
     *         createdAt: string
     *     }>,
     *     canReopenUntil: mixed,
     *     limits: array{
     *         body: int|float,
     *         subject: int|float,
     *         picturesPerMessage: int|float,
     *         picturesPerTicket: int|float,
     *         pictureBytes: int|float
     *     },
     *     orderLabel: string,
     *     orderProducts: list<string>,
     *     orderMore: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customer-api/open-a-support-ticket
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('customer.tickets.create', [], $params, $options);
    }

    /**
     * **Get a support ticket**
     *
     * A ticket with its `conversation`, oldest first: each message's `from` (`buyer` or `store`), `body` (Markdown, as written), `html` (the body as Markdown draws it, escaped, which is safe to show as it is), `pictures` and `createdAt`. A picture is named here and shown in the customer panel. `canReopenUntil` is the last moment writing on a resolved ticket opens it again.
     *
     * Needs the buyer's token: `Authorization: Bearer shoply_ct_...`, from Sign in with the code.
     *
     * It is counted for the buyer's token: 300 reads in ten minutes.
     *
     * @param string $ticketId One of the buyer's support tickets, from List support tickets.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     orderId: string,
     *     subject: string,
     *     status: string,
     *     messages: int|float,
     *     pictures: int|float,
     *     lastMessageAt: string,
     *     lastFrom: string,
     *     lastLine: string,
     *     firstReplyAt: string,
     *     answeredAt: string,
     *     resolvedAt: mixed,
     *     resolvedBy: mixed,
     *     createdAt: string,
     *     updatedAt: string,
     *     conversation: list<array{
     *         id: string,
     *         from: string,
     *         body: string,
     *         html: string,
     *         pictures: array<mixed>,
     *         createdAt: string
     *     }>,
     *     canReopenUntil: mixed,
     *     limits: array{
     *         body: int|float,
     *         subject: int|float,
     *         picturesPerMessage: int|float,
     *         picturesPerTicket: int|float,
     *         pictureBytes: int|float
     *     },
     *     orderLabel: string,
     *     orderProducts: list<string>,
     *     orderMore: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customer-api/get-a-support-ticket
     */
    public function show(string $ticketId, array $options = []): mixed
    {
        return $this->caller->call('customer.tickets.show', [$ticketId], [], $options);
    }

    /**
     * **Write on a support ticket**
     *
     * Writes on the ticket as the buyer, which the store is told of. On a resolved ticket within 30 days it opens it again, if the buyer has no other open ticket; after that, `too_old`. Answers the ticket.
     *
     * Needs the buyer's token: `Authorization: Bearer shoply_ct_...`, from Sign in with the code.
     *
     * It is counted for the buyer's token: 30 changes in ten minutes.
     *
     * Fields:
     *
     * - `message` (required): The message, up to 500 characters.
     *
     * @param string $ticketId One of the buyer's support tickets, from List support tickets.
     * @param array{
     *     message: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     orderId: string,
     *     subject: string,
     *     status: string,
     *     messages: int|float,
     *     pictures: int|float,
     *     lastMessageAt: string,
     *     lastFrom: string,
     *     lastLine: string,
     *     firstReplyAt: string,
     *     answeredAt: string,
     *     resolvedAt: mixed,
     *     resolvedBy: mixed,
     *     createdAt: string,
     *     updatedAt: string,
     *     conversation: list<array{
     *         id: string,
     *         from: string,
     *         body: string,
     *         html: string,
     *         pictures: array<mixed>,
     *         createdAt: string
     *     }>,
     *     canReopenUntil: mixed,
     *     limits: array{
     *         body: int|float,
     *         subject: int|float,
     *         picturesPerMessage: int|float,
     *         picturesPerTicket: int|float,
     *         pictureBytes: int|float
     *     },
     *     orderLabel: string,
     *     orderProducts: list<string>,
     *     orderMore: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customer-api/write-on-a-support-ticket
     */
    public function reply(string $ticketId, array $params, array $options = []): mixed
    {
        return $this->caller->call('customer.tickets.reply', [$ticketId], $params, $options);
    }

    /**
     * **Resolve a support ticket**
     *
     * Marks the buyer's ticket resolved, as their "Mark as Resolved" does. Answers the ticket.
     *
     * Needs the buyer's token: `Authorization: Bearer shoply_ct_...`, from Sign in with the code.
     *
     * It is counted for the buyer's token: 30 changes in ten minutes.
     *
     * @param string $ticketId One of the buyer's support tickets, from List support tickets.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     orderId: string,
     *     subject: string,
     *     status: string,
     *     messages: int|float,
     *     pictures: int|float,
     *     lastMessageAt: string,
     *     lastFrom: string,
     *     lastLine: string,
     *     firstReplyAt: string,
     *     answeredAt: string,
     *     resolvedAt: string,
     *     resolvedBy: string,
     *     createdAt: string,
     *     updatedAt: string,
     *     conversation: list<array{
     *         id: string,
     *         from: string,
     *         body: string,
     *         html: string,
     *         pictures: array<mixed>,
     *         createdAt: string
     *     }>,
     *     canReopenUntil: string,
     *     limits: array{
     *         body: int|float,
     *         subject: int|float,
     *         picturesPerMessage: int|float,
     *         picturesPerTicket: int|float,
     *         pictureBytes: int|float
     *     },
     *     orderLabel: string,
     *     orderProducts: list<string>,
     *     orderMore: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customer-api/resolve-a-support-ticket
     */
    public function resolve(string $ticketId, array $options = []): mixed
    {
        return $this->caller->call('customer.tickets.resolve', [$ticketId], [], $options);
    }
}
