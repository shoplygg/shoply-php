<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class WebhookDeliveries
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List webhook deliveries**
     *
     * What was sent to the store's endpoints, newest first, without the bodies. A delivery is one event on its way to one endpoint: `pending` while it is being tried, then `delivered` or `failed`. Deliveries are kept for 30 days.
     *
     * Needs the `webhooks.read` permission (Read Webhooks).
     *
     * Fields:
     *
     * - `page`: Which page of the list. The first is 1. Left out, it is 1.
     * - `perPage`: How many a page holds, up to 100. Left out, it is 50.
     * - `endpointId`: Only deliveries to this endpoint.
     * - `event`: Only deliveries of this event.
     * - `state`: Only deliveries in this state.
     * - `search`: A delivery's ID, an event's ID, or the ID of what the event is about, such as an order.
     *
     * @param array{
     *     page?: int,
     *     perPage?: int,
     *     endpointId?: string,
     *     event?: string,
     *     state?: 'pending'|'delivered'|'failed',
     *     search?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\Page<mixed>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/webhook-deliveries/list-webhook-deliveries
     */
    public function list(array $params = [], array $options = []): \Shoply\Page
    {
        return $this->caller->call('webhookDeliveries.list', [], $params, $options);
    }

    /**
     * **Get a webhook delivery**
     *
     * One delivery, with the body that was sent (`payload`) and every try at sending it (`tries`): the status your server answered with, the start of what it answered, or why it could not be reached.
     *
     * Needs the `webhooks.read` permission (Read Webhooks).
     *
     * @param string $deliveryId The delivery, as its `X-Shoply-Delivery` header named it.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/webhook-deliveries/get-a-webhook-delivery
     */
    public function show(string $deliveryId, array $options = []): mixed
    {
        return $this->caller->call('webhookDeliveries.show', [$deliveryId], [], $options);
    }

    /**
     * **Resend a webhook delivery**
     *
     * Sends the same body again, to the endpoint's address and under its secret as they are now, and answers the delivery with the new try in it. The delivery's ID is the same, so a server that has already taken it can tell.
     *
     * Needs the `webhooks.write` permission (Change Webhooks).
     *
     * @param string $deliveryId The delivery.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/webhook-deliveries/resend-a-webhook-delivery
     */
    public function resend(string $deliveryId, array $options = []): mixed
    {
        return $this->caller->call('webhookDeliveries.resend', [$deliveryId], [], $options);
    }
}
