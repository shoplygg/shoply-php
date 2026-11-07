<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class ResellerAnnouncements
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List announcements**
     *
     * What the store tells its resellers, in a bar on every page of the panel, pinned ones first, then the newest. `meta.resellers` is how many people can read them (everybody on every reseller's team), and `meta.bounds` the lengths and how many a panel keeps.
     *
     * Needs the `resellers.read` permission (Read Resellers).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     title: string,
     *     body: string,
     *     pinned: bool,
     *     createdAt: string,
     *     updatedAt: string,
     *     closes: int|float
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/list-announcements
     */
    public function list(array $options = []): mixed
    {
        return $this->caller->call('resellerAnnouncements.list', [], [], $options);
    }

    /**
     * **Post an announcement**
     *
     * Every reseller sees it on the panel from their next page. Nobody is emailed. A panel keeps up to 100: past that, a new one is refused with `announcement_limit`.
     *
     * Needs the `resellers.write` permission (Change Resellers).
     *
     * Fields:
     *
     * - `title` (required): Its title, up to 100 characters.
     * - `body` (required): What it says, up to 1,000 characters.
     * - `pinned`: Whether it is shown first, before the newer ones. Left out, it is false.
     *
     * @param array{
     *     title: string,
     *     body: string,
     *     pinned?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     title: string,
     *     body: string,
     *     pinned: bool,
     *     createdAt: string,
     *     updatedAt: string,
     *     closes: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/post-an-announcement
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('resellerAnnouncements.create', [], $params, $options);
    }

    /**
     * **Update an announcement**
     *
     * Saves it whole: its title, what it says and whether it is pinned.
     *
     * Needs the `resellers.write` permission (Change Resellers).
     *
     * Fields:
     *
     * - `title` (required): Its title, up to 100 characters.
     * - `body` (required): What it says, up to 1,000 characters.
     * - `pinned`: Whether it is shown first, before the newer ones. Left out, it is false.
     *
     * @param string $announcementId The announcement.
     * @param array{
     *     title: string,
     *     body: string,
     *     pinned?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     title: string,
     *     body: string,
     *     pinned: bool,
     *     createdAt: string,
     *     updatedAt: string,
     *     closes: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/update-an-announcement
     */
    public function update(string $announcementId, array $params, array $options = []): mixed
    {
        return $this->caller->call('resellerAnnouncements.update', [$announcementId], $params, $options);
    }

    /**
     * **Delete an announcement**
     *
     * Takes it off the panel. Answers the announcements that are left.
     *
     * Needs the `resellers.write` permission (Change Resellers).
     *
     * @param string $announcementId The announcement.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array<mixed>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/delete-an-announcement
     */
    public function delete(string $announcementId, array $options = []): mixed
    {
        return $this->caller->call('resellerAnnouncements.delete', [$announcementId], [], $options);
    }
}
