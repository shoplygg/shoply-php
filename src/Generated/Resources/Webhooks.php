<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Webhooks
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List webhook endpoints**
     *
     * The store's webhook endpoints, each with the events it is sent and how its last delivery went. `recentDeliveries` is how its last twenty stand, oldest first: `delivered`, `failed` or `pending`. `meta.events` is every event there is. A store holds up to 20 endpoints.
     *
     * Needs the `webhooks.read` permission (Read Webhooks).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     url: string,
     *     description: string,
     *     events: list<string>,
     *     enabled: bool,
     *     pausedAt: mixed,
     *     failures: int|float,
     *     lastDeliveryAt: mixed,
     *     lastStatus: mixed,
     *     dateCreated: string,
     *     updatedAt: string,
     *     recentDeliveries: array<mixed>
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/webhook-endpoints/list-webhook-endpoints
     */
    public function list(array $options = []): mixed
    {
        return $this->caller->call('webhooks.list', [], [], $options);
    }

    /**
     * **Create a webhook endpoint**
     *
     * Adds an address for the store's events to be sent to. `secret` in the answer is what every delivery to it is signed with: it is answered here and never again, so keep it. The store's owner is told by email that a webhook was added.
     *
     * Needs the `webhooks.write` permission (Change Webhooks).
     *
     * Fields:
     *
     * - `url` (required): The https address deliveries are posted to. It cannot point at a private network, and it may name port 80, 443, 8080 or 8443.
     * - `events` (required): The events it is sent, by name, or `["*"]` for every event there is and every one there will be.
     * - `description`: A note for whoever manages the store, up to 160 characters.
     *
     * @param array{
     *     url: string,
     *     events: list<string>,
     *     description?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     url: string,
     *     description: string,
     *     events: list<string>,
     *     enabled: bool,
     *     pausedAt: mixed,
     *     failures: int|float,
     *     lastDeliveryAt: mixed,
     *     lastStatus: mixed,
     *     dateCreated: string,
     *     updatedAt: string,
     *     secret: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/webhook-endpoints/create-a-webhook-endpoint
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('webhooks.create', [], $params, $options);
    }

    /**
     * **Get a webhook endpoint**
     *
     * One endpoint. Never its signing secret.
     *
     * Needs the `webhooks.read` permission (Read Webhooks).
     *
     * @param string $endpointId The webhook endpoint.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     url: string,
     *     description: string,
     *     events: list<string>,
     *     enabled: bool,
     *     pausedAt: mixed,
     *     failures: int|float,
     *     lastDeliveryAt: mixed,
     *     lastStatus: mixed,
     *     dateCreated: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/webhook-endpoints/get-a-webhook-endpoint
     */
    public function show(string $endpointId, array $options = []): mixed
    {
        return $this->caller->call('webhooks.show', [$endpointId], [], $options);
    }

    /**
     * **Update a webhook endpoint**
     *
     * Saves the endpoint whole: its address, its events and its note. `enabled` stays as it is when left out. Switching an endpoint on is also what starts one again that Shoply had paused for failing. Its signing secret stays the same.
     *
     * Needs the `webhooks.write` permission (Change Webhooks).
     *
     * Fields:
     *
     * - `url` (required): The https address deliveries are posted to. It cannot point at a private network, and it may name port 80, 443, 8080 or 8443.
     * - `events` (required): The events it is sent, by name, or `["*"]` for every event there is and every one there will be.
     * - `description`: A note for whoever manages the store, up to 160 characters.
     * - `enabled`: Whether events are sent to it. Switched off, nothing is sent, and what happens meanwhile is not kept for it.
     *
     * @param string $endpointId The webhook endpoint.
     * @param array{
     *     url: string,
     *     events: list<string>,
     *     description?: string,
     *     enabled?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     url: string,
     *     description: string,
     *     events: list<string>,
     *     enabled: bool,
     *     pausedAt: mixed,
     *     failures: int|float,
     *     lastDeliveryAt: mixed,
     *     lastStatus: mixed,
     *     dateCreated: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/webhook-endpoints/update-a-webhook-endpoint
     */
    public function update(string $endpointId, array $params, array $options = []): mixed
    {
        return $this->caller->call('webhooks.update', [$endpointId], $params, $options);
    }

    /**
     * **Delete a webhook endpoint**
     *
     * Removes the endpoint, and with it the record of what was sent to it.
     *
     * Needs the `webhooks.write` permission (Change Webhooks).
     *
     * @param string $endpointId The webhook endpoint.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     deleted: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/webhook-endpoints/delete-a-webhook-endpoint
     */
    public function delete(string $endpointId, array $options = []): mixed
    {
        return $this->caller->call('webhooks.delete', [$endpointId], [], $options);
    }

    /**
     * **Replace a signing secret**
     *
     * Gives the endpoint a new signing secret, answered here and never again. The old one signs nothing from this moment, so give your server the new one before its next delivery is checked.
     *
     * Needs the `webhooks.write` permission (Change Webhooks).
     *
     * @param string $endpointId The webhook endpoint.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/webhook-endpoints/replace-a-signing-secret
     */
    public function rotateSecret(string $endpointId, array $options = []): mixed
    {
        return $this->caller->call('webhooks.rotateSecret', [$endpointId], [], $options);
    }

    /**
     * **Send a test delivery**
     *
     * Sends a `webhook.test` event to the endpoint now, whatever it subscribes to, and answers what your server said. It is signed like any other and is in the delivery log. A store may ask for 30 test and resent deliveries in ten minutes.
     *
     * Needs the `webhooks.write` permission (Change Webhooks).
     *
     * @param string $endpointId The webhook endpoint.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/webhook-endpoints/send-a-test-delivery
     */
    public function test(string $endpointId, array $options = []): mixed
    {
        return $this->caller->call('webhooks.test', [$endpointId], [], $options);
    }
}
