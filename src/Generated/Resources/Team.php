<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Team
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **Get the team**
     *
     * The store's teams, each with its `permissions`, how many of them are `sensitive`, the parts of the dashboard it `reach`es, its `people` and how many invites are `waiting`; every `invite` not yet taken up; the store's `owner`, who is on no team and can do everything; and `permissions`, every permission there is in its `groups`, each with its `label`, what it lets a person do (`about`), whether it is `sensitive` and what it `needs`, and the `presets` a team can start from. `limits` says how many teams the store and people a team may have on its plan (invites not yet taken up counted among the people), how long a team's `name` may be, how many addresses one invite takes (`perInvite`) and how many days an invite lasts (`inviteDays`).
     *
     * Needs the `team.read` permission (Read the Team).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     teams: list<array{
     *         id: string,
     *         name: string,
     *         permissions: list<string>,
     *         sensitive: int|float,
     *         reach: list<string>,
     *         people: list<array{
     *             id: string,
     *             userId: string,
     *             teamId: string,
     *             name: string,
     *             email: string,
     *             avatarUrl: mixed,
     *             invitedBy: string,
     *             joinedAt: string,
     *             lastSeenAt: mixed,
     *             keys: int|float,
     *             me: bool
     *         }>,
     *         waiting: int|float,
     *         createdAt: string,
     *         updatedAt: string
     *     }>,
     *     invites: list<array{
     *         id: string,
     *         kind: string,
     *         email: string,
     *         teamId: string,
     *         team: string,
     *         invitedBy: string,
     *         sends: int|float,
     *         sentAt: string,
     *         expiresAt: string,
     *         expired: bool
     *     }>,
     *     owner: array{
     *         userId: string,
     *         name: mixed,
     *         email: string,
     *         avatarUrl: mixed
     *     },
     *     me: array{
     *         role: string,
     *         teamId: mixed,
     *         permissions: list<string>
     *     },
     *     permissions: array{
     *         groups: list<array{
     *             id: string,
     *             title: string,
     *             permissions: list<array{
     *                 id: mixed,
     *                 label: mixed,
     *                 about: mixed,
     *                 sensitive: mixed,
     *                 needs: mixed
     *             }>
     *         }>,
     *         presets: list<array{
     *             id: string,
     *             name: string,
     *             about: string,
     *             permissions: list<string>
     *         }>
     *     },
     *     limits: array{
     *         teams: int|float,
     *         people: int|float,
     *         name: int|float,
     *         perInvite: int|float,
     *         inviteDays: int|float
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/teams/get-the-team
     */
    public function get(array $options = []): mixed
    {
        return $this->caller->call('team.get', [], [], $options);
    }

    /**
     * **List activity**
     *
     * Who did what at the store on the dashboard, the newest first, fifty a page: each line's `summary` ("Refunded order ..."), who did it as they were then (`name`, `email`, `team`, which is null for the owner), its `area` of the dashboard, and what it was about (`subject`). Every change and every export is a line, the owner's included; what a key does is not, and is in List API requests. Kept 365 days.
     *
     * Needs the `team.read` permission (Read the Team).
     *
     * Fields:
     *
     * - `person`: Only one person's, by their `userId`.
     * - `area`: Only one part of the dashboard, by its group's `id` in Get the team's `permissions`.
     * - `page`: Which page of the list. The first is 1. Left out, it is 1.
     *
     * @param array{
     *     person?: string,
     *     area?: string,
     *     page?: int
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\Page<array{
     *     id: string,
     *     userId: string,
     *     name: string,
     *     email: string,
     *     team: string,
     *     area: string,
     *     summary: string,
     *     subject: array{
     *         kind: string,
     *         id: string
     *     },
     *     at: string
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/teams/list-activity
     */
    public function activity(array $params = [], array $options = []): \Shoply\Page
    {
        return $this->caller->call('team.activity', [], $params, $options);
    }

    /**
     * **Invite people**
     *
     * Emails an invite to each address in `emails`, up to 10 at a time, from Shoply. An invite is taken up only by an account with that address, which they sign in with or make, and the store is then in their store switcher. Each runs out in 7 days. `skipped` names an address left out and why: the owner's, one on the team already, or one invited already. With `kind` set to `link` instead, it makes a one-time link anybody can take up, answered in `url` here and never again. Not to a team that holds a sensitive permission: invite to one of those on the dashboard. The store's owner is emailed when somebody joins.
     *
     * Needs the `team.write` permission (Manage the Team). It sends an email, and is counted against a budget of its own: 60 in ten minutes for each key.
     *
     * Fields:
     *
     * - `teamId` (required): The team they join.
     * - `emails`: The addresses to invite.
     * - `kind`: `link` for a one-time link in place of emails. Left out, it is "email".
     *
     * @param array{
     *     teamId: string,
     *     emails?: list<string>,
     *     kind?: 'email'|'link'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     invites: list<array{
     *         id: string,
     *         kind: string,
     *         email: string,
     *         teamId: string,
     *         team: string,
     *         invitedBy: string,
     *         sends: int|float,
     *         sentAt: string,
     *         expiresAt: string,
     *         expired: bool
     *     }>,
     *     skipped: array<mixed>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/teams/invite-people
     */
    public function invite(array $params, array $options = []): mixed
    {
        return $this->caller->call('team.invite', [], $params, $options);
    }

    /**
     * **Send an invite again**
     *
     * Sends an email invite again, or makes a link again (answered in `meta.url`), with 7 days from now. The address or link sent before stops working.
     *
     * Needs the `team.write` permission (Manage the Team). It sends an email, and is counted against a budget of its own: 60 in ten minutes for each key.
     *
     * @param string $inviteId The invite.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     kind: string,
     *     email: string,
     *     teamId: string,
     *     team: string,
     *     invitedBy: string,
     *     sends: int|float,
     *     sentAt: string,
     *     expiresAt: string,
     *     expired: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/teams/send-an-invite-again
     */
    public function resendInvite(string $inviteId, array $options = []): mixed
    {
        return $this->caller->call('team.resendInvite', [$inviteId], [], $options);
    }

    /**
     * **Cancel an invite**
     *
     * Takes an invite back. Its email or link stops working.
     *
     * Needs the `team.write` permission (Manage the Team).
     *
     * @param string $inviteId The invite.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     deleted: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/teams/cancel-an-invite
     */
    public function cancelInvite(string $inviteId, array $options = []): mixed
    {
        return $this->caller->call('team.cancelInvite', [$inviteId], [], $options);
    }

    /**
     * **Move somebody to another team**
     *
     * They can do what the other team can from their next request. Not onto a team that holds a sensitive permission: do that on the dashboard.
     *
     * Needs the `team.write` permission (Manage the Team).
     *
     * Fields:
     *
     * - `teamId` (required): The team they move to.
     *
     * @param string $memberId The person, by the `id` Get the team answers for them on a team.
     * @param array{
     *     teamId: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     userId: string,
     *     teamId: string,
     *     name: string,
     *     email: string,
     *     avatarUrl: mixed,
     *     invitedBy: string,
     *     joinedAt: string,
     *     lastSeenAt: mixed,
     *     keys: int|float,
     *     me: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/teams/move-somebody-to-another-team
     */
    public function moveMember(string $memberId, array $params, array $options = []): mixed
    {
        return $this->caller->call('team.moveMember', [$memberId], $params, $options);
    }

    /**
     * **Remove somebody from the team**
     *
     * They can no longer reach the store. The API keys they made and the apps they connected stop working with them (`keysStopped` says how many), and the webhooks those made are deleted.
     *
     * Needs the `team.write` permission (Manage the Team).
     *
     * @param string $memberId The person, by the `id` Get the team answers for them on a team.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     deleted: string,
     *     keysStopped: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/teams/remove-somebody-from-the-team
     */
    public function removeMember(string $memberId, array $options = []): mixed
    {
        return $this->caller->call('team.removeMember', [$memberId], [], $options);
    }
}
