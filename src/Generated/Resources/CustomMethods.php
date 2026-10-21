<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class CustomMethods
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List custom payment methods**
     *
     * The store's custom payment methods. Where each stands at checkout among the connected methods is `meta.order` in "List payment methods". `meta.max` is how many a store may have, and `meta.variables` the words its instructions and address may fill in.
     *
     * Needs the `payments.read` permission (Read Payment Methods).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     kind: string,
     *     name: string,
     *     description: string,
     *     instructions: string,
     *     redirectUrl: string,
     *     iconUrl: mixed,
     *     asksProof: bool,
     *     requiresPicture: bool,
     *     enabled: bool
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/custom-payment-methods/list-custom-payment-methods
     */
    public function list(array $options = []): mixed
    {
        return $this->caller->call('customMethods.list', [], [], $options);
    }

    /**
     * **Create a custom payment method**
     *
     * Adds a method, after every other at checkout. A store holds up to 10. Answers the new method.
     *
     * Needs the `payments.write` permission (Change Payment Methods).
     *
     * Fields:
     *
     * - `kind`: `instructions`: the buyer is shown how to pay. `redirect`: the buyer is sent to a page of yours.
     * - `name`: What the checkout calls it, up to 60 characters.
     * - `description`: A line under its name at checkout, up to 160 characters.
     * - `instructions`: For `instructions`: how to pay, in Markdown, up to 300 characters. `{order}`, `{amount}`, `{currency}`, `{email}` and `{store}` are filled in.
     * - `redirectUrl`: For `redirect`: the https address the buyer is sent to, up to 1000 characters, with the same variables filled in.
     * - `asksProof`: Whether the buyer is asked for a reference or a proof of payment, at least one.
     * - `requiresPicture`: Whether a proof of payment is required, whatever else is sent. Needs `asksProof`.
     * - `enabled`: Whether the checkout offers it.
     *
     * @param array{
     *     kind?: 'instructions'|'redirect',
     *     name?: string,
     *     description?: string,
     *     instructions?: string,
     *     redirectUrl?: string,
     *     asksProof?: bool,
     *     requiresPicture?: bool,
     *     enabled?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     kind: string,
     *     name: string,
     *     description: string,
     *     instructions: string,
     *     redirectUrl: string,
     *     iconUrl: mixed,
     *     asksProof: bool,
     *     requiresPicture: bool,
     *     enabled: bool
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/custom-payment-methods/create-a-custom-payment-method
     */
    public function create(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('customMethods.create', [], $params, $options);
    }

    /**
     * **Update a custom payment method**
     *
     * Changes what is sent and keeps the rest. A payment already opened keeps what its buyer was told. Answers the store's custom methods again, as "List custom payment methods" does.
     *
     * Needs the `payments.write` permission (Change Payment Methods).
     *
     * Fields:
     *
     * - `kind`: `instructions`: the buyer is shown how to pay. `redirect`: the buyer is sent to a page of yours.
     * - `name`: What the checkout calls it, up to 60 characters.
     * - `description`: A line under its name at checkout, up to 160 characters.
     * - `instructions`: For `instructions`: how to pay, in Markdown, up to 300 characters. `{order}`, `{amount}`, `{currency}`, `{email}` and `{store}` are filled in.
     * - `redirectUrl`: For `redirect`: the https address the buyer is sent to, up to 1000 characters, with the same variables filled in.
     * - `asksProof`: Whether the buyer is asked for a reference or a proof of payment, at least one.
     * - `requiresPicture`: Whether a proof of payment is required, whatever else is sent. Needs `asksProof`.
     * - `enabled`: Whether the checkout offers it.
     *
     * @param string $methodId The method, by its ID (`custom_` and 16 hex characters).
     * @param array{
     *     kind?: 'instructions'|'redirect',
     *     name?: string,
     *     description?: string,
     *     instructions?: string,
     *     redirectUrl?: string,
     *     asksProof?: bool,
     *     requiresPicture?: bool,
     *     enabled?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     kind: string,
     *     name: string,
     *     description: string,
     *     instructions: string,
     *     redirectUrl: string,
     *     iconUrl: mixed,
     *     asksProof: bool,
     *     requiresPicture: bool,
     *     enabled: bool
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/custom-payment-methods/update-a-custom-payment-method
     */
    public function update(string $methodId, array $params = [], array $options = []): mixed
    {
        return $this->caller->call('customMethods.update', [$methodId], $params, $options);
    }

    /**
     * **Delete a custom payment method**
     *
     * Its orders keep its name. Its ID is never used again. Answers the store's custom methods again, as "List custom payment methods" does.
     *
     * Needs the `payments.write` permission (Change Payment Methods).
     *
     * @param string $methodId The method, by its ID (`custom_` and 16 hex characters).
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     kind: string,
     *     name: string,
     *     description: string,
     *     instructions: string,
     *     redirectUrl: string,
     *     iconUrl: mixed,
     *     asksProof: bool,
     *     requiresPicture: bool,
     *     enabled: bool
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/custom-payment-methods/delete-a-custom-payment-method
     */
    public function delete(string $methodId, array $options = []): mixed
    {
        return $this->caller->call('customMethods.delete', [$methodId], [], $options);
    }

    /**
     * **Switch a custom payment method on or off**
     *
     * Answers the store's custom methods again, as "List custom payment methods" does.
     *
     * Needs the `payments.write` permission (Change Payment Methods).
     *
     * Fields:
     *
     * - `enabled` (required): Whether the checkout offers it.
     *
     * @param string $methodId The method, by its ID (`custom_` and 16 hex characters).
     * @param array{
     *     enabled: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     kind: string,
     *     name: string,
     *     description: string,
     *     instructions: string,
     *     redirectUrl: string,
     *     iconUrl: mixed,
     *     asksProof: bool,
     *     requiresPicture: bool,
     *     enabled: bool
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/custom-payment-methods/switch-a-custom-payment-method-on-or-off
     */
    public function setEnabled(string $methodId, array $params, array $options = []): mixed
    {
        return $this->caller->call('customMethods.setEnabled', [$methodId], $params, $options);
    }

    /**
     * **Sort custom payment methods**
     *
     * Puts the methods named in this order, in the places they hold now among the connected ones. To move one between connected methods, use "Sort payment methods" with its ID. Answers the store's custom methods again, as "List custom payment methods" does.
     *
     * Needs the `payments.write` permission (Change Payment Methods).
     *
     * Fields:
     *
     * - `ids` (required): The methods' IDs in their new order.
     *
     * @param array{
     *     ids: list<string>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     kind: string,
     *     name: string,
     *     description: string,
     *     instructions: string,
     *     redirectUrl: string,
     *     iconUrl: mixed,
     *     asksProof: bool,
     *     requiresPicture: bool,
     *     enabled: bool
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/custom-payment-methods/sort-custom-payment-methods
     */
    public function sort(array $params, array $options = []): mixed
    {
        return $this->caller->call('customMethods.sort', [], $params, $options);
    }

    /**
     * **Upload a custom payment method's icon**
     *
     * Sent as `multipart/form-data` in a field called `image`. It replaces the one it had. Answers the store's custom methods again, as "List custom payment methods" does.
     *
     * Needs the `payments.write` permission (Change Payment Methods).
     *
     * @param string $methodId The method, by its ID (`custom_` and 16 hex characters).
     * @param array{
     *     file: string|\CURLFile,
     *     filename?: string,
     *     contentType?: string
     * } $params The file: a path on disk, or a CURLFile.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/custom-payment-methods/upload-a-custom-payment-methods-icon
     */
    public function uploadIcon(string $methodId, array $params, array $options = []): mixed
    {
        return $this->caller->call('customMethods.uploadIcon', [$methodId], $params, $options);
    }

    /**
     * **Remove a custom payment method's icon**
     *
     * Answers the store's custom methods again, as "List custom payment methods" does.
     *
     * Needs the `payments.write` permission (Change Payment Methods).
     *
     * @param string $methodId The method, by its ID (`custom_` and 16 hex characters).
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/custom-payment-methods/remove-a-custom-payment-methods-icon
     */
    public function deleteIcon(string $methodId, array $options = []): mixed
    {
        return $this->caller->call('customMethods.deleteIcon', [$methodId], [], $options);
    }
}
