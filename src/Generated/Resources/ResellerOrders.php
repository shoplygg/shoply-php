<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class ResellerOrders
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List reseller orders**
     *
     * What resellers bought, newest first, 25 a page: who (`reseller`, and `boughtBy`, the member of their team), what and how many, the `total` taken off their balance, and how it was bought (`via`: `panel`, `api` for their own API, or `url` for a delivery URL). These are never the store's orders: List orders does not have them, and no order webhook is sent for them. `meta.counts` is how many each way, and `meta.figures` the last 30 days'.
     *
     * Needs the `resellers.read` permission (Read Resellers).
     *
     * Fields:
     *
     * - `q`: Only what matches this text: an order's ID, a reseller's website, or who bought or paid.
     * - `reseller`: Only one reseller's, by their ID.
     * - `via`: Only those bought one way.
     * - `page`: Which page of the list. The first is 1. Left out, it is 1.
     *
     * @param array{
     *     q?: string,
     *     reseller?: string,
     *     via?: 'panel'|'api'|'url',
     *     page?: int
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\Page<array{
     *     id: string,
     *     resellerId: string,
     *     reseller: string,
     *     resellerRemoved: bool,
     *     boughtBy: string,
     *     productName: string,
     *     variantName: string,
     *     quantity: int|float,
     *     total: int|float,
     *     currency: string,
     *     status: string,
     *     via: string,
     *     createdAt: string
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/list-reseller-orders
     */
    public function list(array $params = [], array $options = []): \Shoply\Page
    {
        return $this->caller->call('resellerOrders.list', [], $params, $options);
    }

    /**
     * **Export reseller orders**
     *
     * The orders the same filters would list, as a CSV file: Order ID, Reseller, Bought By, Product, Variant, Quantity, Total, Currency, Bought With and Date. No delivered key is in it. Every row the filters match is in the file, up to 50,000, sent as it is read. Add `check=1` for `{ rows }`, how many it would have, which is not counted. A store exports at most 30 files every 10 minutes, whatever they are of, whoever asks: after that the answer is 429.
     *
     * Needs the `resellers.read` permission (Read Resellers). It is one of the heavier reads, and is counted against a smaller budget of its own: 60 a minute for each key.
     *
     * Fields:
     *
     * - `q`: Only what matches this text: an order's ID, a reseller's website, or who bought or paid.
     * - `reseller`: Only one reseller's, by their ID.
     * - `via`: Only those bought one way.
     * - `check`: `1` for how many rows the file would have, as `{ rows }`, in place of the file.
     *
     * @param array{
     *     q?: string,
     *     reseller?: string,
     *     via?: 'panel'|'api'|'url',
     *     check?: '1'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\File
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/export-reseller-orders
     */
    public function export(array $params = [], array $options = []): \Shoply\File
    {
        return $this->caller->call('resellerOrders.export', [], $params, $options);
    }
}
