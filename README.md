# shoplygg/shoply-php

Shoply's API from your own server. Every route of the [API reference](https://docs.shoply.gg/api-reference/introduction) is a method, with array shapes your editor and PHPStan read, safe retries, lists a page at a time or all at once, and checking that a webhook came from Shoply.

```sh
composer require shoplygg/shoply-php
```

PHP 8.1 or later, with the curl extension. No other dependencies.

```php
$shoply = new Shoply\Client(['apiKey' => getenv('SHOPLY_API_KEY')]);

$order = $shoply->orders->show('ORDER_ID');

foreach ($shoply->customers->list(['search' => 'gmail.com']) as $customer) {
    echo $customer['emailAddress'], "\n";
}

$coupon = $shoply->coupons->create(['code' => 'SPRING10', 'value' => 10]);
```

Make the key under **Developers**, **API Keys** in the dashboard, with the permissions your code needs. Keep it on your server.

A route's method is its id: **Get an order** is `orders.show`, so `$shoply->orders->show($orderId)`. The address's IDs come first, in order, then the fields as one array, then options.

## Errors

A refusal is a `Shoply\ShoplyException`, with `status`, `errorCode` (`not_found`, `missing_scope`, `validation_failed`...), `errors` for each field that is wrong, and `requestId`.

```php
try {
    $shoply->coupons->create(['code' => 'SPRING10', 'value' => 10]);
} catch (Shoply\ShoplyException $e) {
    if ($e->errorCode === 'validation_failed') {
        print_r($e->errors);
    }
}
```

A change is sent with an `Idempotency-Key`, the same on every try, so a try whose answer was lost is never carried out twice. Pass `['idempotencyKey' => ...]` in the options, the last argument, to use your own.

## Webhooks

```php
$event = Shoply\Webhooks::verify(
    (string) file_get_contents('php://input'),
    getallheaders(),
    (string) getenv('SHOPLY_WEBHOOK_SECRET'),
);

if ($event['event'] === 'order.paid') {
    // $event['data'] is the order
}
```

## The Customer API

`Shoply\Customer` signs a buyer in with a code emailed to them, and reads their own orders, keys and subscriptions. It holds the buyer's token and no key.

```php
$buyer = new Shoply\Customer(['storeId' => 'YOUR_STORE_ID']);

$buyer->login(['email' => $email]);
$buyer->verify(['email' => $email, 'code' => $code]);
$me = $buyer->show();
```

The whole guide: https://docs.shoply.gg/api-reference/php
