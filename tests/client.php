<?php

/**
 * The PHP SDK against a stand-in for the API (tests/standin.php, on PHP's own server on a free
 * port): what it sends, what it does with each kind of answer, and webhooks. Nothing here
 * reaches Shoply.
 *
 *     php packages/php/tests/client.php
 */

declare(strict_types=1);

require __DIR__ . '/autoload.php';

use Shoply\Client;
use Shoply\Customer;
use Shoply\File;
use Shoply\Generated\Routes;
use Shoply\OAuth;
use Shoply\Page;
use Shoply\ShoplyException;
use Shoply\Webhooks;

const KEY   = 'shoply_sk_test0000000000000000000000000000000000000000';
const STORE = '11111111-2222-3333-4444-555555555555';

$pass = 0;
$fail = 0;

$check = static function (string $what, bool $ok, mixed $got = null) use (&$pass, &$fail): void {
    if ($ok) {
        $pass++;
        echo "  ok   {$what}\n";

        return;
    }

    $fail++;
    echo "  FAIL {$what}" . ($got !== null ? ' (got ' . json_encode($got, JSON_UNESCAPED_SLASHES) . ')' : '') . "\n";
};

/** What a call threw, or null. */
$threw = static function (callable $call): ?\Throwable {
    try {
        $call();
    } catch (\Throwable $e) {
        return $e;
    }

    return null;
};

$dir   = sys_get_temp_dir() . '/shoply-php-sdk-' . bin2hex(random_bytes(4));
$log   = $dir . '/log';
$state = $dir . '/state';
mkdir($dir);

$socket = stream_socket_server('tcp://127.0.0.1:0');
$port   = (int) substr((string) stream_socket_get_name($socket, false), strrpos((string) stream_socket_get_name($socket, false), ':') + 1);
fclose($socket);

$server = proc_open(
    [PHP_BINARY, '-S', "127.0.0.1:{$port}", __DIR__ . '/standin.php'],
    [1 => ['file', '/dev/null', 'w'], 2 => ['file', '/dev/null', 'w']],
    $pipes,
    __DIR__,
    ['STANDIN_LOG' => $log, 'STANDIN_STATE' => $state] + getenv(),
);

for ($i = 0; $i < 50 && @fsockopen('127.0.0.1', $port) === false; $i++) {
    usleep(100000);
}

$base = "http://127.0.0.1:{$port}/v1";

/** The requests the stand-in was sent since the last fresh(). */
$seen = static fn (): array => array_map(static fn (string $line): array => json_decode($line, true), array_filter(explode("\n", (string) @file_get_contents($log))));

$fresh = static function () use ($log, $state): void {
    @unlink($log);
    @unlink($state);
};

$plan = static fn (string $plan, array $more = []): array => ['headers' => ['X-Plan' => $plan]] + $more;

try {
    echo "The package\n";

    $composer = json_decode((string) file_get_contents(dirname(__DIR__) . '/composer.json'), true);
    $check('it is shoplygg/shoply-php, for PHP 8.1 or later', ($composer['name'] ?? '') === 'shoplygg/shoply-php' && ($composer['require']['php'] ?? '') === '>=8.1');

    $shoply = new Client(['apiKey' => KEY, 'storeId' => STORE]);
    $buyer  = new Customer(['storeId' => STORE]);
    $none   = [];

    foreach (Routes::ALL as $id => $route) {
        $owner = $route['customer'] ? $buyer : $shoply;
        $parts = explode('.', $route['customer'] ? (string) preg_replace('/^customer\./', '', $id) : $id);
        $name  = array_pop($parts);

        foreach ($parts as $part) {
            $owner = $owner->{$part} ?? null;
        }

        if (!is_object($owner) || !method_exists($owner, $name)) {
            $none[] = $id;
        }
    }

    $check('every route of the reference is a method (' . count(Routes::ALL) . ')', $none === [], $none);

    echo "A key, and the store\n";

    $saved = getenv('SHOPLY_API_KEY');
    putenv('SHOPLY_API_KEY');
    $e = $threw(static fn () => new Client());
    $check('no key is refused', $e instanceof ShoplyException && $e->errorCode === 'api_key_required');
    $e = $threw(static fn () => new Client(['apiKey' => 'shoply_ct_buyer']));
    $check('a buyer\'s token is not a key', $e instanceof ShoplyException && $e->errorCode === 'api_key_required');
    putenv('SHOPLY_API_KEY=' . KEY);
    $check('SHOPLY_API_KEY is read from the environment', $threw(static fn () => new Client()) === null);
    $saved === false ? putenv('SHOPLY_API_KEY') : putenv('SHOPLY_API_KEY=' . $saved);

    $fresh();
    $shoply = new Client(['apiKey' => KEY, 'baseUrl' => $base]);
    $shoply->orders->show('o1');
    $shoply->orders->show('o2');
    $requests = $seen();
    $check('the store is asked of the key once', count(array_filter($requests, static fn (array $r): bool => $r['path'] === '/v1/key')) === 1, array_column($requests, 'path'));
    $check('and the route is under it', ($requests[1]['path'] ?? '') === '/v1/stores/' . STORE . '/orders/o1');
    $check('signed with the key', ($requests[1]['headers']['authorization'] ?? '') === 'Bearer ' . KEY);
    $check('saying what it is', ($requests[1]['headers']['user-agent'] ?? '') === 'shoply-php/' . Client::VERSION . ' (php/' . PHP_VERSION . ')', $requests[1]['headers']['user-agent'] ?? null);
    $check('storeId() answers it', $shoply->storeId() === STORE);

    $fresh();
    $shoply = new Client(['apiKey' => KEY, 'storeId' => STORE, 'baseUrl' => $base]);
    $shoply->orders->show('a/b c');
    $requests = $seen();
    $check('a store given is not asked for', count($requests) === 1);
    $check('an address\'s parts are escaped', ($requests[0]['path'] ?? '') === '/v1/stores/' . STORE . '/orders/a%2Fb%20c', $requests[0]['path'] ?? null);
    $check('an empty ID is refused before anything is sent', $threw(static fn () => $shoply->orders->show('')) instanceof \InvalidArgumentException);

    echo "What goes where\n";

    $fresh();
    $shoply->customers->list(['search' => 'ana', 'perPage' => 5, 'nothing' => null]);
    $shoply->coupons->create(['code' => 'SAVE10', 'value' => 10, 'tz' => 'Europe/Riga']);
    $requests = $seen();
    $check('a read\'s fields go in the address', ($requests[0]['query'] ?? null) == ['page' => '1', 'search' => 'ana', 'perPage' => '5'], $requests[0]['query'] ?? null);
    $check('a change\'s in its body, as JSON', json_decode($requests[1]['body'] ?? '', true) == ['code' => 'SAVE10', 'value' => 10] && ($requests[1]['headers']['content-type'] ?? '') === 'application/json', $requests[1]['body'] ?? null);
    $check('and the address\'s own in the address', ($requests[1]['query'] ?? null) == ['tz' => 'Europe/Riga'], $requests[1]['query'] ?? null);

    $fresh();
    $shoply->orders->markPaid('o1');
    $requests = $seen();
    $check('a change with no fields sends an empty object', ($requests[0]['body'] ?? '') === '{}', $requests[0]['body'] ?? null);

    $e = $threw(static fn () => $shoply->orders->markPaid('o1', ['idempotencyKey' => 'k']));
    $check('an option among the fields is refused, saying where it goes', $e instanceof \InvalidArgumentException && str_contains($e->getMessage(), 'idempotencyKey is an option: pass it after the fields, as orders.markPaid($orderId, $params, [\'idempotencyKey\' => ...])'), $e?->getMessage());

    echo "The key on every try, and what is tried again\n";

    $fresh();
    $coupon   = $shoply->coupons->create(['code' => 'SAVE10', 'value' => 10], $plan('503x2'));
    $requests = $seen();
    $keys     = array_map(static fn (array $r): string => (string) ($r['headers']['idempotency-key'] ?? ''), $requests);
    $check('a change the server could not answer is tried again, and answers', $coupon === ['id' => 'c1'] && count($requests) === 3, count($requests));
    $check('with a key of its own, the same on every try', preg_match('/^[0-9a-f-]{36}$/', $keys[0]) === 1 && count(array_unique($keys)) === 1, $keys);

    $fresh();
    $shoply->coupons->create(['code' => 'SAVE20', 'value' => 20], ['idempotencyKey' => 'mine-1']);
    $shoply->orders->show('o1');
    $requests = $seen();
    $check('a key given is the one sent', ($requests[0]['headers']['idempotency-key'] ?? '') === 'mine-1');
    $check('a read carries none', !isset($requests[1]['headers']['idempotency-key']));

    $fresh();
    $order = $shoply->orders->show('o1', $plan('500x1'));
    $check('a read the server could not answer is tried again', ($order['id'] ?? '') === 'o1' && count($seen()) === 2);

    $fresh();
    $began = microtime(true);
    $shoply->orders->show('o1', $plan('429-1'));
    $check('told to slow down, it waits as long as it is told', microtime(true) - $began >= 0.9 && count($seen()) === 2, round(microtime(true) - $began, 2));

    $fresh();
    $e = $threw(static fn () => $shoply->orders->show('o1', $plan('429-120')));
    $check('told to wait more than a minute, it does not, and says so', $e instanceof ShoplyException && $e->status === 429 && $e->retryAfter === 120 && count($seen()) === 1);

    $fresh();
    $shoply->coupons->create(['code' => 'A1', 'value' => 1], $plan('409x1'));
    $check('the same request still running is waited for', count($seen()) === 2);

    $fresh();
    $e = $threw(static fn () => $shoply->coupons->create(['code' => 'A1', 'value' => 1], $plan('422')));
    $check('a refusal is not tried again', count($seen()) === 1);
    $check('and is a ShoplyException with its status, code, errors and request', $e instanceof ShoplyException
        && $e->status === 422 && $e->errorCode === 'validation_failed' && $e->getMessage() === 'Check the fields.'
        && $e->errors === ['code' => 'Taken.'] && str_starts_with((string) $e->requestId, 'req-'), $e instanceof ShoplyException ? [$e->status, $e->errorCode, $e->errors, $e->requestId] : $e?->getMessage());

    $fresh();
    $threw(static fn () => $shoply->orders->show('o1', $plan('503', ['maxRetries' => 0])));
    $check('maxRetries 0 tries once', count($seen()) === 1);

    echo "Nothing answering, and too slow an answer\n";

    $nowhere = new Client(['apiKey' => KEY, 'storeId' => STORE, 'baseUrl' => 'http://127.0.0.1:9/v1', 'maxRetries' => 1]);
    $e       = $threw(static fn () => $nowhere->orders->show('o1'));
    $check('nothing answering is connection_error', $e instanceof ShoplyException && $e->status === 0 && $e->errorCode === 'connection_error', $e?->getMessage());

    $e = $threw(static fn () => $shoply->orders->show('o1', $plan('slow', ['timeout' => 0.3, 'maxRetries' => 0])));
    $check('too slow is timeout', $e instanceof ShoplyException && $e->errorCode === 'timeout', $e?->getMessage());

    echo "Lists\n";

    $fresh();
    $first = $shoply->orders->list(['perPage' => 2], $plan('pages'));
    $check('a list is a Page', $first instanceof Page && array_column($first->data, 'id') === ['o1', 'o2'] && $first->page === 1 && $first->pages === 3 && $first->total === 5, $first instanceof Page ? [$first->page, $first->pages, $first->total] : null);
    $check('with what the list says beside its rows', $first->meta === ['statusCounts' => ['all' => 5]]);
    $second = $first->nextPage();
    $check('nextPage() is the next', $second instanceof Page && array_column($second->data, 'id') === ['o3', 'o4']);

    $all = [];

    foreach ($shoply->orders->list(['perPage' => 2], $plan('pages')) as $row) {
        $all[] = $row['id'];
    }

    $check('foreach walks every row of every page', $all === ['o1', 'o2', 'o3', 'o4', 'o5'], $all);

    $fromTwo = [];

    foreach ($shoply->orders->list(['perPage' => 2, 'page' => 2], $plan('pages')) as $row) {
        $fromTwo[] = $row['id'];
    }

    $check('from the page asked for', $fromTwo === ['o3', 'o4', 'o5'], $fromTwo);
    $last = $shoply->orders->list(['perPage' => 2, 'page' => 3], $plan('pages'));
    $check('the last has no next', !$last->hasNextPage() && $last->nextPage() === null);

    echo "Files and uploads\n";

    $file = $shoply->orders->export(['status' => 'completed'], $plan('csv'));
    $check('a file is a File, as it came', $file instanceof File && str_starts_with((string) $file->contentType(), 'text/csv'), $file instanceof File ? $file->contentType() : null);
    $check('its body', (string) $file === "Order ID,Email\no1,a@example.com\n");

    $picture = $dir . '/cover.png';
    file_put_contents($picture, 'PNGBYTES');
    $fresh();
    $shoply->productImages->upload('p1', ['file' => $picture]);
    $shoply->productImages->upload('p1', ['file' => new \CURLFile($picture, 'image/png'), 'filename' => 'named.png']);
    $requests = $seen();
    $field    = (string) Routes::ALL['productImages.upload']['upload'];
    $check('an upload from a path is sent as a form, under the field the route takes', ($requests[0]['files'][$field]['bytes'] ?? '') === 'PNGBYTES' && ($requests[0]['files'][$field]['name'] ?? '') === 'cover.png', $requests[0]['files'] ?? null);
    $check('a CURLFile too, named as asked', ($requests[1]['files'][$field]['name'] ?? '') === 'named.png' && ($requests[1]['files'][$field]['type'] ?? '') === 'image/png', $requests[1]['files'] ?? null);
    $check('a path that is no file is refused', $threw(static fn () => $shoply->productImages->upload('p1', ['file' => $dir . '/none.png'])) instanceof \InvalidArgumentException);

    $fresh();
    $shoply->disputes->addFile('d1', ['file' => $picture, 'kind' => 'communication']);
    $requests = $seen();
    $check('what the route takes beside the file goes in the address', ($requests[0]['query'] ?? null) === ['kind' => 'communication'] && isset($requests[0]['files']['file']), $requests[0]['query'] ?? null);

    echo "Any route by its address\n";

    $fresh();
    $answer   = $shoply->request('GET', '/stores/{storeId}/orders', ['query' => ['page' => 1]]);
    $shoply->request('post', '/stores/{storeId}/coupons', ['body' => ['code' => 'X1', 'value' => 1]]);
    $requests = $seen();
    $check('request() fills in the store and answers the whole envelope', ($requests[0]['path'] ?? '') === '/v1/stores/' . STORE . '/orders' && ($answer['success'] ?? null) === true && isset($answer['data']));
    $check('a change through it carries a key', ($requests[1]['method'] ?? '') === 'POST' && isset($requests[1]['headers']['idempotency-key']));

    echo "The Customer API\n";

    $check('a store ID is needed', $threw(static fn () => new Customer(['storeId' => ''])) instanceof ShoplyException);

    $fresh();
    $buyer = new Customer(['storeId' => STORE, 'baseUrl' => $base]);
    $e     = $threw(static fn () => $buyer->show());
    $check('nothing is asked before signing in', $e instanceof ShoplyException && $e->errorCode === 'customer_token_required' && $seen() === []);

    $buyer->login(['email' => 'a@example.com']);
    $requests = $seen();
    $check('login sends the address, with no token and no key', ($requests[0]['path'] ?? '') === '/v1/stores/' . STORE . '/customer/login'
        && !isset($requests[0]['headers']['authorization']) && !isset($requests[0]['headers']['idempotency-key'])
        && json_decode($requests[0]['body'], true) === ['email' => 'a@example.com']);

    $signed = $buyer->verify(['email' => 'a@example.com', 'code' => '123456']);
    $check('verify answers the token and keeps it', ($signed['token'] ?? '') === 'shoply_ct_abc' && $buyer->token === 'shoply_ct_abc');

    $me = $buyer->show();
    $check('and signs the next request with it', ($me['email'] ?? '') === 'a@example.com' && ($seen()[2]['headers']['authorization'] ?? '') === 'Bearer shoply_ct_abc', $seen()[2]['headers']['authorization'] ?? null);

    $fresh();
    $threw(static fn () => $buyer->affiliate->join());
    $check('a buyer\'s change with no key is not sent again', count($seen()) === 1);

    $buyer->logout();
    $check('signing out forgets the token', $buyer->token === null);

    $fresh();
    (new Customer(['storeId' => STORE, 'baseUrl' => $base, 'token' => 'shoply_ct_kept']))->show();
    $check('a kept token signs in again', ($seen()[0]['headers']['authorization'] ?? '') === 'Bearer shoply_ct_kept');

    echo "Webhooks\n";

    $secret  = 'whsec_test_secret';
    $body    = json_encode(['id' => 'e1', 'event' => 'order.paid', 'createdAt' => '2026-10-21T10:00:00Z', 'storeId' => STORE, 'data' => ['id' => 'o1']]);
    $headers = Webhooks::sign($body, $secret);
    $check('sign() is what Shoply sends: v1= and the HMAC-SHA256 of the timestamp, a dot and the body', $headers['X-Shoply-Signature'] === 'v1=' . hash_hmac('sha256', $headers['X-Shoply-Timestamp'] . '.' . $body, $secret));

    $event = Webhooks::verify($body, $headers, $secret);
    $check('a signed event checks out, and is answered', $event['event'] === 'order.paid' && $event['data']['id'] === 'o1');
    $check('with the headers named as $_SERVER names them', Webhooks::verify($body, ['HTTP_X_SHOPLY_TIMESTAMP' => $headers['X-Shoply-Timestamp'], 'HTTP_X_SHOPLY_SIGNATURE' => $headers['X-Shoply-Signature']], $secret)['id'] === 'e1');
    $check('or as lists, as a framework\'s request has them', Webhooks::verify($body, ['x-shoply-timestamp' => [$headers['X-Shoply-Timestamp']], 'x-shoply-signature' => [$headers['X-Shoply-Signature']]], $secret)['id'] === 'e1');

    $refused = static fn (string $code) => static fn (?\Throwable $e): bool => $e instanceof ShoplyException && $e->errorCode === $code;
    $check('a changed body is refused', $refused('invalid_signature')($threw(static fn () => Webhooks::verify(str_replace('o1', 'o2', $body), $headers, $secret))));
    $check('another secret is refused', $refused('invalid_signature')($threw(static fn () => Webhooks::verify($body, $headers, 'another'))));
    $check('no signature is refused', $refused('invalid_signature')($threw(static fn () => Webhooks::verify($body, [], $secret))));

    $old = Webhooks::sign($body, $secret, time() - 600);
    $check('one signed ten minutes ago is too old', $refused('too_old')($threw(static fn () => Webhooks::verify($body, $old, $secret))));
    $check('unless the tolerance says otherwise', Webhooks::verify($body, $old, $secret, 900)['id'] === 'e1');

    echo "OAuth\n";

    $check('an app\'s token is a key too', $threw(static fn () => new Client(['apiKey' => 'shoply_at_' . str_repeat('a', 48)])) === null);

    $url = OAuth::authorizeUrl(['clientId' => 'shoply_app_0123456789abcdef', 'redirectUri' => 'https://app.example/back', 'state' => 's1', 'codeChallenge' => str_repeat('c', 43)]);
    parse_str((string) parse_url($url, PHP_URL_QUERY), $asked);
    $check('the address to send a seller to is the dashboard\'s approval screen', str_starts_with($url, 'https://dashboard.shoply.gg/oauth/authorize/?'), $url);
    $check('with the app\'s request in it', $asked === ['response_type' => 'code', 'client_id' => 'shoply_app_0123456789abcdef', 'redirect_uri' => 'https://app.example/back', 'state' => 's1', 'code_challenge' => str_repeat('c', 43), 'code_challenge_method' => 'S256'], $asked);
    $check('no challenge, no method', !str_contains(OAuth::authorizeUrl(['clientId' => 'x', 'redirectUri' => 'https://a.example']), 'code_challenge'));

    $pair = OAuth::pkce();
    $check('a PKCE pair: the challenge is the base64url of the verifier\'s SHA-256', preg_match('/^[A-Za-z0-9_-]{43}$/', $pair['verifier']) === 1 && $pair['challenge'] === rtrim(strtr(base64_encode(hash('sha256', $pair['verifier'], true)), '+/', '-_'), '=') && $pair['method'] === 'S256');
    $check('a state is new each time', OAuth::state() !== OAuth::state());

    $fresh();
    $token = OAuth::exchange(['clientId' => 'shoply_app_0123456789abcdef', 'clientSecret' => 'shoply_cs_secret', 'code' => 'good', 'redirectUri' => 'https://app.example/back', 'baseUrl' => $base]);
    $sent  = $seen()[0] ?? [];
    parse_str((string) ($sent['body'] ?? ''), $form);
    $check('a code is swapped for the token', $token === ['accessToken' => 'shoply_at_' . str_repeat('b', 48), 'tokenType' => 'Bearer', 'scopes' => ['orders.read', 'products.read'], 'storeId' => STORE], $token);
    $check('as a form, with the secret by HTTP Basic', ($sent['path'] ?? '') === '/v1/oauth/token' && ($sent['headers']['authorization'] ?? '') === 'Basic ' . base64_encode('shoply_app_0123456789abcdef:shoply_cs_secret') && ($form['grant_type'] ?? '') === 'authorization_code' && !isset($form['client_id']), $sent);

    $fresh();
    OAuth::exchange(['clientId' => 'shoply_app_0123456789abcdef', 'code' => 'good', 'redirectUri' => 'http://127.0.0.1/cb', 'codeVerifier' => str_repeat('v', 43), 'baseUrl' => $base]);
    $sent = $seen()[0] ?? [];
    parse_str((string) ($sent['body'] ?? ''), $form);
    $check('a desktop app sends its client ID and the verifier, and no secret', !isset($sent['headers']['authorization']) && ($form['client_id'] ?? '') === 'shoply_app_0123456789abcdef' && ($form['code_verifier'] ?? '') === str_repeat('v', 43), $sent);

    $e = $threw(static fn () => OAuth::exchange(['clientId' => 'x', 'clientSecret' => 'y', 'code' => 'bad', 'redirectUri' => 'https://a.example', 'baseUrl' => $base]));
    $check('a refusal is a ShoplyException with OAuth\'s word', $e instanceof ShoplyException && $e->status === 400 && $e->errorCode === 'invalid_grant' && $e->getMessage() === 'The code is not right.');

    $fresh();
    OAuth::revoke(['clientId' => 'shoply_app_0123456789abcdef', 'clientSecret' => 'shoply_cs_secret', 'token' => 'shoply_at_x', 'baseUrl' => $base]);
    $sent = $seen()[0] ?? [];
    parse_str((string) ($sent['body'] ?? ''), $form);
    $check('a token is given up at /oauth/revoke', ($sent['path'] ?? '') === '/v1/oauth/revoke' && ($form['token'] ?? '') === 'shoply_at_x', $sent);
} finally {
    proc_terminate($server);
    proc_close($server);

    foreach (glob($dir . '/*') ?: [] as $file) {
        @unlink($file);
    }

    @rmdir($dir);
}

echo "\n{$pass} passed, {$fail} failed\n";
exit($fail === 0 ? 0 : 1);
