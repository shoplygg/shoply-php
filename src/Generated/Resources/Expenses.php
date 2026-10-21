<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Expenses
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List expenses**
     *
     * A period's expenses, newest first, up to 2,000 of them. `meta.totals` is what the expenses matched come to, counting every one, and `meta.groups` the same by category. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `expenses.read` permission (Read Expenses).
     *
     * Fields:
     *
     * - `range`: The period. Left out, it is "this_month".
     * - `from`: The first day of a period of your own, as `YYYY-MM-DD`. With `to`, in place of `range`.
     * - `to`: Its last day, as `YYYY-MM-DD`.
     * - `tz`: The time zone those days are in, as an IANA name. Left out, UTC.
     * - `search`: Part of a payee, a note or a reference.
     * - `category`: Only expenses in this expense category, by its ID.
     * - `method`: Only expenses paid this way.
     *
     * @param array{
     *     range?: 'today'|'yesterday'|'7d'|'30d'|'this_week'|'last_week'|'this_month'|'last_month'|'this_year',
     *     from?: string,
     *     to?: string,
     *     tz?: string,
     *     search?: string,
     *     category?: string,
     *     method?: 'card'|'bank'|'crypto'|'paypal'|'cash'|'other'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     spentOn: string,
     *     payee: string,
     *     note: string,
     *     category: array{
     *         id: string,
     *         name: string,
     *         icon: string
     *     },
     *     method: string,
     *     reference: string,
     *     amount: int|float,
     *     entered: mixed,
     *     productId: mixed,
     *     recurring: bool,
     *     source: string,
     *     receipt: mixed,
     *     createdAt: string,
     *     updatedAt: string
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/expenses/list-expenses
     */
    public function list(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('expenses.list', [], $params, $options);
    }

    /**
     * **Create an expense**
     *
     * Files an expense: what a bot paid a member of staff, a provider's invoice a script read. A store holds up to 50,000. A recurring expense is set up with its own route. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `expenses.write` permission (Change Expenses).
     *
     * Fields:
     *
     * - `spentOn` (required): The day it was paid, as `YYYY-MM-DD`. Not in the future: a bill still to come is a recurring expense.
     * - `payee` (required): Who was paid, up to 120 characters.
     * - `amount` (required): How much, above zero, with at most 2 decimals.
     * - `currency`: The currency `amount` is in, when it is not the store's own. It is converted at today's rate and kept in the store's currency.
     * - `method`: How it was paid.
     * - `categoryId`: The expense category it is filed in, by ID.
     * - `category`: The same, by the category's name, for a script that has no reason to know an ID. With neither, the store's rules file it.
     * - `note`: A note, up to 255 characters.
     * - `reference`: An invoice number or the like, up to 160 characters.
     * - `productId`: A product this expense is a cost of.
     *
     * @param array{
     *     spentOn: string,
     *     payee: string,
     *     amount: int|float,
     *     currency?: string,
     *     method?: 'card'|'bank'|'crypto'|'paypal'|'cash'|'other',
     *     categoryId?: string,
     *     category?: string,
     *     note?: string,
     *     reference?: string,
     *     productId?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     spentOn: string,
     *     payee: string,
     *     note: string,
     *     category: array{
     *         id: string,
     *         name: string,
     *         icon: string
     *     },
     *     method: string,
     *     reference: string,
     *     amount: int|float,
     *     entered: mixed,
     *     productId: mixed,
     *     recurring: bool,
     *     source: string,
     *     receipt: mixed,
     *     createdAt: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/expenses/create-an-expense
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('expenses.create', [], $params, $options);
    }

    /**
     * **Get an expense summary**
     *
     * A period's spending at a glance: the total beside the period before, what repeats, the largest category, how many have receipts, twelve months of totals and what is coming up. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `expenses.read` permission (Read Expenses). It is one of the heavier reads, and is counted against a smaller budget of its own: 60 a minute for each key.
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
     *     spent: int|float,
     *     previous: int|float,
     *     recurring: array{
     *         count: int|float,
     *         monthly: int|float
     *     },
     *     largest: array{
     *         name: string,
     *         icon: string,
     *         total: int|float,
     *         share: int|float
     *     },
     *     receipts: array{
     *         attached: int|float,
     *         total: int|float
     *     },
     *     months: list<array{
     *         month: string,
     *         total: int|float
     *     }>,
     *     comingUp: array<mixed>,
     *     counts: array{
     *         recurring: int|float,
     *         rules: int|float
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/expenses/get-an-expense-summary
     */
    public function summary(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('expenses.summary', [], $params, $options);
    }

    /**
     * **Get what an expense can be**
     *
     * What an expense is made from: the store's expense categories, who it has paid before, the ways of paying, the currencies an amount can be sent in, and every limit. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `expenses.read` permission (Read Expenses).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     currency: string,
     *     currencies: array<mixed>,
     *     categories: list<array{
     *         id: string,
     *         name: string,
     *         icon: string,
     *         updatedAt: string
     *     }>,
     *     icons: list<string>,
     *     payees: list<array{
     *         payee: string,
     *         categoryId: string,
     *         method: string
     *     }>,
     *     methods: list<array{
     *         key: string,
     *         name: string
     *     }>,
     *     receipts: array{
     *         enabled: bool,
     *         maxSize: int|float,
     *         types: list<string>
     *     },
     *     limits: array{
     *         categories: int|float,
     *         recurring: int|float,
     *         rules: int|float,
     *         importRows: int|float,
     *         payee: int|float,
     *         note: int|float,
     *         reference: int|float,
     *         amount: int|float,
     *         category: int|float,
     *         phrase: int|float
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/expenses/get-what-an-expense-can-be
     */
    public function setup(array $options = []): mixed
    {
        return $this->caller->call('expenses.setup', [], [], $options);
    }

    /**
     * **Export expenses**
     *
     * The expenses the same filters would list, as a CSV file or as a PDF on the store's letterhead. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `expenses.read` permission (Read Expenses). It is one of the heavier reads, and is counted against a smaller budget of its own: 60 a minute for each key.
     *
     * Fields:
     *
     * - `range`: The period. Left out, it is "this_month".
     * - `from`: The first day of a period of your own, as `YYYY-MM-DD`. With `to`, in place of `range`.
     * - `to`: Its last day, as `YYYY-MM-DD`.
     * - `tz`: The time zone those days are in, as an IANA name. Left out, UTC.
     * - `search`: Part of a payee, a note or a reference.
     * - `category`: Only expenses in this expense category, by its ID.
     * - `method`: Only expenses paid this way.
     * - `format`: A spreadsheet or a document. Left out, it is "csv".
     *
     * @param array{
     *     range?: 'today'|'yesterday'|'7d'|'30d'|'this_week'|'last_week'|'this_month'|'last_month'|'this_year',
     *     from?: string,
     *     to?: string,
     *     tz?: string,
     *     search?: string,
     *     category?: string,
     *     method?: 'card'|'bank'|'crypto'|'paypal'|'cash'|'other',
     *     format?: 'csv'|'pdf'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\File
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/expenses/export-expenses
     */
    public function export(array $params = [], array $options = []): \Shoply\File
    {
        return $this->caller->call('expenses.export', [], $params, $options);
    }

    /**
     * **Update an expense**
     *
     * Changes an expense. A field left out stays as it is. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `expenses.write` permission (Change Expenses).
     *
     * Fields:
     *
     * - `spentOn` (required): The day it was paid, as `YYYY-MM-DD`. Not in the future: a bill still to come is a recurring expense.
     * - `payee` (required): Who was paid, up to 120 characters.
     * - `amount` (required): How much, above zero, with at most 2 decimals.
     * - `currency`: The currency `amount` is in, when it is not the store's own. It is converted at today's rate and kept in the store's currency.
     * - `method`: How it was paid.
     * - `categoryId`: The expense category it is filed in, by ID.
     * - `category`: The same, by the category's name, for a script that has no reason to know an ID. With neither, the store's rules file it.
     * - `note`: A note, up to 255 characters.
     * - `reference`: An invoice number or the like, up to 160 characters.
     * - `productId`: A product this expense is a cost of.
     *
     * @param string $expenseId The expense.
     * @param array{
     *     spentOn: string,
     *     payee: string,
     *     amount: int|float,
     *     currency?: string,
     *     method?: 'card'|'bank'|'crypto'|'paypal'|'cash'|'other',
     *     categoryId?: string,
     *     category?: string,
     *     note?: string,
     *     reference?: string,
     *     productId?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     spentOn: string,
     *     payee: string,
     *     note: string,
     *     category: array{
     *         id: string,
     *         name: string,
     *         icon: string
     *     },
     *     method: string,
     *     reference: string,
     *     amount: int|float,
     *     entered: mixed,
     *     productId: mixed,
     *     recurring: bool,
     *     source: string,
     *     receipt: mixed,
     *     createdAt: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/expenses/update-an-expense
     */
    public function update(string $expenseId, array $params, array $options = []): mixed
    {
        return $this->caller->call('expenses.update', [$expenseId], $params, $options);
    }

    /**
     * **Delete an expense**
     *
     * Removes an expense, and its receipt with it. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `expenses.write` permission (Change Expenses).
     *
     * @param string $expenseId The expense.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     deleted: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/expenses/delete-an-expense
     */
    public function delete(string $expenseId, array $options = []): mixed
    {
        return $this->caller->call('expenses.delete', [$expenseId], [], $options);
    }

    /**
     * **Get an expense's receipt**
     *
     * A link to the expense's receipt that works for five minutes. A receipt is private: there is no address for it that lasts. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `expenses.read` permission (Read Expenses).
     *
     * @param string $expenseId The expense.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/expenses/get-an-expenses-receipt
     */
    public function receipt(string $expenseId, array $options = []): mixed
    {
        return $this->caller->call('expenses.receipt', [$expenseId], [], $options);
    }

    /**
     * **Start a receipt upload**
     *
     * The first of three steps to attach a receipt: a PDF, PNG, JPG or WEBP. This one says what the file is and answers a signed address to send it to. Then send the file to that address with a `PUT`. Then call "Finish a receipt upload". Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `expenses.write` permission (Change Expenses).
     *
     * Fields:
     *
     * - `name` (required): The file's name, with its ending.
     * - `size` (required): Its size in bytes.
     *
     * @param string $expenseId The expense.
     * @param array{
     *     name: string,
     *     size: int
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/expenses/start-a-receipt-upload
     */
    public function addReceipt(string $expenseId, array $params, array $options = []): mixed
    {
        return $this->caller->call('expenses.addReceipt', [$expenseId], $params, $options);
    }

    /**
     * **Delete an expense's receipt**
     *
     * Removes the receipt and keeps the expense. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `expenses.write` permission (Change Expenses).
     *
     * @param string $expenseId The expense.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/expenses/delete-an-expenses-receipt
     */
    public function deleteReceipt(string $expenseId, array $options = []): mixed
    {
        return $this->caller->call('expenses.deleteReceipt', [$expenseId], [], $options);
    }

    /**
     * **Finish a receipt upload**
     *
     * The last step of attaching a receipt: says the file has been sent. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `expenses.write` permission (Change Expenses).
     *
     * @param string $expenseId The expense.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/expenses/finish-a-receipt-upload
     */
    public function finishReceipt(string $expenseId, array $options = []): mixed
    {
        return $this->caller->call('expenses.finishReceipt', [$expenseId], [], $options);
    }
}
