<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Teams
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **Create a team**
     *
     * A store holds as many teams as its plan does (`limits.teams` in Get the team). A key does this as whoever made it: a key somebody on the store's team made gives, takes away and changes only what their own team holds, as they can on the dashboard, and is refused with `team_beyond` otherwise. A permission marked `sensitive` that the team did not hold before cannot be given with a key: give it on the dashboard, which asks the person to confirm it is them.
     *
     * Needs the `team.write` permission (Manage the Team).
     *
     * Fields:
     *
     * - `name` (required): What the team is called, up to 40 characters, once a store.
     * - `permissions` (required): What its people may do, by name (List the team answers every permission in `permissions`). What a permission leans on is added with it: `stock.edit` brings `stock.view` and `products.view`.
     *
     * @param array{
     *     name: string,
     *     permissions: list<string>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     name: string,
     *     permissions: list<string>,
     *     sensitive: int|float,
     *     reach: list<string>,
     *     people: array<mixed>,
     *     waiting: int|float,
     *     createdAt: string,
     *     updatedAt: string,
     *     version: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/teams/create-a-team
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('teams.create', [], $params, $options);
    }

    /**
     * **Update a team**
     *
     * Saves the team whole: its name and its permissions. Its people can do what it now holds from their next request. The API keys and CLI sign-ins a person on the team made lose what their team no longer holds, and are revoked when nothing is left or the team does not hold `dev.keys`; an app they connected is disconnected when the team does not hold all it was given, or `dev.apps`. A key does this as whoever made it: a key somebody on the store's team made gives, takes away and changes only what their own team holds, as they can on the dashboard, and is refused with `team_beyond` otherwise. A permission marked `sensitive` that the team did not hold before cannot be given with a key: give it on the dashboard, which asks the person to confirm it is them.
     *
     * Needs the `team.write` permission (Manage the Team).
     *
     * Fields:
     *
     * - `name` (required): What the team is called, up to 40 characters, once a store.
     * - `permissions` (required): What its people may do, by name (List the team answers every permission in `permissions`). What a permission leans on is added with it: `stock.edit` brings `stock.view` and `products.view`.
     *
     * @param string $teamId The team, by its ID.
     * @param array{
     *     name: string,
     *     permissions: list<string>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     name: string,
     *     permissions: list<string>,
     *     sensitive: int|float,
     *     reach: list<string>,
     *     people: array<mixed>,
     *     waiting: int|float,
     *     createdAt: string,
     *     updatedAt: string,
     *     version: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/teams/update-a-team
     */
    public function update(string $teamId, array $params, array $options = []): mixed
    {
        return $this->caller->call('teams.update', [$teamId], $params, $options);
    }

    /**
     * **Delete a team**
     *
     * Refused with `team_not_empty` while anybody is on it: move or remove them first. Its invites not yet taken up go with it.
     *
     * Needs the `team.write` permission (Manage the Team).
     *
     * @param string $teamId The team, by its ID.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     deleted: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/teams/delete-a-team
     */
    public function delete(string $teamId, array $options = []): mixed
    {
        return $this->caller->call('teams.delete', [$teamId], [], $options);
    }
}
