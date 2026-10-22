<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Tickets
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List support tickets**
     *
     * The store's tickets, the latest message first. `status` is `open` (the buyer wrote last: Waiting on You on the dashboard), `answered` (the store did) or `resolved`, with `resolvedBy`: `store`, `buyer`, or `auto` (48 hours after the store's reply with no word from the buyer). `lastFrom` and `lastLine` are the latest message's author and first words, `unread` whether the store has opened it since the buyer last wrote, and `orderId` the order it is about, where the buyer picked one. `meta.on` is whether the store takes tickets (off, buyers can open none and the panel shows no Support), and `meta.figures` the dashboard's four: tickets waiting on the store and when the oldest was written, open ones, the average minutes to a first reply over the last 30 days and the 30 before, and how many were resolved in the last 30 days.
     *
     * Needs the `tickets.read` permission (Read Support Tickets).
     *
     * Fields:
     *
     * - `show`: Only these: `unresolved` is `open` and `answered` together. Left out, it is "all".
     * - `search`: Part of the subject, the buyer's email or the latest message, or the start of the ticket's or the order's ID.
     * - `page`: Which page of the list. The first is 1. Left out, it is 1.
     * - `perPage`: How many a page holds, up to 100. Left out, it is 25.
     *
     * @param array{
     *     show?: 'all'|'unresolved'|'open'|'answered'|'resolved',
     *     search?: string,
     *     page?: int,
     *     perPage?: int
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\Page<array{
     *     id: string,
     *     email: string,
     *     customerId: mixed,
     *     orderId: string,
     *     subject: string,
     *     status: string,
     *     messages: int|float,
     *     pictures: int|float,
     *     lastMessageAt: string,
     *     lastFrom: string,
     *     lastLine: string,
     *     unread: bool,
     *     firstReplyAt: mixed,
     *     answeredAt: mixed,
     *     resolvedAt: mixed,
     *     resolvedBy: mixed,
     *     createdAt: string,
     *     updatedAt: string
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/support-tickets/list-support-tickets
     */
    public function list(array $params = [], array $options = []): \Shoply\Page
    {
        return $this->caller->call('tickets.list', [], $params, $options);
    }

    /**
     * **Switch Support Tickets on or off**
     *
     * Off for every store until switched on. Off, buyers can open no ticket and write on none, the customer panel shows no Support, and the store can resolve and reopen but not reply. The tickets are kept.
     *
     * Needs the `tickets.write` permission (Answer Support Tickets).
     *
     * Fields:
     *
     * - `on` (required): Whether buyers can open tickets.
     *
     * @param array{
     *     on: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     on: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/support-tickets/switch-support-tickets-on-or-off
     */
    public function settings(array $params, array $options = []): mixed
    {
        return $this->caller->call('tickets.settings', [], $params, $options);
    }

    /**
     * **Get a support ticket**
     *
     * A ticket with its `conversation`, oldest first: each message's `from` (`buyer` or `store`), `body`, `pictures` (each one's `name` and the `url` the dashboard reads it at; read it with Get a ticket's picture) and `createdAt`. `customer` is who wrote it, with their tags, `order` the order it is about, `orders` their five latest, and `canReopenUntil` the last moment the buyer can open a resolved ticket again by writing on it. Reading a ticket marks it read, as opening it on the dashboard does.
     *
     * Needs the `tickets.read` permission (Read Support Tickets).
     *
     * @param string $ticketId The ticket, by its ID.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     email: string,
     *     customerId: mixed,
     *     orderId: string,
     *     subject: string,
     *     status: string,
     *     messages: int|float,
     *     pictures: int|float,
     *     lastMessageAt: string,
     *     lastFrom: string,
     *     lastLine: string,
     *     unread: bool,
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
     *     customer: array{
     *         id: mixed,
     *         email: string,
     *         tags: array<mixed>
     *     },
     *     order: array{
     *         id: string,
     *         status: string,
     *         amount: string
     *     },
     *     orders: list<array{
     *         id: string,
     *         status: string,
     *         amount: string,
     *         products: list<string>,
     *         createdAt: string
     *     }>,
     *     on: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/support-tickets/get-a-support-ticket
     */
    public function get(string $ticketId, array $options = []): mixed
    {
        return $this->caller->call('tickets.get', [$ticketId], [], $options);
    }

    /**
     * **Reply to a support ticket**
     *
     * Writes on the ticket as the store, which the buyer reads in their customer panel and is emailed (at most once a ticket in 15 minutes; what is written meanwhile follows when they are over). A reply to a resolved ticket opens it again, unless `resolve` is true. Refused with `tickets_off` while the store takes no tickets, since the buyer could not read it. Answers the ticket as Get a support ticket does.
     *
     * Needs the `tickets.write` permission (Answer Support Tickets).
     *
     * Fields:
     *
     * - `message` (required): The reply, up to 500 characters.
     * - `resolve`: Mark the ticket resolved with the reply. Left out, it is false.
     *
     * @param string $ticketId The ticket, by its ID.
     * @param array{
     *     message: string,
     *     resolve?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     email: string,
     *     customerId: mixed,
     *     orderId: string,
     *     subject: string,
     *     status: string,
     *     messages: int|float,
     *     pictures: int|float,
     *     lastMessageAt: string,
     *     lastFrom: string,
     *     lastLine: string,
     *     unread: bool,
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
     *     customer: array{
     *         id: mixed,
     *         email: string,
     *         tags: array<mixed>
     *     },
     *     order: array{
     *         id: string,
     *         status: string,
     *         amount: string
     *     },
     *     orders: list<array{
     *         id: string,
     *         status: string,
     *         amount: string,
     *         products: list<string>,
     *         createdAt: string
     *     }>,
     *     on: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/support-tickets/reply-to-a-support-ticket
     */
    public function reply(string $ticketId, array $params, array $options = []): mixed
    {
        return $this->caller->call('tickets.reply', [$ticketId], $params, $options);
    }

    /**
     * **Resolve a support ticket**
     *
     * Marks it resolved, by the store. The buyer can still write on it for 30 days, which opens it again. One already resolved is left as it is.
     *
     * Needs the `tickets.write` permission (Answer Support Tickets).
     *
     * @param string $ticketId The ticket, by its ID.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     email: string,
     *     customerId: mixed,
     *     orderId: string,
     *     subject: string,
     *     status: string,
     *     messages: int|float,
     *     pictures: int|float,
     *     lastMessageAt: string,
     *     lastFrom: string,
     *     lastLine: string,
     *     unread: bool,
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
     *     customer: array{
     *         id: mixed,
     *         email: string,
     *         tags: array<mixed>
     *     },
     *     order: array{
     *         id: string,
     *         status: string,
     *         amount: string
     *     },
     *     orders: list<array{
     *         id: string,
     *         status: string,
     *         amount: string,
     *         products: list<string>,
     *         createdAt: string
     *     }>,
     *     on: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/support-tickets/resolve-a-support-ticket
     */
    public function resolve(string $ticketId, array $options = []): mixed
    {
        return $this->caller->call('tickets.resolve', [$ticketId], [], $options);
    }

    /**
     * **Reopen a support ticket**
     *
     * Opens a resolved ticket again: `open` where the buyer wrote last, else `answered`. One that is not resolved is left as it is.
     *
     * Needs the `tickets.write` permission (Answer Support Tickets).
     *
     * @param string $ticketId The ticket, by its ID.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     email: string,
     *     customerId: mixed,
     *     orderId: string,
     *     subject: string,
     *     status: string,
     *     messages: int|float,
     *     pictures: int|float,
     *     lastMessageAt: string,
     *     lastFrom: string,
     *     lastLine: string,
     *     unread: bool,
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
     *     customer: array{
     *         id: mixed,
     *         email: string,
     *         tags: array<mixed>
     *     },
     *     order: array{
     *         id: string,
     *         status: string,
     *         amount: string
     *     },
     *     orders: list<array{
     *         id: string,
     *         status: string,
     *         amount: string,
     *         products: list<string>,
     *         createdAt: string
     *     }>,
     *     on: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/support-tickets/reopen-a-support-ticket
     */
    public function reopen(string $ticketId, array $options = []): mixed
    {
        return $this->caller->call('tickets.reopen', [$ticketId], [], $options);
    }

    /**
     * **Get a ticket's picture**
     *
     * A picture sent in the conversation: a PNG, JPEG or WebP of up to 5 MB, read out of the picture itself when it was sent.
     *
     * Needs the `tickets.read` permission (Read Support Tickets).
     *
     * @param string $ticketId The ticket, by its ID.
     * @param string $name The picture's `name`, as the conversation has it.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\File
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/support-tickets/get-a-tickets-picture
     */
    public function picture(string $ticketId, string $name, array $options = []): \Shoply\File
    {
        return $this->caller->call('tickets.picture', [$ticketId, $name], [], $options);
    }
}
