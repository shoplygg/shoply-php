<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class BlogPosts
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **Create a blog post**
     *
     * Starts a post as a draft with a title and nothing else. Write it and publish it with "Update a blog post".
     *
     * Needs the `blog.write` permission (Change Blog).
     *
     * Fields:
     *
     * - `categoryId` (required): The blog category it goes in.
     * - `title`: Its title.
     *
     * @param array{
     *     categoryId: string,
     *     title?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     categoryId: string,
     *     title: string,
     *     slug: string,
     *     path: string,
     *     status: string,
     *     coverUrl: mixed,
     *     views: int|float,
     *     publishedAt: mixed,
     *     updatedAt: string,
     *     body: string,
     *     coverAlt: string,
     *     seoTitle: string,
     *     seoDescription: string,
     *     url: string,
     *     search: array{
     *         title: string,
     *         description: string,
     *         html: string,
     *         checks: list<array{
     *             ok: bool,
     *             text: string
     *         }>
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/blog/create-a-blog-post
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('blogPosts.create', [], $params, $options);
    }

    /**
     * **Get a blog post**
     *
     * One post with its text, as Markdown.
     *
     * Needs the `blog.read` permission (Read Blog).
     *
     * @param string $postId The post.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     categoryId: string,
     *     title: string,
     *     slug: string,
     *     path: string,
     *     status: string,
     *     coverUrl: mixed,
     *     views: int|float,
     *     publishedAt: string,
     *     updatedAt: string,
     *     body: string,
     *     coverAlt: string,
     *     seoTitle: string,
     *     seoDescription: string,
     *     url: string,
     *     search: array{
     *         title: string,
     *         description: string,
     *         html: string,
     *         checks: list<array{
     *             ok: bool,
     *             text: string
     *         }>
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/blog/get-a-blog-post
     */
    public function show(string $postId, array $options = []): mixed
    {
        return $this->caller->call('blogPosts.show', [$postId], [], $options);
    }

    /**
     * **Update a blog post**
     *
     * Saves the post whole: send every field as it should be. `status` and `categoryId` are the exceptions, and stay as they are when left out. The text is Markdown and nothing in it is trusted as HTML. A picture in the text that the text no longer shows is removed when the post is saved.
     *
     * Needs the `blog.write` permission (Change Blog).
     *
     * Fields:
     *
     * - `title` (required): Its title.
     * - `slug`: The last part of its address. Left out, it is made from the title.
     * - `body`: The post's text, as Markdown.
     * - `status`: A draft is nowhere on the store. A published post is.
     * - `categoryId`: The blog category it is in. A post moved to another category is counted there as a new one.
     * - `coverAlt`: What its cover picture shows, for readers who cannot see it.
     * - `seoTitle`: Its own title in search results. Empty is its title.
     * - `seoDescription`: Its own description in search results. Empty is the start of its text.
     *
     * @param string $postId The post.
     * @param array{
     *     title: string,
     *     slug?: string,
     *     body?: string,
     *     status?: 'draft'|'published',
     *     categoryId?: string,
     *     coverAlt?: string,
     *     seoTitle?: string,
     *     seoDescription?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     categoryId: string,
     *     title: string,
     *     slug: string,
     *     path: string,
     *     status: string,
     *     coverUrl: mixed,
     *     views: int|float,
     *     publishedAt: mixed,
     *     updatedAt: string,
     *     body: string,
     *     coverAlt: string,
     *     seoTitle: string,
     *     seoDescription: string,
     *     url: string,
     *     search: array{
     *         title: string,
     *         description: string,
     *         html: string,
     *         checks: list<array{
     *             ok: bool,
     *             text: string
     *         }>
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/blog/update-a-blog-post
     */
    public function update(string $postId, array $params, array $options = []): mixed
    {
        return $this->caller->call('blogPosts.update', [$postId], $params, $options);
    }

    /**
     * **Delete a blog post**
     *
     * Removes the post and its pictures.
     *
     * Needs the `blog.write` permission (Change Blog).
     *
     * @param string $postId The post.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     deleted: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/blog/delete-a-blog-post
     */
    public function delete(string $postId, array $options = []): mixed
    {
        return $this->caller->call('blogPosts.delete', [$postId], [], $options);
    }

    /**
     * **Publish or unpublish a blog post**
     *
     * Puts a post out, or takes it back to a draft, and changes nothing else about it.
     *
     * Needs the `blog.write` permission (Change Blog).
     *
     * Fields:
     *
     * - `status` (required): The new status.
     *
     * @param string $postId The post.
     * @param array{
     *     status: 'draft'|'published'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     categoryId: string,
     *     title: string,
     *     slug: string,
     *     path: string,
     *     status: string,
     *     coverUrl: mixed,
     *     views: int|float,
     *     publishedAt: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/blog/publish-or-unpublish-a-blog-post
     */
    public function setStatus(string $postId, array $params, array $options = []): mixed
    {
        return $this->caller->call('blogPosts.setStatus', [$postId], $params, $options);
    }

    /**
     * **Sort a category's blog posts**
     *
     * Sets the order one category's page lists its posts in.
     *
     * Needs the `blog.write` permission (Change Blog).
     *
     * Fields:
     *
     * - `categoryId` (required): The blog category being sorted.
     * - `ids` (required): The posts' IDs in their new order.
     *
     * @param array{
     *     categoryId: string,
     *     ids: list<string>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     reordered: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/blog/sort-a-categorys-blog-posts
     */
    public function sort(array $params, array $options = []): mixed
    {
        return $this->caller->call('blogPosts.sort', [], $params, $options);
    }

    /**
     * **Upload a blog post's cover**
     *
     * Gives the post its one cover picture, replacing any it had. Sent as `multipart/form-data` in a field called `image`.
     *
     * Needs the `blog.write` permission (Change Blog).
     *
     * @param string $postId The post.
     * @param array{
     *     file: string|\CURLFile,
     *     filename?: string,
     *     contentType?: string
     * } $params The file: a path on disk, or a CURLFile.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/blog/upload-a-blog-posts-cover
     */
    public function uploadCover(string $postId, array $params, array $options = []): mixed
    {
        return $this->caller->call('blogPosts.uploadCover', [$postId], $params, $options);
    }

    /**
     * **Delete a blog post's cover**
     *
     * Removes the post's cover picture.
     *
     * Needs the `blog.write` permission (Change Blog).
     *
     * @param string $postId The post.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/blog/delete-a-blog-posts-cover
     */
    public function deleteCover(string $postId, array $options = []): mixed
    {
        return $this->caller->call('blogPosts.deleteCover', [$postId], [], $options);
    }

    /**
     * **Upload a picture for a blog post's text**
     *
     * Uploads a picture to use in the post's text, and answers its address (`url`) to write into the Markdown. Sent as `multipart/form-data` in a field called `image`. It stays the post's for as long as the saved text shows it.
     *
     * Needs the `blog.write` permission (Change Blog).
     *
     * @param string $postId The post.
     * @param array{
     *     file: string|\CURLFile,
     *     filename?: string,
     *     contentType?: string
     * } $params The file: a path on disk, or a CURLFile.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/blog/upload-a-picture-for-a-blog-posts-text
     */
    public function uploadImage(string $postId, array $params, array $options = []): mixed
    {
        return $this->caller->call('blogPosts.uploadImage', [$postId], $params, $options);
    }
}
