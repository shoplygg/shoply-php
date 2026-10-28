<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Reviews
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List reviews**
     *
     * The reviews left on the store's orders, a page at a time, newest first. A buyer leaves one for a paid order; an order nobody reviewed is given five stars by itself after seven days. `meta.summary` is the whole store's average and counts, whatever the filters. A review the store flagged for removal carries `flag`: how it stands (`open`, or `kept` with the answer given) and why it was flagged. One that was removed is no longer listed. The store's reply, where it wrote one, is `reply`, and `meta.summary.replied` counts them.
     *
     * Needs the `reviews.read` permission (Read Reviews).
     *
     * Fields:
     *
     * - `page`: Which page of the list. The first is 1. Left out, it is 1.
     * - `perPage`: How many a page holds. Left out, it is 20.
     * - `rating`: Only reviews of this many stars: 1 to 5.
     * - `type`: Only reviews a buyer wrote, or only the ones given by themselves.
     * - `search`: A buyer's email, an order's ID, or words from a review or its reply.
     * - `reply`: Only reviews the store has replied to, or only buyers' reviews it has not (an automatic review cannot be replied to).
     *
     * @param array{
     *     page?: int,
     *     perPage?: int,
     *     rating?: int,
     *     type?: 'buyer'|'automatic',
     *     search?: string,
     *     reply?: 'replied'|'none'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\Page<array{
     *     id: string,
     *     rating: int|float,
     *     message: string,
     *     automatic: bool,
     *     imported: bool,
     *     dateCreated: string,
     *     reply: array{
     *         message: string,
     *         dateReplied: string
     *     },
     *     items: list<array{
     *         productId: string,
     *         productName: string,
     *         variantName: string
     *     }>,
     *     orderId: string,
     *     customerId: string,
     *     email: string,
     *     orderAmount: int|float,
     *     currencyCode: string,
     *     flag: array{
     *         id: string,
     *         status: string,
     *         reason: string,
     *         reasonLabel: string,
     *         note: string,
     *         answer: string,
     *         dateCreated: string,
     *         dateDecided: mixed
     *     }
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/reviews/list-reviews
     */
    public function list(array $params = [], array $options = []): \Shoply\Page
    {
        return $this->caller->call('reviews.list', [], $params, $options);
    }

    /**
     * **Reply to a review**
     *
     * Writes the store's reply to a review, shown under it on the store, to its buyer on their order's page, and on the dashboard. A review has one reply: sent again, it takes the place of the one there. Plain words, line breaks kept.
     *
     * Refused for an automatic review, which has no words to reply to (`automatic_review`). The buyer is not emailed. Answers the review as [List reviews](https://docs.shoply.gg/api-reference/reviews/list-reviews) has it, with `reply`.
     *
     * Needs the `reviews.write` permission (Reply to Reviews).
     *
     * Fields:
     *
     * - `message` (required): The reply, up to 1,000 characters.
     *
     * @param string $reviewId The review, by its `id`.
     * @param array{
     *     message: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     review: array{
     *         id: string,
     *         rating: int|float,
     *         message: string,
     *         automatic: bool,
     *         imported: bool,
     *         dateCreated: string,
     *         reply: array{
     *             message: string,
     *             dateReplied: string
     *         },
     *         items: list<array{
     *             productId: string,
     *             productName: string,
     *             variantName: string
     *         }>,
     *         orderId: string,
     *         customerId: string,
     *         email: string,
     *         orderAmount: int|float,
     *         currencyCode: string,
     *         flag: array{
     *             id: string,
     *             status: string,
     *             reason: string,
     *             reasonLabel: string,
     *             note: string,
     *             answer: string,
     *             dateCreated: string,
     *             dateDecided: mixed
     *         }
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/reviews/reply-to-a-review
     */
    public function reply(string $reviewId, array $params, array $options = []): mixed
    {
        return $this->caller->call('reviews.reply', [$reviewId], $params, $options);
    }

    /**
     * **Remove a reply to a review**
     *
     * Takes the store's reply off a review. A review with no reply is answered as it is. Answers the review as [List reviews](https://docs.shoply.gg/api-reference/reviews/list-reviews) has it, its `reply` null.
     *
     * Needs the `reviews.write` permission (Reply to Reviews).
     *
     * @param string $reviewId The review, by its `id`.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     review: array{
     *         id: string,
     *         rating: int|float,
     *         message: string,
     *         automatic: bool,
     *         imported: bool,
     *         dateCreated: string,
     *         reply: mixed,
     *         items: list<array{
     *             productId: string,
     *             productName: string,
     *             variantName: string
     *         }>,
     *         orderId: string,
     *         customerId: string,
     *         email: string,
     *         orderAmount: int|float,
     *         currencyCode: string,
     *         flag: array{
     *             id: string,
     *             status: string,
     *             reason: string,
     *             reasonLabel: string,
     *             note: string,
     *             answer: string,
     *             dateCreated: string,
     *             dateDecided: mixed
     *         }
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/reviews/remove-a-reply-to-a-review
     */
    public function removeReply(string $reviewId, array $options = []): mixed
    {
        return $this->caller->call('reviews.removeReply', [$reviewId], [], $options);
    }
}
