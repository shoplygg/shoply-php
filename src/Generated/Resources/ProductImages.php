<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class ProductImages
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **Upload a product picture**
     *
     * Adds a picture to the product, sent as `multipart/form-data` in a field called `image`. A product holds up to 10. The first one uploaded is the one listings show.
     *
     * Needs the `products.write` permission (Change Products).
     *
     * @param string $productId The product.
     * @param array{
     *     file: string|\CURLFile,
     *     filename?: string,
     *     contentType?: string
     * } $params The file: a path on disk, or a CURLFile.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/product-pictures/upload-a-product-picture
     */
    public function upload(string $productId, array $params, array $options = []): mixed
    {
        return $this->caller->call('productImages.upload', [$productId], $params, $options);
    }

    /**
     * **Sort a product's pictures**
     *
     * Sets the order of the product's pictures, or moves one to the front. The first picture is the one listings show. Send one of the two fields.
     *
     * Needs the `products.write` permission (Change Products).
     *
     * Fields:
     *
     * - `imageIds`: Every picture's ID, in the new order.
     * - `imageId`: One picture to move to the front, leaving the rest as they are.
     *
     * @param string $productId The product.
     * @param array{
     *     imageIds?: list<string>,
     *     imageId?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/product-pictures/sort-a-products-pictures
     */
    public function sort(string $productId, array $params = [], array $options = []): mixed
    {
        return $this->caller->call('productImages.sort', [$productId], $params, $options);
    }

    /**
     * **Delete a product picture**
     *
     * Removes one picture from the product.
     *
     * Needs the `products.write` permission (Change Products).
     *
     * @param string $productId The product.
     * @param string $imageId The picture.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/product-pictures/delete-a-product-picture
     */
    public function delete(string $productId, string $imageId, array $options = []): mixed
    {
        return $this->caller->call('productImages.delete', [$productId, $imageId], [], $options);
    }
}
