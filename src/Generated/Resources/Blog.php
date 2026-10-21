<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Blog
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List blog categories and posts**
     *
     * Every blog category in the store's own order, each with its posts in theirs, drafts included, without their text. A store holds up to 20 categories and a category up to 15 posts.
     *
     * Needs the `blog.read` permission (Read Blog).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     name: string,
     *     slug: string,
     *     path: string,
     *     description: string,
     *     imageUrl: mixed,
     *     posts: list<array{
     *         id: string,
     *         categoryId: string,
     *         title: string,
     *         slug: string,
     *         path: string,
     *         status: string,
     *         coverUrl: mixed,
     *         views: int|float,
     *         publishedAt: string,
     *         updatedAt: string
     *     }>
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/blog/list-blog-categories-and-posts
     */
    public function list(array $options = []): mixed
    {
        return $this->caller->call('blog.list', [], [], $options);
    }
}
