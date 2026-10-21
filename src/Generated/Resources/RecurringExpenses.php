<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class RecurringExpenses
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List recurring expenses**
     *
     * The expenses that come round every month or year, with the day each is next due. A store holds up to 100. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `expenses.read` permission (Read Expenses).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     payee: string,
     *     note: string,
     *     category: mixed,
     *     method: string,
     *     reference: string,
     *     amount: int|float,
     *     cadence: string,
     *     onDay: int|float,
     *     nextOn: string,
     *     asks: bool,
     *     paused: bool,
     *     waiting: bool,
     *     updatedAt: string
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/expense-setup/list-recurring-expenses
     */
    public function list(array $options = []): mixed
    {
        return $this->caller->call('recurringExpenses.list', [], [], $options);
    }

    /**
     * **Create a recurring expense**
     *
     * Adds an expense that comes round. When it falls due it waits to be answered: paid, or skipped this once. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `expenses.write` permission (Change Expenses).
     *
     * Fields:
     *
     * - `payee` (required): Who is paid, up to 120 characters.
     * - `amount` (required): How much each time, in the store's currency.
     * - `cadence` (required): How often it comes round.
     * - `nextOn` (required): The day it is next due, as `YYYY-MM-DD`.
     * - `method`: How it is paid.
     * - `categoryId`: The expense category it is filed in.
     * - `note`: A note, up to 255 characters.
     * - `reference`: A reference, up to 160 characters.
     *
     * @param array{
     *     payee: string,
     *     amount: int|float,
     *     cadence: 'month'|'year',
     *     nextOn: string,
     *     method?: 'card'|'bank'|'crypto'|'paypal'|'cash'|'other',
     *     categoryId?: string,
     *     note?: string,
     *     reference?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     payee: string,
     *     note: string,
     *     category: mixed,
     *     method: string,
     *     reference: string,
     *     amount: int|float,
     *     cadence: string,
     *     onDay: int|float,
     *     nextOn: string,
     *     asks: bool,
     *     paused: bool,
     *     waiting: bool,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/expense-setup/create-a-recurring-expense
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('recurringExpenses.create', [], $params, $options);
    }

    /**
     * **Update a recurring expense**
     *
     * Changes a recurring expense. A field left out stays as it is. The expenses it has already written are not changed. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `expenses.write` permission (Change Expenses).
     *
     * Fields:
     *
     * - `payee` (required): Who is paid, up to 120 characters.
     * - `amount` (required): How much each time, in the store's currency.
     * - `cadence` (required): How often it comes round.
     * - `nextOn` (required): The day it is next due, as `YYYY-MM-DD`.
     * - `method`: How it is paid.
     * - `categoryId`: The expense category it is filed in.
     * - `note`: A note, up to 255 characters.
     * - `reference`: A reference, up to 160 characters.
     *
     * @param string $recurringId The recurring expense.
     * @param array{
     *     payee: string,
     *     amount: int|float,
     *     cadence: 'month'|'year',
     *     nextOn: string,
     *     method?: 'card'|'bank'|'crypto'|'paypal'|'cash'|'other',
     *     categoryId?: string,
     *     note?: string,
     *     reference?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     payee: string,
     *     note: string,
     *     category: mixed,
     *     method: string,
     *     reference: string,
     *     amount: int|float,
     *     cadence: string,
     *     onDay: int|float,
     *     nextOn: string,
     *     asks: bool,
     *     paused: bool,
     *     waiting: bool,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/expense-setup/update-a-recurring-expense
     */
    public function update(string $recurringId, array $params, array $options = []): mixed
    {
        return $this->caller->call('recurringExpenses.update', [$recurringId], $params, $options);
    }

    /**
     * **Delete a recurring expense**
     *
     * Stops it coming round. The expenses it has already written stay. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `expenses.write` permission (Change Expenses).
     *
     * @param string $recurringId The recurring expense.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     deleted: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/expense-setup/delete-a-recurring-expense
     */
    public function delete(string $recurringId, array $options = []): mixed
    {
        return $this->caller->call('recurringExpenses.delete', [$recurringId], [], $options);
    }

    /**
     * **Mark a recurring expense as paid**
     *
     * Answers one that is due: it was paid. The expense is filed under the day it fell due, and the recurring expense moves to its next date. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `expenses.write` permission (Change Expenses).
     *
     * @param string $recurringId The recurring expense.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/expense-setup/mark-a-recurring-expense-as-paid
     */
    public function paid(string $recurringId, array $options = []): mixed
    {
        return $this->caller->call('recurringExpenses.paid', [$recurringId], [], $options);
    }

    /**
     * **Skip a recurring expense**
     *
     * Answers one that is due: not this time. Nothing is filed, and it moves to its next date. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `expenses.write` permission (Change Expenses).
     *
     * @param string $recurringId The recurring expense.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     recurring: array{
     *         id: string,
     *         payee: string,
     *         note: string,
     *         category: mixed,
     *         method: string,
     *         reference: string,
     *         amount: int|float,
     *         cadence: string,
     *         onDay: int|float,
     *         nextOn: string,
     *         asks: bool,
     *         paused: bool,
     *         waiting: bool,
     *         updatedAt: string
     *     },
     *     expense: mixed
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/expense-setup/skip-a-recurring-expense
     */
    public function skip(string $recurringId, array $options = []): mixed
    {
        return $this->caller->call('recurringExpenses.skip', [$recurringId], [], $options);
    }
}
