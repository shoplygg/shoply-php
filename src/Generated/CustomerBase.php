<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated;

/** The routes, as resources and methods: what `Shoply\Customer` is made of. */
abstract class CustomerBase implements Caller
{
    public readonly Resources\CustomerOrders $orders;
    public readonly Resources\CustomerAffiliate $affiliate;
    public readonly Resources\CustomerSubscriptions $subscriptions;

    public function __construct()
    {
        $this->orders = new Resources\CustomerOrders($this);
        $this->affiliate = new Resources\CustomerAffiliate($this);
        $this->subscriptions = new Resources\CustomerSubscriptions($this);
    }

    /**
     * **Send a sign-in code**
     *
     * Emails a six-digit code to the address a buyer typed, for them to type back with Sign in with the code. The code works for 10 minutes, five tries.
     *
     * The answer is the same for any address, and a code is only mailed to an address that has orders at the store, so this cannot be used to find out who has bought there. One address is sent a code a minute at most, five an hour and ten a day: past that the answer is `code_cooldown` with `resendIn`, the seconds to wait. A store sends 60 codes an hour at most, and past that, or on a busy hour for the whole platform, the answer is `store_busy`.
     *
     * Call it from the buyer's own device. It is counted for the address that asks, 10 an hour, so a server asking for every buyer would run out at once.
     *
     * It is counted for the address that asks: 10 an hour.
     *
     * Fields:
     *
     * - `email` (required): The address the buyer bought with.
     *
     * @param array{
     *     email: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     email: string,
     *     resendIn: int|float,
     *     expiresIn: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customer-api/send-a-sign-in-code
     */
    public function login(array $params, array $options = []): mixed
    {
        return $this->call('customer.login', [], $params, $options);
    }

    /**
     * **Sign in with the code**
     *
     * Trades the emailed code for the buyer's token, which every other route of the Customer API takes as `Authorization: Bearer shoply_ct_...`. It reaches this buyer's own orders at this store and nothing else, and works for 30 days.
     *
     * Keep it where only your page or app can read it, never in an address. A buyer holds 20 tokens at a store at most: a 21st ends their oldest.
     *
     * A wrong code is `code_wrong`, and a code past its 10 minutes or its five tries is `code_expired`. After 20 wrong codes in a day for one address, none is checked for it until the day is over (`code_paused`).
     *
     * It is counted for the address that asks: 30 in fifteen minutes.
     *
     * Fields:
     *
     * - `email` (required): The address the code was sent to.
     * - `code` (required): The six digits from the email.
     *
     * @param array{
     *     email: string,
     *     code: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     token: string,
     *     tokenType: string,
     *     expiresAt: string,
     *     email: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customer-api/sign-in-with-the-code
     */
    public function verify(array $params, array $options = []): mixed
    {
        return $this->call('customer.verify', [], $params, $options);
    }

    /**
     * **Get the signed-in buyer**
     *
     * Everything the customer panel's first page shows: the buyer's email, what they have spent, their store balance, their 200 newest orders, and the downloads, files and setup instructions their paid orders hand over.
     *
     * `affiliate` is null unless the store has an affiliate programme the buyer is in or may join, and `subscriptions` says whether they have ever had one. Keys are not listed here: Get an order has them.
     *
     * Needs the buyer's token: `Authorization: Bearer shoply_ct_...`, from Sign in with the code.
     *
     * It is counted for the buyer's token: 300 reads in ten minutes.
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     email: string,
     *     customerSince: string,
     *     balance: mixed,
     *     affiliate: array{
     *         member: bool,
     *         canJoin: bool
     *     },
     *     totals: array{
     *         spent: list<array{
     *             currencyCode: string,
     *             amount: int|float
     *         }>,
     *         orders: int|float,
     *         keys: int|float
     *     },
     *     orders: list<array{
     *         id: string,
     *         status: string,
     *         dateCreated: string,
     *         currencyCode: string,
     *         total: int|float,
     *         productName: string,
     *         variantName: string,
     *         quantity: int|float,
     *         moreItems: int|float,
     *         imageUrl: mixed
     *     }>,
     *     subscriptions: bool,
     *     downloads: array{
     *         buttons: array<mixed>,
     *         guideUrl: string,
     *         files: array<mixed>,
     *         instructions: array<mixed>,
     *         general: string
     *     },
     *     supportUrl: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customer-api/get-the-signed-in-buyer
     */
    public function show(array $options = []): mixed
    {
        return $this->call('customer.show', [], [], $options);
    }

    /**
     * **Sign out**
     *
     * Ends the token the request is made with. Their other tokens, and the customer panel, stay signed in.
     *
     * Needs the buyer's token: `Authorization: Bearer shoply_ct_...`, from Sign in with the code.
     *
     * It is counted for the buyer's token: 30 changes in ten minutes.
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     signedOut: bool,
     *     sessions: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customer-api/sign-out
     */
    public function logout(array $options = []): mixed
    {
        return $this->call('customer.logout', [], [], $options);
    }

    /**
     * **Sign out everywhere**
     *
     * Ends every token the buyer holds at this store, this one too, and signs them out of its customer panel. `sessions` says how many ended.
     *
     * Needs the buyer's token: `Authorization: Bearer shoply_ct_...`, from Sign in with the code.
     *
     * It is counted for the buyer's token: 30 changes in ten minutes.
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     signedOut: bool,
     *     sessions: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/customer-api/sign-out-everywhere
     */
    public function logoutEverywhere(array $options = []): mixed
    {
        return $this->call('customer.logoutEverywhere', [], [], $options);
    }
}
