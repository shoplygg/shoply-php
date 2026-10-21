<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class ExpenseCategories
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List expense categories**
     *
     * The categories the store files its expenses in, in its own order. A store holds up to 50. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `expenses.read` permission (Read Expenses).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     name: string,
     *     icon: string,
     *     updatedAt: string
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/expense-setup/list-expense-categories
     */
    public function list(array $options = []): mixed
    {
        return $this->caller->call('expenseCategories.list', [], [], $options);
    }

    /**
     * **Create an expense category**
     *
     * Adds a category to file expenses in. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `expenses.write` permission (Change Expenses).
     *
     * Fields:
     *
     * - `name` (required): Its name, up to 60 characters.
     * - `icon`: The icon the dashboard draws beside it, from the list in "Get what an expense can be". Left out, it is "tag".
     *
     * @param array{
     *     name: string,
     *     icon?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     name: string,
     *     icon: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/expense-setup/create-an-expense-category
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('expenseCategories.create', [], $params, $options);
    }

    /**
     * **Update an expense category**
     *
     * Renames a category or changes its icon. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `expenses.write` permission (Change Expenses).
     *
     * Fields:
     *
     * - `name` (required): Its name.
     * - `icon`: Its icon. Left out, it stays as it is.
     *
     * @param string $categoryId The expense category.
     * @param array{
     *     name: string,
     *     icon?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     name: string,
     *     icon: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/expense-setup/update-an-expense-category
     */
    public function update(string $categoryId, array $params, array $options = []): mixed
    {
        return $this->caller->call('expenseCategories.update', [$categoryId], $params, $options);
    }

    /**
     * **Delete an expense category**
     *
     * Removes the category. The expenses filed under it stay, in no category: `moved` says how many. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `expenses.write` permission (Change Expenses).
     *
     * @param string $categoryId The expense category.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     deleted: bool,
     *     moved: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/expense-setup/delete-an-expense-category
     */
    public function delete(string $categoryId, array $options = []): mixed
    {
        return $this->caller->call('expenseCategories.delete', [$categoryId], [], $options);
    }

    /**
     * **Sort expense categories**
     *
     * Sets the order the categories are listed in. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `expenses.write` permission (Change Expenses).
     *
     * Fields:
     *
     * - `categoryIds` (required): The categories' IDs in their new order.
     *
     * @param array{
     *     categoryIds: list<string>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     reordered: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/expense-setup/sort-expense-categories
     */
    public function sort(array $params, array $options = []): mixed
    {
        return $this->caller->call('expenseCategories.sort', [], $params, $options);
    }
}
