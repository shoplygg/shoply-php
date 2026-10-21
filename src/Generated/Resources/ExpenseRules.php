<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class ExpenseRules
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List expense rules**
     *
     * The store's rules for filing an expense that names no category: a phrase in the payee, and the category it means. A store holds up to 100. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `expenses.read` permission (Read Expenses).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     phrase: string,
     *     category: array{
     *         id: string,
     *         name: string,
     *         icon: string
     *     }
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/expense-setup/list-expense-rules
     */
    public function list(array $options = []): mixed
    {
        return $this->caller->call('expenseRules.list', [], [], $options);
    }

    /**
     * **Create an expense rule**
     *
     * Adds a rule: an expense whose payee contains the phrase is filed in the category. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `expenses.write` permission (Change Expenses).
     *
     * Fields:
     *
     * - `phrase` (required): What to look for in a payee.
     * - `categoryId` (required): The expense category it means.
     *
     * @param array{
     *     phrase: string,
     *     categoryId: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     phrase: string,
     *     category: array{
     *         id: string,
     *         name: string,
     *         icon: string
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/expense-setup/create-an-expense-rule
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('expenseRules.create', [], $params, $options);
    }

    /**
     * **Delete an expense rule**
     *
     * Removes the rule. Expenses it has already filed stay where they are. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `expenses.write` permission (Change Expenses).
     *
     * @param string $ruleId The rule.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     deleted: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/expense-setup/delete-an-expense-rule
     */
    public function delete(string $ruleId, array $options = []): mixed
    {
        return $this->caller->call('expenseRules.delete', [$ruleId], [], $options);
    }
}
