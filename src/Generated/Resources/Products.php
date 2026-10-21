<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Products
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List products**
     *
     * Every product the store has, in the store's own order, each with its variants, pictures, categories and stock counts. A store holds up to 250 products, so the list is not paged.
     *
     * Needs the `products.read` permission (Read Products).
     *
     * Fields:
     *
     * - `visibility`: Only products with this visibility.
     * - `search`: Only products whose name contains this.
     *
     * @param array{
     *     visibility?: 'public'|'unlisted'|'private',
     *     search?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     storeId: string,
     *     name: string,
     *     slug: string,
     *     description: string,
     *     seoTitle: string,
     *     seoDescription: string,
     *     image: string,
     *     imageUrl: mixed,
     *     visibility: string,
     *     sort: int|float,
     *     isBestSeller: bool,
     *     badges: list<array{
     *         label: string,
     *         color: string,
     *         kind: string
     *     }>,
     *     features: list<array{
     *         type: string,
     *         name: string
     *     }>,
     *     deliveryInstructions: string,
     *     blockedPaymentMethods: array<mixed>,
     *     paymentFees: array<mixed>,
     *     showViewers: bool,
     *     showSales: bool,
     *     salesWindow: string,
     *     saleNotifications: bool,
     *     metadata: string,
     *     dateCreated: string,
     *     updatedAt: string,
     *     categoryIds: list<string>,
     *     unitsSold: int|float,
     *     revenue: int|float,
     *     lowPrice: int|float,
     *     highPrice: int|float,
     *     totalStock: int|float,
     *     untrackedVariants: int|float,
     *     imageCount: int|float,
     *     images: array<mixed>,
     *     variants: list<array{
     *         id: string,
     *         label: string,
     *         price: int|float,
     *         duration: string,
     *         durationDays: int|float,
     *         stockMode: int|float,
     *         minQuantity: int|float,
     *         maxQuantity: int|float,
     *         stock: int|float,
     *         keyCount: int|float,
     *         deliveryMethods: list<string>,
     *         deliveryType: string,
     *         deliveryInstructions: string,
     *         dynamicUrl: string,
     *         customFieldsOn: bool,
     *         customFields: array<mixed>,
     *         sort: int|float,
     *         blockedPaymentMethods: array<mixed>
     *     }>,
     *     runningSubscriptions: int|float
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/products/list-products
     */
    public function list(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('products.list', [], $params, $options);
    }

    /**
     * **Create a product**
     *
     * Adds a product with its variants. A store holds up to 250 products. Stock is added afterwards, a variant at a time, with the variant IDs in the answer.
     *
     * A refusal names the field, and for a variant its place in the list: `variants.0.price`.
     *
     * Needs the `products.write` permission (Change Products).
     *
     * Fields:
     *
     * - `name` (required): The product's name.
     * - `slug`: The last part of its address on the storefront. Left out, it is made from the name.
     * - `description`: What the product page says. Plain text with a few marks: a line that starts with `#` is a heading, one that starts with `-` is a point of a list, a blank line ends a paragraph, and `**bold**` and backticks for code work inside a line.
     * - `visibility`: `public` is listed and can be bought. `unlisted` can be bought by whoever has its link. `private` cannot be bought. Left out, it is "public".
     * - `variants` (required): The product's options, 1 to 100 of them, in the order buyers see them. A variant of the product that is not in this list is removed.
     * - `deliveryInstructions`: Text sent to the buyer with every variant of the product once the order is paid, whatever the variant delivers, up to 5,000 characters. A variant's own instructions are sent after it. Empty is none. Left out on an update, it stays as it is.
     * - `categoryIds`: The categories it is in. Left out on an update, they stay as they are.
     * - `isBestSeller`: Whether the storefront marks it as a best seller. Left out, it is false.
     * - `badges`: Up to 3 short labels on the product. Left out on an update, they stay as they are.
     * - `features`: What the product does, as a list. Each entry is a feature on its own or a named group of features. Up to 500 features and 30 groups. Left out on an update, they stay as they are.
     * - `blockedPaymentMethods`: Payment methods the product cannot be bought with, by their names in the payment methods list. Left out on an update, they stay as they are.
     * - `paymentFees`: What a payment method adds to this product's price: a payment method's name, and under it `percent` and `fixed`. A fee can only add. Left out on an update, the fees stay as they are.
     * - `salesWindow`: The period the storefront's "sold" figure for this product counts. Left out, it is "all".
     * - `metadata`: Anything of your own to keep with the product, as JSON. Shoply stores it and does nothing with it. It is answered as text.
     * - `seoTitle`: The product's own title in search results, up to 70 characters. Empty is its name.
     * - `seoDescription`: Its own description in search results, up to 200 characters. Empty is its description.
     *
     * @param array{
     *     name: string,
     *     slug?: string,
     *     description?: string,
     *     visibility?: 'public'|'unlisted'|'private',
     *     variants: list<array{
     *         id?: string,
     *         label: string,
     *         price: int|float,
     *         minQuantity?: int,
     *         maxQuantity?: int,
     *         deliveryMethods?: list<'license_keys'|'instructions'|'dynamic'|'files'>,
     *         stockMode?: 1|2|3,
     *         stock?: int,
     *         deliveryInstructions?: string,
     *         dynamicUrl?: string,
     *         customFieldsOn?: bool,
     *         customFields?: list<array{
     *             label: string,
     *             key?: string,
     *             type?: 'text'|'long_text'|'number'|'dropdown'|'choice'|'tick',
     *             required?: bool,
     *             placeholder?: string,
     *             hint?: string,
     *             options?: list<string>
     *         }>,
     *         blockedPaymentMethods?: list<string>,
     *         sort?: int
     *     }>,
     *     deliveryInstructions?: string,
     *     categoryIds?: list<string>,
     *     isBestSeller?: bool,
     *     badges?: list<array{
     *         label: string,
     *         color?: ''|'blue'|'green'|'amber'|'red'|'purple'|'gray',
     *         kind?: 'label'|'status'
     *     }>,
     *     features?: list<array{
     *         type: 'feature'|'category',
     *         name: string,
     *         features?: list<string>
     *     }>,
     *     blockedPaymentMethods?: list<string>,
     *     paymentFees?: array<string, mixed>,
     *     salesWindow?: 'all'|'1h'|'6h'|'12h'|'24h'|'7d'|'30d',
     *     metadata?: array<string, mixed>,
     *     seoTitle?: string,
     *     seoDescription?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     storeId: string,
     *     name: string,
     *     slug: string,
     *     description: string,
     *     seoTitle: string,
     *     seoDescription: string,
     *     image: string,
     *     imageUrl: mixed,
     *     visibility: string,
     *     sort: int|float,
     *     isBestSeller: bool,
     *     badges: list<array{
     *         label: string,
     *         color: string,
     *         kind: string
     *     }>,
     *     features: list<array{
     *         type: string,
     *         name: string
     *     }>,
     *     deliveryInstructions: string,
     *     blockedPaymentMethods: array<mixed>,
     *     paymentFees: array<mixed>,
     *     showViewers: bool,
     *     showSales: bool,
     *     salesWindow: string,
     *     saleNotifications: bool,
     *     metadata: string,
     *     dateCreated: string,
     *     updatedAt: string,
     *     categoryIds: list<string>,
     *     unitsSold: int|float,
     *     revenue: int|float,
     *     lowPrice: int|float,
     *     highPrice: int|float,
     *     totalStock: int|float,
     *     untrackedVariants: int|float,
     *     imageCount: int|float,
     *     images: array<mixed>,
     *     variants: list<array{
     *         id: string,
     *         label: string,
     *         price: int|float,
     *         duration: string,
     *         durationDays: int|float,
     *         stockMode: int|float,
     *         minQuantity: int|float,
     *         maxQuantity: int|float,
     *         stock: int|float,
     *         keyCount: int|float,
     *         deliveryMethods: list<string>,
     *         deliveryType: string,
     *         deliveryInstructions: string,
     *         dynamicUrl: string,
     *         customFieldsOn: bool,
     *         customFields: array<mixed>,
     *         sort: int|float,
     *         blockedPaymentMethods: array<mixed>
     *     }>,
     *     runningSubscriptions: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/products/create-a-product
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('products.create', [], $params, $options);
    }

    /**
     * **Get a product**
     *
     * One product, with everything its editor shows.
     *
     * Needs the `products.read` permission (Read Products).
     *
     * @param string $productId The product.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     storeId: string,
     *     name: string,
     *     slug: string,
     *     description: string,
     *     seoTitle: string,
     *     seoDescription: string,
     *     image: string,
     *     imageUrl: mixed,
     *     visibility: string,
     *     sort: int|float,
     *     isBestSeller: bool,
     *     badges: list<array{
     *         label: string,
     *         color: string,
     *         kind: string
     *     }>,
     *     features: list<array{
     *         type: string,
     *         name: string
     *     }>,
     *     deliveryInstructions: string,
     *     blockedPaymentMethods: array<mixed>,
     *     paymentFees: array<mixed>,
     *     showViewers: bool,
     *     showSales: bool,
     *     salesWindow: string,
     *     saleNotifications: bool,
     *     metadata: string,
     *     dateCreated: string,
     *     updatedAt: string,
     *     categoryIds: list<string>,
     *     unitsSold: int|float,
     *     revenue: int|float,
     *     lowPrice: int|float,
     *     highPrice: int|float,
     *     totalStock: int|float,
     *     untrackedVariants: int|float,
     *     imageCount: int|float,
     *     images: array<mixed>,
     *     variants: list<array{
     *         id: string,
     *         label: string,
     *         price: int|float,
     *         duration: string,
     *         durationDays: int|float,
     *         stockMode: int|float,
     *         minQuantity: int|float,
     *         maxQuantity: int|float,
     *         stock: int|float,
     *         keyCount: int|float,
     *         deliveryMethods: list<string>,
     *         deliveryType: string,
     *         deliveryInstructions: string,
     *         dynamicUrl: string,
     *         customFieldsOn: bool,
     *         customFields: array<mixed>,
     *         sort: int|float,
     *         blockedPaymentMethods: array<mixed>
     *     }>,
     *     runningSubscriptions: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/products/get-a-product
     */
    public function show(string $productId, array $options = []): mixed
    {
        return $this->caller->call('products.show', [$productId], [], $options);
    }

    /**
     * **Update a product**
     *
     * Saves the product whole, as its editor does: send every field as it should be. `variants` is the complete list. An entry with an `id` changes that variant, an entry without one is added, and a variant left out is removed with its unsold stock. A variant buyers have received license keys from cannot be removed.
     *
     * Read the product first and send it back changed. The fields that say "stay as they are" are the only ones that may be left out.
     *
     * Needs the `products.write` permission (Change Products).
     *
     * Fields:
     *
     * - `name` (required): The product's name.
     * - `slug`: The last part of its address on the storefront. Left out, it is made from the name.
     * - `description`: What the product page says. Plain text with a few marks: a line that starts with `#` is a heading, one that starts with `-` is a point of a list, a blank line ends a paragraph, and `**bold**` and backticks for code work inside a line.
     * - `visibility`: `public` is listed and can be bought. `unlisted` can be bought by whoever has its link. `private` cannot be bought. Left out, it is "public".
     * - `variants` (required): The product's options, 1 to 100 of them, in the order buyers see them. A variant of the product that is not in this list is removed.
     * - `deliveryInstructions`: Text sent to the buyer with every variant of the product once the order is paid, whatever the variant delivers, up to 5,000 characters. A variant's own instructions are sent after it. Empty is none. Left out on an update, it stays as it is.
     * - `categoryIds`: The categories it is in. Left out on an update, they stay as they are.
     * - `isBestSeller`: Whether the storefront marks it as a best seller. Left out, it is false.
     * - `badges`: Up to 3 short labels on the product. Left out on an update, they stay as they are.
     * - `features`: What the product does, as a list. Each entry is a feature on its own or a named group of features. Up to 500 features and 30 groups. Left out on an update, they stay as they are.
     * - `blockedPaymentMethods`: Payment methods the product cannot be bought with, by their names in the payment methods list. Left out on an update, they stay as they are.
     * - `paymentFees`: What a payment method adds to this product's price: a payment method's name, and under it `percent` and `fixed`. A fee can only add. Left out on an update, the fees stay as they are.
     * - `salesWindow`: The period the storefront's "sold" figure for this product counts. Left out, it is "all".
     * - `metadata`: Anything of your own to keep with the product, as JSON. Shoply stores it and does nothing with it. It is answered as text.
     * - `seoTitle`: The product's own title in search results, up to 70 characters. Empty is its name.
     * - `seoDescription`: Its own description in search results, up to 200 characters. Empty is its description.
     * - `expectedUpdatedAt`: The `updatedAt` you last read. Sent, the change is refused with `stale_write` if the record has changed since. Left out, it is saved whatever happened in between.
     *
     * @param string $productId The product.
     * @param array{
     *     name: string,
     *     slug?: string,
     *     description?: string,
     *     visibility?: 'public'|'unlisted'|'private',
     *     variants: list<array{
     *         id?: string,
     *         label: string,
     *         price: int|float,
     *         minQuantity?: int,
     *         maxQuantity?: int,
     *         deliveryMethods?: list<'license_keys'|'instructions'|'dynamic'|'files'>,
     *         stockMode?: 1|2|3,
     *         stock?: int,
     *         deliveryInstructions?: string,
     *         dynamicUrl?: string,
     *         customFieldsOn?: bool,
     *         customFields?: list<array{
     *             label: string,
     *             key?: string,
     *             type?: 'text'|'long_text'|'number'|'dropdown'|'choice'|'tick',
     *             required?: bool,
     *             placeholder?: string,
     *             hint?: string,
     *             options?: list<string>
     *         }>,
     *         blockedPaymentMethods?: list<string>,
     *         sort?: int
     *     }>,
     *     deliveryInstructions?: string,
     *     categoryIds?: list<string>,
     *     isBestSeller?: bool,
     *     badges?: list<array{
     *         label: string,
     *         color?: ''|'blue'|'green'|'amber'|'red'|'purple'|'gray',
     *         kind?: 'label'|'status'
     *     }>,
     *     features?: list<array{
     *         type: 'feature'|'category',
     *         name: string,
     *         features?: list<string>
     *     }>,
     *     blockedPaymentMethods?: list<string>,
     *     paymentFees?: array<string, mixed>,
     *     salesWindow?: 'all'|'1h'|'6h'|'12h'|'24h'|'7d'|'30d',
     *     metadata?: array<string, mixed>,
     *     seoTitle?: string,
     *     seoDescription?: string,
     *     expectedUpdatedAt?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     storeId: string,
     *     name: string,
     *     slug: string,
     *     description: string,
     *     seoTitle: string,
     *     seoDescription: string,
     *     image: string,
     *     imageUrl: mixed,
     *     visibility: string,
     *     sort: int|float,
     *     isBestSeller: bool,
     *     badges: list<array{
     *         label: string,
     *         color: string,
     *         kind: string
     *     }>,
     *     features: list<array{
     *         type: string,
     *         name: string
     *     }>,
     *     deliveryInstructions: string,
     *     blockedPaymentMethods: array<mixed>,
     *     paymentFees: array<mixed>,
     *     showViewers: bool,
     *     showSales: bool,
     *     salesWindow: string,
     *     saleNotifications: bool,
     *     metadata: string,
     *     dateCreated: string,
     *     updatedAt: string,
     *     categoryIds: list<string>,
     *     unitsSold: int|float,
     *     revenue: int|float,
     *     lowPrice: int|float,
     *     highPrice: int|float,
     *     totalStock: int|float,
     *     untrackedVariants: int|float,
     *     imageCount: int|float,
     *     images: array<mixed>,
     *     variants: list<array{
     *         id: string,
     *         label: string,
     *         price: int|float,
     *         duration: string,
     *         durationDays: int|float,
     *         stockMode: int|float,
     *         minQuantity: int|float,
     *         maxQuantity: int|float,
     *         stock: int|float,
     *         keyCount: int|float,
     *         deliveryMethods: list<string>,
     *         deliveryType: string,
     *         deliveryInstructions: string,
     *         dynamicUrl: string,
     *         customFieldsOn: bool,
     *         customFields: array<mixed>,
     *         sort: int|float,
     *         blockedPaymentMethods: array<mixed>
     *     }>,
     *     runningSubscriptions: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/products/update-a-product
     */
    public function update(string $productId, array $params, array $options = []): mixed
    {
        return $this->caller->call('products.update', [$productId], $params, $options);
    }

    /**
     * **Delete a product**
     *
     * Removes the product with its variants, pictures and unsold stock. Refused for a product buyers have received license keys from, since those keys are part of their orders: set its visibility to `private` instead.
     *
     * Needs the `products.write` permission (Change Products).
     *
     * @param string $productId The product.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/products/delete-a-product
     */
    public function delete(string $productId, array $options = []): mixed
    {
        return $this->caller->call('products.delete', [$productId], [], $options);
    }

    /**
     * **Set a product's visibility**
     *
     * Changes who can see and buy the product, without sending the rest of it.
     *
     * Needs the `products.write` permission (Change Products).
     *
     * Fields:
     *
     * - `visibility` (required): The new visibility.
     *
     * @param string $productId The product.
     * @param array{
     *     visibility: 'public'|'unlisted'|'private'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     visibility: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/products/set-a-products-visibility
     */
    public function setVisibility(string $productId, array $params, array $options = []): mixed
    {
        return $this->caller->call('products.setVisibility', [$productId], $params, $options);
    }

    /**
     * **Sort products**
     *
     * Sets the order products are listed in, on the storefront and everywhere else.
     *
     * Needs the `products.write` permission (Change Products).
     *
     * Fields:
     *
     * - `productIds` (required): The products' IDs in their new order.
     *
     * @param array{
     *     productIds: list<string>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     reordered: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/products/sort-products
     */
    public function sort(array $params, array $options = []): mixed
    {
        return $this->caller->call('products.sort', [], $params, $options);
    }

    /**
     * **Change many products**
     *
     * One change made to many products. Only what is sent changes.
     *
     * Needs the `products.write` permission (Change Products).
     *
     * Fields:
     *
     * - `productIds` (required): The products, by ID. Up to 250.
     * - `visibility`: A visibility for all of them.
     * - `isBestSeller`: Whether all of them are marked as best sellers.
     * - `paymentMethods`: A payment method's name, and `block` or `allow`. `block` adds the method to each product's blocked list. `allow` takes it off the product and off every variant of it.
     * - `deliveryInstructions`: Instructions for every variant of all of them, up to 5,000 characters, in place of what each has. Empty takes them off. A variant's own instructions are not touched.
     *
     * @param array{
     *     productIds: list<string>,
     *     visibility?: 'public'|'unlisted'|'private',
     *     isBestSeller?: bool,
     *     paymentMethods?: array<string, mixed>,
     *     deliveryInstructions?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     updated: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/products/change-many-products
     */
    public function bulkUpdate(array $params, array $options = []): mixed
    {
        return $this->caller->call('products.bulkUpdate', [], $params, $options);
    }

    /**
     * **Delete many products**
     *
     * Deletes each product as deleting one does. A product buyers have received license keys from is kept, and the answer names the ones that stayed.
     *
     * Needs the `products.write` permission (Change Products).
     *
     * Fields:
     *
     * - `productIds` (required): The products, by ID. Up to 250.
     *
     * @param array{
     *     productIds: list<string>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/products/delete-many-products
     */
    public function bulkDelete(array $params, array $options = []): mixed
    {
        return $this->caller->call('products.bulkDelete', [], $params, $options);
    }
}
