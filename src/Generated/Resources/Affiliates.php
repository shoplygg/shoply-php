<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Affiliates
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List affiliates**
     *
     * Every affiliate of the store, each with their link, their rates, what their link has led to, what they have earned and what they are owed. `meta.totals` adds them up, and `meta.programme` is the programme's settings. A store holds up to 500, so the list is not paged.
     *
     * Needs the `affiliates.read` permission (Read Affiliates).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     customerId: string,
     *     email: string,
     *     code: string,
     *     link: string,
     *     commission: int|float,
     *     discount: int|float,
     *     active: bool,
     *     clicks: int|float,
     *     orders: int|float,
     *     revenue: int|float,
     *     earned: int|float,
     *     balance: int|float,
     *     requested: int|float,
     *     paidOut: int|float,
     *     paidAsCredit: int|float,
     *     joinedThemselves: bool,
     *     dateCreated: string
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/affiliates/list-affiliates
     */
    public function list(array $options = []): mixed
    {
        return $this->caller->call('affiliates.list', [], [], $options);
    }

    /**
     * **Create an affiliate**
     *
     * Makes a customer of the store an affiliate, with a link of their own. The address has to be a customer already: create the customer first if it is not.
     *
     * Needs the `affiliates.write` permission (Change Affiliates).
     *
     * Fields:
     *
     * - `customer` (required): The customer's email address.
     * - `code`: What their link ends in: 2 to 40 letters, digits and dashes. One affiliate a code in a store.
     * - `commission`: The share of each order they earn, in percent: above 0, up to 90. It is taken on what the buyer paid for the products, after every discount, before fees and tax.
     * - `discount`: What their link takes off for the buyer, in percent: 0 to 90. Left out, it is 0.
     * - `active`: Whether their link works. Switched off, it takes nothing off and earns nothing.
     *
     * @param array{
     *     customer: string,
     *     code?: string,
     *     commission?: int|float,
     *     discount?: int|float,
     *     active?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     customerId: string,
     *     email: string,
     *     code: string,
     *     link: string,
     *     commission: int|float,
     *     discount: int|float,
     *     active: bool,
     *     clicks: int|float,
     *     orders: int|float,
     *     revenue: int|float,
     *     earned: int|float,
     *     balance: int|float,
     *     requested: int|float,
     *     paidOut: int|float,
     *     paidAsCredit: int|float,
     *     joinedThemselves: bool,
     *     dateCreated: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/affiliates/create-an-affiliate
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('affiliates.create', [], $params, $options);
    }

    /**
     * **Update an affiliate**
     *
     * Changes an affiliate's code, rates or whether their link works. Only what is sent changes.
     *
     * Needs the `affiliates.write` permission (Change Affiliates).
     *
     * Fields:
     *
     * - `code`: What their link ends in: 2 to 40 letters, digits and dashes. One affiliate a code in a store.
     * - `commission`: The share of each order they earn, in percent: above 0, up to 90. It is taken on what the buyer paid for the products, after every discount, before fees and tax.
     * - `discount`: What their link takes off for the buyer, in percent: 0 to 90. Left out, it is 0.
     * - `active`: Whether their link works. Switched off, it takes nothing off and earns nothing.
     *
     * @param string $affiliateId The affiliate.
     * @param array{
     *     code?: string,
     *     commission?: int|float,
     *     discount?: int|float,
     *     active?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     customerId: string,
     *     email: string,
     *     code: string,
     *     link: string,
     *     commission: int|float,
     *     discount: int|float,
     *     active: bool,
     *     clicks: int|float,
     *     orders: int|float,
     *     revenue: int|float,
     *     earned: int|float,
     *     balance: int|float,
     *     requested: int|float,
     *     paidOut: int|float,
     *     paidAsCredit: int|float,
     *     joinedThemselves: bool,
     *     dateCreated: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/affiliates/update-an-affiliate
     */
    public function update(string $affiliateId, array $params = [], array $options = []): mixed
    {
        return $this->caller->call('affiliates.update', [$affiliateId], $params, $options);
    }

    /**
     * **Delete an affiliate**
     *
     * Removes an affiliate who has earned nothing. One who has earned commission is refused with `affiliate_has_earned`: switch them off instead, so that what an order earned is still on record if that order is refunded later. Answers the affiliates that are left.
     *
     * Needs the `affiliates.write` permission (Change Affiliates).
     *
     * @param string $affiliateId The affiliate.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     customerId: string,
     *     email: string,
     *     code: string,
     *     link: string,
     *     commission: int|float,
     *     discount: int|float,
     *     active: bool,
     *     clicks: int|float,
     *     orders: int|float,
     *     revenue: int|float,
     *     earned: int|float,
     *     balance: int|float,
     *     requested: int|float,
     *     paidOut: int|float,
     *     paidAsCredit: int|float,
     *     joinedThemselves: bool,
     *     dateCreated: string
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/affiliates/delete-an-affiliate
     */
    public function delete(string $affiliateId, array $options = []): mixed
    {
        return $this->caller->call('affiliates.delete', [$affiliateId], [], $options);
    }

    /**
     * **Change an affiliate's balance**
     *
     * Adds to, takes from or sets what an affiliate is owed. Send an `Idempotency-Key` with this request.
     *
     * Needs the `affiliates.payouts` permission (Answer Payouts).
     *
     * Fields:
     *
     * - `mode` (required): Add to it, take from it, or set it to exactly this.
     * - `amount` (required): How much, in the store's currency, with at most 2 decimals.
     * - `note`: Why, up to 500 characters. Kept in the balance's history.
     *
     * @param string $affiliateId The affiliate.
     * @param array{
     *     mode: 'add'|'subtract'|'set',
     *     amount: int|float,
     *     note?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     customerId: string,
     *     email: string,
     *     code: string,
     *     link: string,
     *     commission: int|float,
     *     discount: int|float,
     *     active: bool,
     *     clicks: int|float,
     *     orders: int|float,
     *     revenue: int|float,
     *     earned: int|float,
     *     balance: int|float,
     *     requested: int|float,
     *     paidOut: int|float,
     *     paidAsCredit: int|float,
     *     joinedThemselves: bool,
     *     dateCreated: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/affiliates/change-an-affiliates-balance
     */
    public function setBalance(string $affiliateId, array $params, array $options = []): mixed
    {
        return $this->caller->call('affiliates.setBalance', [$affiliateId], $params, $options);
    }

    /**
     * **Get an affiliate's history**
     *
     * One affiliate's balance line by line (`changes`), and the payouts they have asked for (`payouts`).
     *
     * Needs the `affiliates.read` permission (Read Affiliates).
     *
     * @param string $affiliateId The affiliate.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     changes: list<array{
     *         id: string,
     *         kind: string,
     *         amount: int|float,
     *         balanceAfter: int|float,
     *         currencyCode: string,
     *         dateCreated: string,
     *         note: string,
     *         orderId: mixed,
     *         by: string
     *     }>,
     *     payouts: array<mixed>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/affiliates/get-an-affiliates-history
     */
    public function history(string $affiliateId, array $options = []): mixed
    {
        return $this->caller->call('affiliates.history', [$affiliateId], [], $options);
    }

    /**
     * **List referred orders**
     *
     * The orders that came through affiliates' links, newest first, each with what it earned. `state` is `credited` (paid, and the commission is on the affiliate's balance), `waiting` (not paid yet) or `back` (refunded or charged back, and the commission taken back).
     *
     * Needs the `affiliates.read` permission (Read Affiliates).
     *
     * Fields:
     *
     * - `page`: Which page of the list. The first is 1. Left out, it is 1.
     * - `perPage`: How many a page holds. Left out, it is 25.
     * - `affiliate`: Only one affiliate's orders, by the affiliate's ID.
     *
     * @param array{
     *     page?: int,
     *     perPage?: int,
     *     affiliate?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\Page<mixed>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/affiliates/list-referred-orders
     */
    public function orders(array $params = [], array $options = []): \Shoply\Page
    {
        return $this->caller->call('affiliates.orders', [], $params, $options);
    }

    /**
     * **List payout requests**
     *
     * The payouts affiliates have asked for, the ones still waiting first. A payout is a request and a record: the affiliate says how they want to be paid, and the store pays it itself. Shoply sends no money.
     *
     * Needs the `affiliates.read` permission (Read Affiliates).
     *
     * Fields:
     *
     * - `page`: Which page of the list. The first is 1. Left out, it is 1.
     * - `perPage`: How many a page holds. Left out, it is 25.
     * - `status`: Only payouts in this status.
     *
     * @param array{
     *     page?: int,
     *     perPage?: int,
     *     status?: 'requested'|'paid'|'declined'|'cancelled'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\Page<mixed>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/affiliates/list-payout-requests
     */
    public function payouts(array $params = [], array $options = []): \Shoply\Page
    {
        return $this->caller->call('affiliates.payouts', [], $params, $options);
    }

    /**
     * **Answer a payout request**
     *
     * Marks a payout as paid, which records that you paid it yourself, or declines it, which puts the amount back on the affiliate's balance. A payout that was already answered is refused with `payout_answered`. Answers the store's affiliates as they now stand.
     *
     * Needs the `affiliates.payouts` permission (Answer Payouts).
     *
     * Fields:
     *
     * - `action` (required): What became of it.
     * - `note`: For a declined payout, the reason. The affiliate reads it. Up to 500 characters.
     *
     * @param string $payoutId The payout request.
     * @param array{
     *     action: 'paid'|'declined',
     *     note?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/affiliates/answer-a-payout-request
     */
    public function answerPayout(string $payoutId, array $params, array $options = []): mixed
    {
        return $this->caller->call('affiliates.answerPayout', [$payoutId], $params, $options);
    }

    /**
     * **Ask for a payout for an affiliate**
     *
     * Asks for a payout in an affiliate's name, for a panel of your own where they sign in with you. The amount leaves their balance now and is held until you answer the request; declined or taken back, it returns. One request at a time, and never more than they are owed. Refused with `payout_refused` while the programme is off or does not take payout requests. Answers the request (`payout`) and what the affiliate is still owed (`balance`).
     *
     * Needs the `affiliates.payouts` permission (Answer Payouts).
     *
     * Fields:
     *
     * - `amount` (required): How much, above zero and up to what the affiliate is owed.
     * - `details` (required): How they want to be paid, in their own words. Up to 300 characters.
     *
     * @param string $affiliateId The affiliate.
     * @param array{
     *     amount: int|float,
     *     details: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/affiliates/ask-for-a-payout-for-an-affiliate
     */
    public function askPayout(string $affiliateId, array $params, array $options = []): mixed
    {
        return $this->caller->call('affiliates.askPayout', [$affiliateId], $params, $options);
    }

    /**
     * **Take back a payout request**
     *
     * Takes back a request that has not been answered, and puts its amount back on the affiliate's balance. One that was already answered is refused with `payout_answered`.
     *
     * Needs the `affiliates.payouts` permission (Answer Payouts).
     *
     * @param string $affiliateId The affiliate.
     * @param string $payoutId The payout request.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/affiliates/take-back-a-payout-request
     */
    public function withdrawPayout(string $affiliateId, string $payoutId, array $options = []): mixed
    {
        return $this->caller->call('affiliates.withdrawPayout', [$affiliateId, $payoutId], [], $options);
    }

    /**
     * **Move commission to store balance**
     *
     * Moves what an affiliate is owed onto their balance at the store, to spend at checkout. It counts as paid out. What lands is what leaves: where the store balance is near its ceiling, less than was asked for moves, and `moved` says how much. Refused with `move_refused` while the programme is off or does not move commission to store balance.
     *
     * The key needs the `customers.balance` permission as well, since this adds to a customer's balance. Send an `Idempotency-Key` with this request.
     *
     * Needs the `affiliates.payouts` permission (Answer Payouts).
     *
     * Fields:
     *
     * - `amount` (required): How much, above zero and up to what the affiliate is owed.
     *
     * @param string $affiliateId The affiliate.
     * @param array{
     *     amount: int|float
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/affiliates/move-commission-to-store-balance
     */
    public function toStoreBalance(string $affiliateId, array $params, array $options = []): mixed
    {
        return $this->caller->call('affiliates.toStoreBalance', [$affiliateId], $params, $options);
    }
}
