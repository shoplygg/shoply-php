<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class ResellerTopUps
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List top-ups**
     *
     * Money resellers put on their balance, paid on the store's checkout with its own payment methods, newest first, 25 a page. `state` is `paid`, `waiting` (for the reseller to pay), `checking` (paid with one of the store's custom methods, and waiting for the store), `expired` (not paid in the store's unpaid order time) or `taken_back` (its payment was taken back by the bank, and came off the balance). A top-up's `id` is the order it is paid with. `meta.counts` is how many in each state, and `meta.figures` the last 30 days'.
     *
     * Needs the `resellers.read` permission (Read Resellers).
     *
     * Fields:
     *
     * - `q`: Only what matches this text: an order's ID, a reseller's website, or who bought or paid.
     * - `reseller`: Only one reseller's, by their ID.
     * - `status`: Only those in one state.
     * - `page`: Which page of the list. The first is 1. Left out, it is 1.
     *
     * @param array{
     *     q?: string,
     *     reseller?: string,
     *     status?: 'paid'|'waiting'|'checking'|'expired'|'taken_back',
     *     page?: int
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\Page<array{
     *     id: string,
     *     resellerId: string,
     *     reseller: string,
     *     resellerRemoved: bool,
     *     paidBy: string,
     *     amount: int|float,
     *     currency: string,
     *     state: string,
     *     method: string,
     *     createdAt: string,
     *     paidAt: mixed
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/list-top-ups
     */
    public function list(array $params = [], array $options = []): \Shoply\Page
    {
        return $this->caller->call('resellerTopUps.list', [], $params, $options);
    }

    /**
     * **Export top-ups**
     *
     * The top-ups the same filters would list, as a CSV file: Top-up ID, Reseller, Paid By, Amount, Currency, Paid With, Status, Opened and Paid. Every row the filters match is in the file, up to 50,000, sent as it is read. Add `check=1` for `{ rows }`, how many it would have, which is not counted. A store exports at most 30 files every 10 minutes, whatever they are of, whoever asks: after that the answer is 429.
     *
     * Needs the `resellers.read` permission (Read Resellers). It is one of the heavier reads, and is counted against a smaller budget of its own: 60 a minute for each key.
     *
     * Fields:
     *
     * - `q`: Only what matches this text: an order's ID, a reseller's website, or who bought or paid.
     * - `reseller`: Only one reseller's, by their ID.
     * - `status`: Only those in one state.
     * - `check`: `1` for how many rows the file would have, as `{ rows }`, in place of the file.
     *
     * @param array{
     *     q?: string,
     *     reseller?: string,
     *     status?: 'paid'|'waiting'|'checking'|'expired'|'taken_back',
     *     check?: '1'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\File
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/export-top-ups
     */
    public function export(array $params = [], array $options = []): \Shoply\File
    {
        return $this->caller->call('resellerTopUps.export', [], $params, $options);
    }

    /**
     * **Get a top-up's custom payment**
     *
     * A top-up paid with one of the store's custom methods: the method, what the reseller sent with it (a reference, a picture) and where it stands (`status` `review` while it waits for the store). Null for a top-up paid any other way. `meta.gateway` is the method.
     *
     * Needs the `resellers.read` permission (Read Resellers).
     *
     * @param string $topUpId The top-up: the ID of the order it was paid with, as List top-ups answers it.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     method: string,
     *     kind: string,
     *     status: string,
     *     asksProof: bool,
     *     requiresPicture: bool,
     *     amount: int|float,
     *     currency: string,
     *     proof: array{
     *         reference: string,
     *         picture: bool,
     *         at: string
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/get-a-top-ups-custom-payment
     */
    public function payment(string $topUpId, array $options = []): mixed
    {
        return $this->caller->call('resellerTopUps.payment', [$topUpId], [], $options);
    }

    /**
     * **Get a top-up's proof of payment**
     *
     * The picture a reseller sent with a custom payment, as the file itself: a PNG, JPEG or WebP. 404 where the top-up has none.
     *
     * Needs the `resellers.read` permission (Read Resellers).
     *
     * @param string $topUpId The top-up: the ID of the order it was paid with, as List top-ups answers it.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\File
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/get-a-top-ups-proof-of-payment
     */
    public function proof(string $topUpId, array $options = []): \Shoply\File
    {
        return $this->caller->call('resellerTopUps.proof', [$topUpId], [], $options);
    }

    /**
     * **Approve a top-up's custom payment**
     *
     * Says the money a reseller sent with one of the store's custom methods arrived, and puts the top-up on their balance. Shoply never sees that money: check it reached you first. Refused with `payment_not_approved` where there is nothing to approve. Send an `Idempotency-Key` with this request.
     *
     * Needs the `resellers.balance` permission (Change Reseller Balances).
     *
     * @param string $topUpId The top-up: the ID of the order it was paid with, as List top-ups answers it.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     state: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/approve-a-top-ups-custom-payment
     */
    public function approve(string $topUpId, array $options = []): mixed
    {
        return $this->caller->call('resellerTopUps.approve', [$topUpId], [], $options);
    }

    /**
     * **Reject a top-up's custom payment**
     *
     * Cancels the top-up, and nothing goes on the balance. The reseller is not emailed. Refused with `payment_not_rejected` where there is nothing to reject.
     *
     * Needs the `resellers.balance` permission (Change Reseller Balances).
     *
     * @param string $topUpId The top-up: the ID of the order it was paid with, as List top-ups answers it.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     state: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/reject-a-top-ups-custom-payment
     */
    public function reject(string $topUpId, array $options = []): mixed
    {
        return $this->caller->call('resellerTopUps.reject', [$topUpId], [], $options);
    }

    /**
     * **Mark a top-up as paid**
     *
     * A top-up waiting for payment or expired goes onto the reseller's balance as if its payment had arrived, for money that reached you another way. It cannot be undone. Refused with `top_up_not_payable` for one paid already or taken back, and for one whose custom payment waits for you: approve or reject that instead. Send an `Idempotency-Key` with this request.
     *
     * Needs the `resellers.balance` permission (Change Reseller Balances).
     *
     * @param string $topUpId The top-up: the ID of the order it was paid with, as List top-ups answers it.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     state: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/mark-a-top-up-as-paid
     */
    public function markPaid(string $topUpId, array $options = []): mixed
    {
        return $this->caller->call('resellerTopUps.markPaid', [$topUpId], [], $options);
    }
}
