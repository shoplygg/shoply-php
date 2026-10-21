<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Store
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **Get the store**
     *
     * The store's details and settings: its name and address, currency, branding, links, policies, what its storefront shows, and its business details.
     *
     * Needs the `store.read` permission (Read Store).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     name: string,
     *     slug: string,
     *     urlChangeableAt: mixed,
     *     supportUrl: string,
     *     guideUrl: string,
     *     panelUrl: string,
     *     socialLinks: array{
     *         discord: string,
     *         youtube: string,
     *         tiktok: string,
     *         x: string,
     *         instagram: string,
     *         telegram: string
     *     },
     *     customLinks: array<mixed>,
     *     description: string,
     *     currencyCode: string,
     *     adaptivePricing: bool,
     *     currencies: list<array{
     *         code: string,
     *         name: string
     *     }>,
     *     ratesFetchedAt: string,
     *     locale: string,
     *     logoUrl: mixed,
     *     faviconUrl: mixed,
     *     storefrontPassword: string,
     *     storefrontPasswordUnreadable: bool,
     *     accentColor: string,
     *     theme: string,
     *     publishStock: bool,
     *     lowStockThreshold: int|float,
     *     dashboardCards: list<string>,
     *     termsOfService: string,
     *     refundPolicy: string,
     *     autoReviews: bool,
     *     publicStats: bool,
     *     saleNotifications: bool,
     *     publicOnline: bool,
     *     active: bool,
     *     blocked: mixed,
     *     businessType: string,
     *     businessName: string,
     *     businessTaxId: string,
     *     businessVatNumber: string,
     *     businessLine1: string,
     *     businessLine2: string,
     *     businessCity: string,
     *     businessRegion: string,
     *     businessPostalCode: string,
     *     businessCountry: string,
     *     invoiceFooter: string,
     *     originCountry: string,
     *     hasDynamicSecret: bool,
     *     dynamicSecretEnd: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/store/get-the-store
     */
    public function show(array $options = []): mixed
    {
        return $this->caller->call('store.show', [], [], $options);
    }

    /**
     * **Update the store**
     *
     * Saves the store's settings. Read the store first and send it back changed: `name` is needed, and `description`, `logoUrl`, `supportUrl`, `guideUrl` and `panelUrl` are cleared when left out. Every other field stays as it is when left out.
     *
     * The store's address is changed with "Change the store's address", and its logo and icon are uploaded with their own routes.
     *
     * Needs the `store.write` permission (Change Store).
     *
     * Fields:
     *
     * - `name` (required): The store's name.
     * - `description`: What the store says about itself.
     * - `currencyCode`: The currency its prices are in, as a three-letter code.
     * - `adaptivePricing`: Whether buyers are shown and charged prices in their own currency.
     * - `accentColor`: The store's colour, as `#rrggbb`.
     * - `locale`: The store's language and region, like `en-GB` or `de-DE`.
     * - `lowStockThreshold`: How few license keys a variant has left when the store is alerted.
     * - `supportUrl`: Where buyers get help.
     * - `guideUrl`: Where buyers find instructions.
     * - `panelUrl`: A panel of the store's own that buyers sign in to.
     * - `socialLinks`: The store's social networks: a network's name and its link. A blank link clears that network.
     * - `customLinks`: Links of the store's own, shown with its socials.
     * - `termsOfService`: The store's terms, as text.
     * - `refundPolicy`: The store's refund policy, as text.
     * - `logoUrl`: The store's logo, as "Get the store" answers it. Empty removes it.
     * - `faviconUrl`: The icon in the browser tab on the store's site. Empty removes it.
     * - `storefrontPassword`: A password visitors have to enter to see the storefront. Empty opens it to everybody.
     * - `publishStock`: Whether the storefront shows how many of a variant are left.
     * - `autoReviews`: Whether an order nobody reviewed is given five stars after seven days.
     * - `publicStats`: Whether the storefront shows items sold and customers.
     * - `saleNotifications`: Whether the storefront shows a note when somebody buys.
     * - `publicOnline`: Whether the storefront shows how many visitors are on it.
     * - `active`: Whether the store is open. Switched off, nothing can be bought.
     * - `businessType`: What kind of business it is.
     * - `businessName`: The business's name, printed on invoices. With `businessCountry`, it opens Finance.
     * - `businessTaxId`: Its tax number.
     * - `businessVatNumber`: Its VAT number.
     * - `businessLine1`: The first line of its address.
     * - `businessLine2`: The second.
     * - `businessCity`: Its city.
     * - `businessRegion`: Its state or region.
     * - `businessPostalCode`: Its postal code.
     * - `businessCountry`: Its country, as a two-letter code.
     * - `invoiceFooter`: A line printed at the foot of every invoice.
     * - `expectedUpdatedAt`: The `updatedAt` you last read. Sent, the change is refused with `stale_write` if the record has changed since. Left out, it is saved whatever happened in between.
     *
     * @param array{
     *     name: string,
     *     description?: string,
     *     currencyCode?: string,
     *     adaptivePricing?: bool,
     *     accentColor?: string,
     *     locale?: string,
     *     lowStockThreshold?: int,
     *     supportUrl?: string,
     *     guideUrl?: string,
     *     panelUrl?: string,
     *     socialLinks?: array<string, mixed>,
     *     customLinks?: list<array{
     *         label: string,
     *         url: string,
     *         icon?: string
     *     }>,
     *     termsOfService?: string,
     *     refundPolicy?: string,
     *     logoUrl?: string,
     *     faviconUrl?: string,
     *     storefrontPassword?: string,
     *     publishStock?: bool,
     *     autoReviews?: bool,
     *     publicStats?: bool,
     *     saleNotifications?: bool,
     *     publicOnline?: bool,
     *     active?: bool,
     *     businessType?: 'sole_proprietorship'|'partnership'|'llc'|'corporation'|'nonprofit'|'other',
     *     businessName?: string,
     *     businessTaxId?: string,
     *     businessVatNumber?: string,
     *     businessLine1?: string,
     *     businessLine2?: string,
     *     businessCity?: string,
     *     businessRegion?: string,
     *     businessPostalCode?: string,
     *     businessCountry?: string,
     *     invoiceFooter?: string,
     *     expectedUpdatedAt?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     name: string,
     *     slug: string,
     *     urlChangeableAt: mixed,
     *     supportUrl: string,
     *     guideUrl: string,
     *     panelUrl: string,
     *     socialLinks: array{
     *         discord: string,
     *         youtube: string,
     *         tiktok: string,
     *         x: string,
     *         instagram: string,
     *         telegram: string
     *     },
     *     customLinks: array<mixed>,
     *     description: string,
     *     currencyCode: string,
     *     adaptivePricing: bool,
     *     currencies: list<array{
     *         code: string,
     *         name: string
     *     }>,
     *     ratesFetchedAt: string,
     *     locale: string,
     *     logoUrl: mixed,
     *     faviconUrl: mixed,
     *     storefrontPassword: string,
     *     storefrontPasswordUnreadable: bool,
     *     accentColor: string,
     *     theme: string,
     *     publishStock: bool,
     *     lowStockThreshold: int|float,
     *     dashboardCards: list<string>,
     *     termsOfService: string,
     *     refundPolicy: string,
     *     autoReviews: bool,
     *     publicStats: bool,
     *     saleNotifications: bool,
     *     publicOnline: bool,
     *     active: bool,
     *     blocked: mixed,
     *     businessType: string,
     *     businessName: string,
     *     businessTaxId: string,
     *     businessVatNumber: string,
     *     businessLine1: string,
     *     businessLine2: string,
     *     businessCity: string,
     *     businessRegion: string,
     *     businessPostalCode: string,
     *     businessCountry: string,
     *     invoiceFooter: string,
     *     originCountry: string,
     *     hasDynamicSecret: bool,
     *     dynamicSecretEnd: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/store/update-the-store
     */
    public function update(array $params, array $options = []): mixed
    {
        return $this->caller->call('store.update', [], $params, $options);
    }

    /**
     * **Change the store's address**
     *
     * Moves the store to a new name under myshoply.gg. The old address leads to the new one. It can be changed once a week, and a name that is taken or reserved is refused.
     *
     * Needs the `store.write` permission (Change Store).
     *
     * Fields:
     *
     * - `slug` (required): The new name: the part before `.myshoply.gg`.
     *
     * @param array{
     *     slug: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/store/change-the-stores-address
     */
    public function setAddress(array $params, array $options = []): mixed
    {
        return $this->caller->call('store.setAddress', [], $params, $options);
    }

    /**
     * **Upload the store's logo**
     *
     * Gives the store its logo, replacing any it had. Sent as `multipart/form-data` in a field called `image`.
     *
     * Needs the `store.write` permission (Change Store).
     *
     * @param array{
     *     file: string|\CURLFile,
     *     filename?: string,
     *     contentType?: string
     * } $params The file: a path on disk, or a CURLFile.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/store/upload-the-stores-logo
     */
    public function uploadLogo(array $params, array $options = []): mixed
    {
        return $this->caller->call('store.uploadLogo', [], $params, $options);
    }

    /**
     * **Upload the store's icon**
     *
     * Gives the store the icon its site shows in a browser tab, replacing any it had. Sent as `multipart/form-data` in a field called `image`.
     *
     * Needs the `store.write` permission (Change Store).
     *
     * @param array{
     *     file: string|\CURLFile,
     *     filename?: string,
     *     contentType?: string
     * } $params The file: a path on disk, or a CURLFile.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/store/upload-the-stores-icon
     */
    public function uploadFavicon(array $params, array $options = []): mixed
    {
        return $this->caller->call('store.uploadFavicon', [], $params, $options);
    }

    /**
     * **Get email and alert settings**
     *
     * What the store's emails say, which alerts it is sent, the coupon for a first order, and whether an order with no review is given one (`autoReviews`). Its Discord webhook is answered only as saved or not. These settings are changed in the dashboard.
     *
     * Needs the `store.read` permission (Read Store).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     fromName: string,
     *     replyTo: string,
     *     defaultInstructions: string,
     *     buttons: array<mixed>,
     *     buttonDefaultLabel: string,
     *     maxButtons: int|float,
     *     panelButtonUrl: string,
     *     autoReviews: bool,
     *     firstOrderCouponEnabled: bool,
     *     firstOrderCouponPercent: int|float,
     *     firstOrderCouponDays: int|float,
     *     firstOrderCouponDelivery: string,
     *     firstOrderCouponDelayMinutes: int|float,
     *     firstOrderCouponPrefix: string,
     *     maxFirstOrderPercent: int|float,
     *     maxFirstOrderDays: int|float,
     *     notifyEnabled: bool,
     *     notifyAddress: string,
     *     emailStockEnabled: bool,
     *     emailStockThreshold: int|float,
     *     emailPayoutsEnabled: bool,
     *     emailCustomPaidEnabled: bool,
     *     emailDisputeOpenedEnabled: bool,
     *     emailDisputeClosedEnabled: bool,
     *     testEmailEvery: array{
     *         limit: int|float,
     *         window: int|float
     *     },
     *     discordWebhookSet: bool,
     *     discordWebhookMasked: string,
     *     discordOrdersEnabled: bool,
     *     discordStockEnabled: bool,
     *     discordErrorsEnabled: bool,
     *     discordReviewsEnabled: bool,
     *     discordPayoutsEnabled: bool,
     *     discordCustomPaidEnabled: bool,
     *     discordDisputesEnabled: bool,
     *     discordStockThreshold: int|float,
     *     discordFailure: mixed,
     *     storeName: string,
     *     emailAccent: string,
     *     updatedAt: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/store/get-email-and-alert-settings
     */
    public function emailSettings(array $options = []): mixed
    {
        return $this->caller->call('store.emailSettings', [], [], $options);
    }
}
