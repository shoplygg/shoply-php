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
     * A store holds as many teams as its plan does (`limits.teams` in Get the team). A permission marked `sensitive` that the team did not hold before cannot be given with a key: give it on the dashboard, which asks the person to confirm it is them.
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
     *     updatedAt: string
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
     * Saves the team whole: its name and its permissions. Its people can do what it now holds from their next request. A permission marked `sensitive` that the team did not hold before cannot be given with a key: give it on the dashboard, which asks the person to confirm it is them.
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
     *     updatedAt: string
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
