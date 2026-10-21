<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class CustomerTags
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List customer tags**
     *
     * The store's own tags as `data`, by name, each with `customers`, how many wear it. `meta.automatic` is Shoply's two: VIP's rule (`vipOn`, `vipSpent` in the store's currency, `vipOrders` completed orders, `vipDays` the period, 0 for all time; either number 0 leaves that half out) and `disputedOn`, with `vipCustomers` and `disputedCustomers`, how many wear each today.
     *
     * Needs the `customers.read` permission (Read Customers).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     name: string,
     *     tone: string,
     *     automatic: bool,
     *     customers: int|float
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customers/list-customer-tags
     */
    public function list(array $options = []): mixed
    {
        return $this->caller->call('customerTags.list', [], [], $options);
    }

    /**
     * **Add a customer tag**
     *
     * A tag of the store's own. A store has at most 50. Names are told apart without regard to case, and VIP and Disputed Before are Shoply's.
     *
     * Needs the `customers.tags` permission (Change Tags).
     *
     * Fields:
     *
     * - `name` (required): Its name, up to 32 characters.
     * - `tone`: Its colour. Left out, it is "neutral".
     *
     * @param array{
     *     name: string,
     *     tone?: 'neutral'|'primary'|'success'|'warning'|'danger'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     name: string,
     *     tone: string,
     *     automatic: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customers/add-a-customer-tag
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('customerTags.create', [], $params, $options);
    }

    /**
     * **Change VIP and Disputed Before**
     *
     * Shoply's two tags: whether each is put on, and who is a VIP. Both are worked out from a customer's orders whenever they are read, so a change reaches every customer at once. Answers as List customer tags does.
     *
     * Needs the `customers.tags` permission (Change Tags).
     *
     * Fields:
     *
     * - `vipOn`: Whether VIP is put on.
     * - `vipSpent`: A VIP has spent at least this, in the store's currency, on completed orders. 0 leaves it out.
     * - `vipOrders`: Or paid for at least this many orders. 0 leaves it out.
     * - `vipDays`: Over this many days back, 0 for all time.
     * - `disputedOn`: Whether Disputed Before is put on: a dispute on any of their orders, won or lost.
     *
     * @param array{
     *     vipOn?: bool,
     *     vipSpent?: int|float,
     *     vipOrders?: int,
     *     vipDays?: 0|365|180|90|30,
     *     disputedOn?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     name: string,
     *     tone: string,
     *     automatic: bool,
     *     customers: int|float
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customers/change-vip-and-disputed-before
     */
    public function automatic(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('customerTags.automatic', [], $params, $options);
    }

    /**
     * **Change a customer tag**
     *
     * Renames a tag or changes its colour, keeping what is not sent. Everybody wearing it keeps it.
     *
     * Needs the `customers.tags` permission (Change Tags).
     *
     * Fields:
     *
     * - `name`: Its name, up to 32 characters.
     * - `tone`: Its colour.
     *
     * @param string $tagId The tag.
     * @param array{
     *     name?: string,
     *     tone?: 'neutral'|'primary'|'success'|'warning'|'danger'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     name: string,
     *     tone: string,
     *     automatic: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customers/change-a-customer-tag
     */
    public function update(string $tagId, array $params = [], array $options = []): mixed
    {
        return $this->caller->call('customerTags.update', [$tagId], $params, $options);
    }

    /**
     * **Delete a customer tag**
     *
     * Deletes a tag and takes it off everybody wearing it. No `customer.untagged` is sent for each. Win-Back narrowed to this tag writes to everybody subscribed again. Answers the tags left.
     *
     * Needs the `customers.tags` permission (Change Tags).
     *
     * @param string $tagId The tag.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array<mixed>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customers/delete-a-customer-tag
     */
    public function delete(string $tagId, array $options = []): mixed
    {
        return $this->caller->call('customerTags.delete', [$tagId], [], $options);
    }
}
