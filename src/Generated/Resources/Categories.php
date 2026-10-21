<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Categories
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List categories**
     *
     * Every category the store has, in the store's own order, each with the products in it. A store holds up to 150, so the list is not paged.
     *
     * Needs the `categories.read` permission (Read Categories).
     *
     * Fields:
     *
     * - `visibility`: Only categories with this visibility.
     *
     * @param array{
     *     visibility?: 'public'|'unlisted'|'private'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     storeId: string,
     *     name: string,
     *     slug: string,
     *     visibility: string,
     *     isPopular: bool,
     *     description: string,
     *     seoTitle: string,
     *     seoDescription: string,
     *     image: string,
     *     imageUrl: mixed,
     *     sort: int|float,
     *     productIds: list<string>,
     *     productCount: int|float,
     *     dateCreated: string,
     *     updatedAt: string
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/categories/list-categories
     */
    public function list(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('categories.list', [], $params, $options);
    }

    /**
     * **Create a category**
     *
     * Adds a category, with the products that go in it. A store holds up to 150.
     *
     * Needs the `categories.write` permission (Change Categories).
     *
     * Fields:
     *
     * - `name` (required): The category's name.
     * - `slug`: The last part of its address on the storefront. Left out, it is made from the name.
     * - `description`: What the category's page says under its name.
     * - `visibility`: `public` is listed on the storefront. `unlisted` is reached by its link. `private` is not shown. Left out, it is "public".
     * - `isPopular`: Whether themes that feature a category may feature this one. Left out, it is false.
     * - `productIds`: The products in it, in the order the category lists them.
     * - `seoTitle`: The category's own title in search results, up to 70 characters. Empty is its name.
     * - `seoDescription`: Its own description in search results, up to 200 characters. Empty is its description.
     *
     * @param array{
     *     name: string,
     *     slug?: string,
     *     description?: string,
     *     visibility?: 'public'|'unlisted'|'private',
     *     isPopular?: bool,
     *     productIds?: list<string>,
     *     seoTitle?: string,
     *     seoDescription?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     storeId: string,
     *     name: string,
     *     slug: string,
     *     visibility: string,
     *     isPopular: bool,
     *     description: string,
     *     seoTitle: string,
     *     seoDescription: string,
     *     image: string,
     *     imageUrl: mixed,
     *     sort: int|float,
     *     productIds: array<mixed>,
     *     productCount: int|float,
     *     dateCreated: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/categories/create-a-category
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('categories.create', [], $params, $options);
    }

    /**
     * **Update a category**
     *
     * Saves the category whole: send every field as it should be. `productIds` is the exception: left out, the products in the category stay as they are.
     *
     * Needs the `categories.write` permission (Change Categories).
     *
     * Fields:
     *
     * - `name` (required): The category's name.
     * - `slug`: The last part of its address on the storefront. Left out, it is made from the name.
     * - `description`: What the category's page says under its name.
     * - `visibility`: `public` is listed on the storefront. `unlisted` is reached by its link. `private` is not shown. Left out, it is "public".
     * - `isPopular`: Whether themes that feature a category may feature this one. Left out, it is false.
     * - `productIds`: The products in it, in the order the category lists them.
     * - `seoTitle`: The category's own title in search results, up to 70 characters. Empty is its name.
     * - `seoDescription`: Its own description in search results, up to 200 characters. Empty is its description.
     * - `expectedUpdatedAt`: The `updatedAt` you last read. Sent, the change is refused with `stale_write` if the record has changed since. Left out, it is saved whatever happened in between.
     *
     * @param string $categoryId The category.
     * @param array{
     *     name: string,
     *     slug?: string,
     *     description?: string,
     *     visibility?: 'public'|'unlisted'|'private',
     *     isPopular?: bool,
     *     productIds?: list<string>,
     *     seoTitle?: string,
     *     seoDescription?: string,
     *     expectedUpdatedAt?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     storeId: string,
     *     name: string,
     *     slug: string,
     *     visibility: string,
     *     isPopular: bool,
     *     description: string,
     *     seoTitle: string,
     *     seoDescription: string,
     *     image: string,
     *     imageUrl: mixed,
     *     sort: int|float,
     *     productIds: list<string>,
     *     productCount: int|float,
     *     dateCreated: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/categories/update-a-category
     */
    public function update(string $categoryId, array $params, array $options = []): mixed
    {
        return $this->caller->call('categories.update', [$categoryId], $params, $options);
    }

    /**
     * **Delete a category**
     *
     * Removes the category. The products that were in it are not deleted.
     *
     * Needs the `categories.write` permission (Change Categories).
     *
     * @param string $categoryId The category.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     deleted: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/categories/delete-a-category
     */
    public function delete(string $categoryId, array $options = []): mixed
    {
        return $this->caller->call('categories.delete', [$categoryId], [], $options);
    }

    /**
     * **Sort categories**
     *
     * Sets the order categories are listed in.
     *
     * Needs the `categories.write` permission (Change Categories).
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
     * @see https://docs.shoply.gg/api-reference/categories/sort-categories
     */
    public function sort(array $params, array $options = []): mixed
    {
        return $this->caller->call('categories.sort', [], $params, $options);
    }

    /**
     * **Upload a category's picture**
     *
     * Gives the category its one picture, sent as `multipart/form-data` in a field called `image`. A picture it already had is replaced.
     *
     * Needs the `categories.write` permission (Change Categories).
     *
     * @param string $categoryId The category.
     * @param array{
     *     file: string|\CURLFile,
     *     filename?: string,
     *     contentType?: string
     * } $params The file: a path on disk, or a CURLFile.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/categories/upload-a-categorys-picture
     */
    public function uploadImage(string $categoryId, array $params, array $options = []): mixed
    {
        return $this->caller->call('categories.uploadImage', [$categoryId], $params, $options);
    }

    /**
     * **Delete a category's picture**
     *
     * Removes the category's picture.
     *
     * Needs the `categories.write` permission (Change Categories).
     *
     * @param string $categoryId The category.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/categories/delete-a-categorys-picture
     */
    public function deleteImage(string $categoryId, array $options = []): mixed
    {
        return $this->caller->call('categories.deleteImage', [$categoryId], [], $options);
    }
}
