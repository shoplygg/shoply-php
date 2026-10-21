<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class CustomerOrders
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **Get an order**
     *
     * One of the buyer's orders, as its page in the customer panel shows it: each line, and once it is completed what it delivered (keys, the answers of a dynamic delivery, files with their download links, instructions). An order of another address answers as one that does not exist.
     *
     * Keys and files are left out while the store holds them back: an ended or paused subscription's order, or one whose payment is disputed. `productPath` is the product's path on the store's own site. Opening an order is recorded for the store, as on its order page, as a look from the store's own site.
     *
     * Needs the buyer's token: `Authorization: Bearer shoply_ct_...`, from Sign in with the code.
     *
     * It is counted for the buyer's token: 300 reads in ten minutes.
     *
     * @param string $orderId One of the buyer's orders, from Get the signed-in buyer.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     status: string,
     *     dateCreated: string,
     *     paidAt: string,
     *     paidWith: string,
     *     currencyCode: string,
     *     shopCurrency: string,
     *     subtotal: int|float,
     *     discount: int|float,
     *     fee: int|float,
     *     tax: mixed,
     *     total: int|float,
     *     couponCode: string,
     *     checkoutUrl: string,
     *     lines: list<array{
     *         productName: string,
     *         variantName: string,
     *         quantity: int|float,
     *         lineTotal: int|float,
     *         imageUrl: mixed,
     *         productPath: string,
     *         delivery: array{
     *             keys: list<string>,
     *             previousKeys: array<mixed>,
     *             items: array<mixed>,
     *             previousItems: array<mixed>,
     *             state: string,
     *             message: string,
     *             instructions: string,
     *             files: array<mixed>
     *         }
     *     }>,
     *     general: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customer-api/get-an-order
     */
    public function show(string $orderId, array $options = []): mixed
    {
        return $this->caller->call('customer.orders.show', [$orderId], [], $options);
    }
}
