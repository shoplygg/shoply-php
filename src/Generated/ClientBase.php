<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated;

/** The routes, as resources and methods: what `Shoply\Client` is made of. */
abstract class ClientBase implements Caller
{
    public readonly Resources\Key $key;
    public readonly Resources\Store $store;
    public readonly Resources\Domain $domain;
    public readonly Resources\PaymentMethods $paymentMethods;
    public readonly Resources\Analytics $analytics;
    public readonly Resources\Storefronts $storefronts;
    public readonly Resources\Routing $routing;
    public readonly Resources\CustomMethods $customMethods;
    public readonly Resources\Products $products;
    public readonly Resources\ProductImages $productImages;
    public readonly Resources\Stock $stock;
    public readonly Resources\Categories $categories;
    public readonly Resources\Upsells $upsells;
    public readonly Resources\Subscriptions $subscriptions;
    public readonly Resources\Orders $orders;
    public readonly Resources\Invoices $invoices;
    public readonly Resources\Reviews $reviews;
    public readonly Resources\Coupons $coupons;
    public readonly Resources\CouponCategories $couponCategories;
    public readonly Resources\CouponPopup $couponPopup;
    public readonly Resources\Sales $sales;
    public readonly Resources\Blog $blog;
    public readonly Resources\BlogCategories $blogCategories;
    public readonly Resources\BlogPosts $blogPosts;
    public readonly Resources\Seo $seo;
    public readonly Resources\Redirects $redirects;
    public readonly Resources\BrokenLinks $brokenLinks;
    public readonly Resources\Sitemap $sitemap;
    public readonly Resources\CartRecovery $cartRecovery;
    public readonly Resources\WinBack $winBack;
    public readonly Resources\Subscribers $subscribers;
    public readonly Resources\Customers $customers;
    public readonly Resources\CustomerTags $customerTags;
    public readonly Resources\Affiliates $affiliates;
    public readonly Resources\AffiliateProgramme $affiliateProgramme;
    public readonly Resources\Blacklist $blacklist;
    public readonly Resources\FraudEvents $fraudEvents;
    public readonly Resources\FraudSettings $fraudSettings;
    public readonly Resources\Disputes $disputes;
    public readonly Resources\Finance $finance;
    public readonly Resources\Tax $tax;
    public readonly Resources\Expenses $expenses;
    public readonly Resources\ExpenseCategories $expenseCategories;
    public readonly Resources\RecurringExpenses $recurringExpenses;
    public readonly Resources\ExpenseRules $expenseRules;
    public readonly Resources\Requests $requests;
    public readonly Resources\Webhooks $webhooks;
    public readonly Resources\WebhookDeliveries $webhookDeliveries;

    public function __construct()
    {
        $this->key = new Resources\Key($this);
        $this->store = new Resources\Store($this);
        $this->domain = new Resources\Domain($this);
        $this->paymentMethods = new Resources\PaymentMethods($this);
        $this->analytics = new Resources\Analytics($this);
        $this->storefronts = new Resources\Storefronts($this);
        $this->routing = new Resources\Routing($this);
        $this->customMethods = new Resources\CustomMethods($this);
        $this->products = new Resources\Products($this);
        $this->productImages = new Resources\ProductImages($this);
        $this->stock = new Resources\Stock($this);
        $this->categories = new Resources\Categories($this);
        $this->upsells = new Resources\Upsells($this);
        $this->subscriptions = new Resources\Subscriptions($this);
        $this->orders = new Resources\Orders($this);
        $this->invoices = new Resources\Invoices($this);
        $this->reviews = new Resources\Reviews($this);
        $this->coupons = new Resources\Coupons($this);
        $this->couponCategories = new Resources\CouponCategories($this);
        $this->couponPopup = new Resources\CouponPopup($this);
        $this->sales = new Resources\Sales($this);
        $this->blog = new Resources\Blog($this);
        $this->blogCategories = new Resources\BlogCategories($this);
        $this->blogPosts = new Resources\BlogPosts($this);
        $this->seo = new Resources\Seo($this);
        $this->redirects = new Resources\Redirects($this);
        $this->brokenLinks = new Resources\BrokenLinks($this);
        $this->sitemap = new Resources\Sitemap($this);
        $this->cartRecovery = new Resources\CartRecovery($this);
        $this->winBack = new Resources\WinBack($this);
        $this->subscribers = new Resources\Subscribers($this);
        $this->customers = new Resources\Customers($this);
        $this->customerTags = new Resources\CustomerTags($this);
        $this->affiliates = new Resources\Affiliates($this);
        $this->affiliateProgramme = new Resources\AffiliateProgramme($this);
        $this->blacklist = new Resources\Blacklist($this);
        $this->fraudEvents = new Resources\FraudEvents($this);
        $this->fraudSettings = new Resources\FraudSettings($this);
        $this->disputes = new Resources\Disputes($this);
        $this->finance = new Resources\Finance($this);
        $this->tax = new Resources\Tax($this);
        $this->expenses = new Resources\Expenses($this);
        $this->expenseCategories = new Resources\ExpenseCategories($this);
        $this->recurringExpenses = new Resources\RecurringExpenses($this);
        $this->expenseRules = new Resources\ExpenseRules($this);
        $this->requests = new Resources\Requests($this);
        $this->webhooks = new Resources\Webhooks($this);
        $this->webhookDeliveries = new Resources\WebhookDeliveries($this);
    }
}
