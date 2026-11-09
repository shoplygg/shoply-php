<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class ResellerProducts
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List what the panel sells**
     *
     * Every option of the store's products the panel sells, a row an option: its Reseller Price (`price`), the fewest bought at once (`minQty`), the most one reseller may buy of it in a day (`dailyCap`), the most a tier or a reseller's own discount may take off it (`maxDiscount`), whether it is on sale (`enabled`) and its stock. `meta.badges` is each product's status and labels on the panel, by its ID, and `meta.tiers` the tiers.
     *
     * Needs the `resellers.read` permission (Read Resellers).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     variantId: string,
     *     productId: string,
     *     productName: string,
     *     variantName: string,
     *     image: mixed,
     *     delivery: string,
     *     stock: int|float,
     *     price: int|float,
     *     minQty: int|float,
     *     dailyCap: int|float,
     *     maxDiscount: mixed,
     *     enabled: bool
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/list-what-the-panel-sells
     */
    public function list(array $options = []): mixed
    {
        return $this->caller->call('resellerProducts.list', [], [], $options);
    }

    /**
     * **Sell products on the panel**
     *
     * Puts options on the panel or changes them, up to 1,000 at once, all or none: one row refused leaves every row as it was, and the errors are keyed by the option and the field (`<variantId>.price`). An option not sent is left as it is. Answers every row the panel sells.
     *
     * Needs the `resellers.write` permission (Change Resellers).
     *
     * Fields:
     *
     * - `rows` (required): One a product option: `variantId`; `price`, its Reseller Price, above 0 and up to 1,000,000; `minQty`, the fewest bought at once, 1 to 1,000 (1 when left out); `dailyCap`, the most one reseller may buy of it in a day, or null for no cap; `maxDiscount`, the most off it in percent, or null for no limit (left out, as it was); `enabled`, whether it is on sale (true when left out).
     *
     * @param array{
     *     rows: list<array<string, mixed>>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     variantId: string,
     *     productId: string,
     *     productName: string,
     *     variantName: string,
     *     image: mixed,
     *     delivery: string,
     *     stock: int|float,
     *     price: int|float,
     *     minQty: int|float,
     *     dailyCap: int|float,
     *     maxDiscount: mixed,
     *     enabled: bool
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/sell-products-on-the-panel
     */
    public function save(array $params, array $options = []): mixed
    {
        return $this->caller->call('resellerProducts.save', [], $params, $options);
    }

    /**
     * **List what the panel can sell**
     *
     * The store's products with the options a panel can sell: those delivered as license keys or by dynamic delivery. A file is never sold to resellers. `meta.categories` is the store's categories they are in.
     *
     * Needs the `resellers.read` permission (Read Resellers).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     variantId: string,
     *     productId: string,
     *     productName: string,
     *     variantName: string,
     *     image: mixed,
     *     delivery: string,
     *     inPanel: bool,
     *     price: int|float
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/list-what-the-panel-can-sell
     */
    public function pickable(array $options = []): mixed
    {
        return $this->caller->call('resellerProducts.pickable', [], [], $options);
    }

    /**
     * **Stop selling an option on the panel**
     *
     * Takes one option off the panel. What resellers bought of it stays on record. Answers every row the panel still sells.
     *
     * Needs the `resellers.write` permission (Change Resellers).
     *
     * @param string $variantId The product option.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array<mixed>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/stop-selling-an-option-on-the-panel
     */
    public function remove(string $variantId, array $options = []): mixed
    {
        return $this->caller->call('resellerProducts.remove', [$variantId], [], $options);
    }

    /**
     * **Set a product's status and labels on the panel**
     *
     * What resellers read beside a product on the panel, never the product's own badges: one status and labels, as a product's badges are written. An empty list takes them off. 404 for a product the panel does not sell. Answers every product's, by its ID.
     *
     * Needs the `resellers.write` permission (Change Resellers).
     *
     * Fields:
     *
     * - `badges` (required): Up to 3, each `{ label, color, kind }`: `label` 1 to 32 characters; `color` one of `blue`, `green`, `amber`, `red`, `purple` and `gray`, a `#rrggbb` colour, or empty for the plain look; `kind` `label`, or `status` for one at most.
     *
     * @param string $productId The product.
     * @param array{
     *     badges: list<array<string, mixed>>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     '7626c760-c6cd-4b38-8344-cfbba0148a80': list<array{
     *         label: string,
     *         color: string,
     *         kind: string
     *     }>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/resellers/set-a-products-status-and-labels-on-the-panel
     */
    public function badges(string $productId, array $params, array $options = []): mixed
    {
        return $this->caller->call('resellerProducts.badges', [$productId], $params, $options);
    }
}
