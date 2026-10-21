<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class PaymentMethods
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List payment methods**
     *
     * Every payment method Shoply supports, and for each whether this store has connected it and switched it on, in the order its checkout offers them. Never a method's credentials. `meta.balance` says whether buyers may pay with their store balance. A method's name here is the name the rest of the API uses for it. `meta.order` is every method the store has connected and every custom payment method it has (paid outside Shoply: "List custom payment methods"), by name or id, in the checkout's one order. Each method's `unpaidHours` is its own time for an unpaid order, or null for the store's, which is `meta.unpaid.hours`; `meta.routing.providers` is the card methods Payment Routing chooses between.
     *
     * Needs the `payments.read` permission (Read Payment Methods).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     provider: string,
     *     name: string,
     *     kind: string,
     *     blurb: string,
     *     tagline: string,
     *     accent: string,
     *     site: string,
     *     callbackUrl: string,
     *     returnOrigin: string,
     *     originHint: string,
     *     callbackHint: string,
     *     copies: array<mixed>,
     *     authorizeUrl: string,
     *     connected: bool,
     *     enabled: bool,
     *     usable: bool,
     *     ready: bool,
     *     testMode: bool,
     *     modes: array<mixed>,
     *     mode: string,
     *     label: string,
     *     buyerLabel: string,
     *     defaultLabel: string,
     *     fields: list<array{
     *         name: string,
     *         label: string,
     *         placeholder: string,
     *         required: bool,
     *         max: int|float,
     *         secret: bool,
     *         showCallback: bool,
     *         mode: string,
     *         isSet: bool,
     *         value: string
     *     }>,
     *     toggles: list<array{
     *         name: string,
     *         label: string,
     *         hint: string,
     *         group: string,
     *         needs: string,
     *         on: bool
     *     }>,
     *     unpaidHours: mixed,
     *     updatedAt: mixed
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/payment-methods/list-payment-methods
     */
    public function list(array $options = []): mixed
    {
        return $this->caller->call('paymentMethods.list', [], [], $options);
    }

    /**
     * **Switch a payment method on or off**
     *
     * Takes a connected method off the checkout, or puts it back. Off keeps its credentials. On is refused for a method that is missing something it needs, which is put right in the dashboard. Answers the list again.
     *
     * Needs the `payments.write` permission (Change Payment Methods).
     *
     * Fields:
     *
     * - `enabled` (required): Whether the checkout offers it.
     *
     * @param string $provider The payment method, by its name in "List payment methods".
     * @param array{
     *     enabled: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/payment-methods/switch-a-payment-method-on-or-off
     */
    public function setEnabled(string $provider, array $params, array $options = []): mixed
    {
        return $this->caller->call('paymentMethods.setEnabled', [$provider], $params, $options);
    }

    /**
     * **Sort payment methods**
     *
     * Sets the order the checkout offers payment methods in. The first is the one most buyers take. Name some of them and they are put in this order in the places they hold now, and the rest stay where they are: a custom payment method between two connected ones stays between them. A custom method is named by its id in `meta.order`. Answers the list again.
     *
     * Needs the `payments.write` permission (Change Payment Methods).
     *
     * Fields:
     *
     * - `providers` (required): The methods' names in their new order.
     *
     * @param array{
     *     providers: list<string>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/payment-methods/sort-payment-methods
     */
    public function sort(array $params, array $options = []): mixed
    {
        return $this->caller->call('paymentMethods.sort', [], $params, $options);
    }

    /**
     * **Switch paying with balance on or off**
     *
     * Whether the checkout offers buyers their balance at the store. Answers the list again.
     *
     * Needs the `payments.write` permission (Change Payment Methods).
     *
     * Fields:
     *
     * - `enabled` (required): Whether buyers may pay with their balance.
     *
     * @param array{
     *     enabled: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     provider: string,
     *     name: string,
     *     kind: string,
     *     blurb: string,
     *     tagline: string,
     *     accent: string,
     *     site: string,
     *     callbackUrl: string,
     *     returnOrigin: string,
     *     originHint: string,
     *     callbackHint: string,
     *     copies: array<mixed>,
     *     authorizeUrl: string,
     *     connected: bool,
     *     enabled: bool,
     *     usable: bool,
     *     ready: bool,
     *     testMode: bool,
     *     modes: array<mixed>,
     *     mode: string,
     *     label: string,
     *     buyerLabel: string,
     *     defaultLabel: string,
     *     fields: list<array{
     *         name: string,
     *         label: string,
     *         placeholder: string,
     *         required: bool,
     *         max: int|float,
     *         secret: bool,
     *         showCallback: bool,
     *         mode: string,
     *         isSet: bool,
     *         value: string
     *     }>,
     *     toggles: list<array{
     *         name: string,
     *         label: string,
     *         hint: string,
     *         group: string,
     *         needs: string,
     *         on: bool
     *     }>,
     *     unpaidHours: mixed,
     *     updatedAt: mixed
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/payment-methods/switch-paying-with-balance-on-or-off
     */
    public function setBalance(array $params, array $options = []): mixed
    {
        return $this->caller->call('paymentMethods.setBalance', [], $params, $options);
    }

    /**
     * **Set how long an unpaid order is kept**
     *
     * How long the store keeps an order nobody pays before it is cancelled, from 1 hour to 14 days. A method with a time of its own keeps its own. An order is never cancelled within an hour of a payment being opened on it. Answers the list again, with the store's time in `meta.unpaid`.
     *
     * Needs the `payments.write` permission (Change Payment Methods).
     *
     * Fields:
     *
     * - `hours` (required): Hours, from 1 to 336.
     *
     * @param array{
     *     hours: int
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     provider: string,
     *     name: string,
     *     kind: string,
     *     blurb: string,
     *     tagline: string,
     *     accent: string,
     *     site: string,
     *     callbackUrl: string,
     *     returnOrigin: string,
     *     originHint: string,
     *     callbackHint: string,
     *     copies: array<mixed>,
     *     authorizeUrl: string,
     *     connected: bool,
     *     enabled: bool,
     *     usable: bool,
     *     ready: bool,
     *     testMode: bool,
     *     modes: array<mixed>,
     *     mode: string,
     *     label: string,
     *     buyerLabel: string,
     *     defaultLabel: string,
     *     fields: list<array{
     *         name: string,
     *         label: string,
     *         placeholder: string,
     *         required: bool,
     *         max: int|float,
     *         secret: bool,
     *         showCallback: bool,
     *         mode: string,
     *         isSet: bool,
     *         value: string
     *     }>,
     *     toggles: list<array{
     *         name: string,
     *         label: string,
     *         hint: string,
     *         group: string,
     *         needs: string,
     *         on: bool
     *     }>,
     *     unpaidHours: mixed,
     *     updatedAt: string
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/payment-methods/set-how-long-an-unpaid-order-is-kept
     */
    public function setUnpaidHours(array $params, array $options = []): mixed
    {
        return $this->caller->call('paymentMethods.setUnpaidHours', [], $params, $options);
    }

    /**
     * **Set a payment method's own time for an unpaid order**
     *
     * How long an order is kept unpaid once a payment has been opened on it with this method, from 1 hour to 14 days. Null gives it back the store's time. Answers the list again, each method with its `unpaidHours`.
     *
     * Needs the `payments.write` permission (Change Payment Methods).
     *
     * Fields:
     *
     * - `hours` (required): Hours, from 1 to 336, or null for the store's.
     *
     * @param string $provider The payment method, by its name in "List payment methods".
     * @param array{
     *     hours: int
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     provider: string,
     *     name: string,
     *     kind: string,
     *     blurb: string,
     *     tagline: string,
     *     accent: string,
     *     site: string,
     *     callbackUrl: string,
     *     returnOrigin: string,
     *     originHint: string,
     *     callbackHint: string,
     *     copies: array<mixed>,
     *     authorizeUrl: string,
     *     connected: bool,
     *     enabled: bool,
     *     usable: bool,
     *     ready: bool,
     *     testMode: bool,
     *     modes: array<mixed>,
     *     mode: string,
     *     label: string,
     *     buyerLabel: string,
     *     defaultLabel: string,
     *     fields: list<array{
     *         name: string,
     *         label: string,
     *         placeholder: string,
     *         required: bool,
     *         max: int|float,
     *         secret: bool,
     *         showCallback: bool,
     *         mode: string,
     *         isSet: bool,
     *         value: string
     *     }>,
     *     toggles: list<array{
     *         name: string,
     *         label: string,
     *         hint: string,
     *         group: string,
     *         needs: string,
     *         on: bool
     *     }>,
     *     unpaidHours: int|float,
     *     updatedAt: string
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/payment-methods/set-a-payment-methods-own-time-for-an-unpaid-order
     */
    public function setMethodUnpaidHours(string $provider, array $params, array $options = []): mixed
    {
        return $this->caller->call('paymentMethods.setMethodUnpaidHours', [$provider], $params, $options);
    }
}
