<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class CouponCategories
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List coupon categories**
     *
     * The categories the store files its coupons in, in the store's own order, each with how many coupons it holds. Two are the store's from the start and cannot be renamed or deleted: Default, and First Timer, which holds the codes the first-order reward makes.
     *
     * Needs the `coupons.read` permission (Read Coupons).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     storeId: string,
     *     name: string,
     *     slug: string,
     *     description: string,
     *     sort: int|float,
     *     systemKey: string,
     *     couponCount: int|float,
     *     activeCount: int|float,
     *     uses: int|float,
     *     discountGiven: int|float,
     *     dateCreated: string,
     *     updatedAt: string
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/coupon-categories/list-coupon-categories
     */
    public function list(array $options = []): mixed
    {
        return $this->caller->call('couponCategories.list', [], [], $options);
    }

    /**
     * **Create a coupon category**
     *
     * Adds a category to file coupons in. A store holds up to 30 of its own.
     *
     * Needs the `coupons.write` permission (Change Coupons).
     *
     * Fields:
     *
     * - `name` (required): Its name. One category a name in a store.
     * - `description`: A note for whoever manages the store. Buyers never see it.
     *
     * @param array{
     *     name: string,
     *     description?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     storeId: string,
     *     name: string,
     *     slug: string,
     *     description: string,
     *     sort: int|float,
     *     systemKey: string,
     *     couponCount: int|float,
     *     activeCount: int|float,
     *     uses: int|float,
     *     discountGiven: int|float,
     *     dateCreated: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/coupon-categories/create-a-coupon-category
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('couponCategories.create', [], $params, $options);
    }

    /**
     * **Update a coupon category**
     *
     * Renames a category or changes its note. The two the store starts with are refused with `system_category`.
     *
     * Needs the `coupons.write` permission (Change Coupons).
     *
     * Fields:
     *
     * - `name` (required): Its name.
     * - `description`: A note for whoever manages the store.
     *
     * @param string $categoryId The coupon category.
     * @param array{
     *     name: string,
     *     description?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     storeId: string,
     *     name: string,
     *     slug: string,
     *     description: string,
     *     sort: int|float,
     *     systemKey: string,
     *     couponCount: int|float,
     *     activeCount: int|float,
     *     uses: int|float,
     *     discountGiven: int|float,
     *     dateCreated: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/coupon-categories/update-a-coupon-category
     */
    public function update(string $categoryId, array $params, array $options = []): mixed
    {
        return $this->caller->call('couponCategories.update', [$categoryId], $params, $options);
    }

    /**
     * **Delete a coupon category**
     *
     * Removes the category. The coupons in it are not deleted: they move to Default, since buyers may be holding their codes.
     *
     * Needs the `coupons.write` permission (Change Coupons).
     *
     * @param string $categoryId The coupon category.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     deleted: bool,
     *     moved: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/coupon-categories/delete-a-coupon-category
     */
    public function delete(string $categoryId, array $options = []): mixed
    {
        return $this->caller->call('couponCategories.delete', [$categoryId], [], $options);
    }

    /**
     * **Sort coupon categories**
     *
     * Sets the order the categories are listed in.
     *
     * Needs the `coupons.write` permission (Change Coupons).
     *
     * Fields:
     *
     * - `categoryIds` (required): The categories' IDs in their new order.
     *
     * @param array{
     *     categoryIds: list<string>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/coupon-categories/sort-coupon-categories
     */
    public function sort(array $params, array $options = []): mixed
    {
        return $this->caller->call('couponCategories.sort', [], $params, $options);
    }
}
