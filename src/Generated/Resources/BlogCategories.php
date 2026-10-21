<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class BlogCategories
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **Create a blog category**
     *
     * Adds a category for posts to go in. A category with no published post is nowhere on the store.
     *
     * Needs the `blog.write` permission (Change Blog).
     *
     * Fields:
     *
     * - `name` (required): The category's name.
     * - `description`: What it is about. Shown on the blog's own page.
     * - `slug`: The part of its address after `/blog/`. Left out, it is made from the name. A post and a category cannot share one.
     *
     * @param array{
     *     name: string,
     *     description?: string,
     *     slug?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     name: string,
     *     slug: string,
     *     path: string,
     *     description: string,
     *     imageUrl: mixed,
     *     posts: array<mixed>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/blog/create-a-blog-category
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('blogCategories.create', [], $params, $options);
    }

    /**
     * **Update a blog category**
     *
     * Saves the category's name, description and address. A changed address is safe: the old one leads to the new.
     *
     * Needs the `blog.write` permission (Change Blog).
     *
     * Fields:
     *
     * - `name` (required): The category's name.
     * - `description`: What it is about. Shown on the blog's own page.
     * - `slug`: The part of its address after `/blog/`. Left out, it is made from the name. A post and a category cannot share one.
     *
     * @param string $categoryId The blog category.
     * @param array{
     *     name: string,
     *     description?: string,
     *     slug?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     name: string,
     *     slug: string,
     *     path: string,
     *     description: string,
     *     imageUrl: mixed
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/blog/update-a-blog-category
     */
    public function update(string $categoryId, array $params, array $options = []): mixed
    {
        return $this->caller->call('blogCategories.update', [$categoryId], $params, $options);
    }

    /**
     * **Delete a blog category**
     *
     * Removes a category that has no posts. One that still has posts is refused with `blog_category_not_empty`: move or delete them first.
     *
     * Needs the `blog.write` permission (Change Blog).
     *
     * @param string $categoryId The blog category.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     deleted: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/blog/delete-a-blog-category
     */
    public function delete(string $categoryId, array $options = []): mixed
    {
        return $this->caller->call('blogCategories.delete', [$categoryId], [], $options);
    }

    /**
     * **Sort blog categories**
     *
     * Sets the order the blog's own page lists its categories in.
     *
     * Needs the `blog.write` permission (Change Blog).
     *
     * Fields:
     *
     * - `ids` (required): The categories' IDs in their new order.
     *
     * @param array{
     *     ids: list<string>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     reordered: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/blog/sort-blog-categories
     */
    public function sort(array $params, array $options = []): mixed
    {
        return $this->caller->call('blogCategories.sort', [], $params, $options);
    }

    /**
     * **Upload a blog category's picture**
     *
     * Gives the category its one picture, replacing any it had. Sent as `multipart/form-data` in a field called `image`.
     *
     * Needs the `blog.write` permission (Change Blog).
     *
     * @param string $categoryId The blog category.
     * @param array{
     *     file: string|\CURLFile,
     *     filename?: string,
     *     contentType?: string
     * } $params The file: a path on disk, or a CURLFile.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/blog/upload-a-blog-categorys-picture
     */
    public function uploadImage(string $categoryId, array $params, array $options = []): mixed
    {
        return $this->caller->call('blogCategories.uploadImage', [$categoryId], $params, $options);
    }

    /**
     * **Delete a blog category's picture**
     *
     * Removes the category's picture.
     *
     * Needs the `blog.write` permission (Change Blog).
     *
     * @param string $categoryId The blog category.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/blog/delete-a-blog-categorys-picture
     */
    public function deleteImage(string $categoryId, array $options = []): mixed
    {
        return $this->caller->call('blogCategories.deleteImage', [$categoryId], [], $options);
    }
}
