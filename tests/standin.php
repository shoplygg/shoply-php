<?php

/**
 * A stand-in for the API, for tests/client.php: run with PHP's own server. What it answers is
 * decided by the X-Plan header a test sends; every request is kept, one JSON line each, in the
 * file STANDIN_LOG names, and a plan's count of tries in STANDIN_STATE.
 */

declare(strict_types=1);

$path    = (string) parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$query   = [];
parse_str((string) parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $query);
$headers = array_change_key_case(getallheaders(), CASE_LOWER);
$raw     = (string) file_get_contents('php://input');
$plan    = $headers['x-plan'] ?? '';

file_put_contents((string) getenv('STANDIN_LOG'), json_encode([
    'method'  => $_SERVER['REQUEST_METHOD'],
    'path'    => $path,
    'query'   => $query,
    'body'    => $raw,
    'files'   => array_map(static fn (array $f): array => ['name' => $f['name'], 'type' => $f['type'], 'bytes' => (string) file_get_contents($f['tmp_name'])], $_FILES),
    'headers' => $headers,
]) . "\n", FILE_APPEND);

$state = json_decode((string) @file_get_contents((string) getenv('STANDIN_STATE')), true) ?: [];
$tries = ($state[$plan] ?? 0) + 1;
$state[$plan] = $tries;
file_put_contents((string) getenv('STANDIN_STATE'), json_encode($state));

$answer = static function (int $status, mixed $data, array $extra = [], array $headers = []): never {
    http_response_code($status);
    header('Content-Type: application/json');
    header('X-Request-Id: req-' . bin2hex(random_bytes(3)));

    foreach ($headers as $name => $value) {
        header("{$name}: {$value}");
    }

    echo json_encode(['success' => $status < 400, 'message' => $status < 400 ? null : ($extra['message'] ?? 'No.'), 'code' => $extra['code'] ?? null, 'data' => $data] + array_diff_key($extra, ['message' => 1, 'code' => 1]));
    exit;
};

if ($path === '/v1/key') {
    $answer(200, ['store' => ['id' => '11111111-2222-3333-4444-555555555555']]);
}

switch ($plan) {
    case '503x2':
        $tries <= 2 ? $answer(503, null, ['message' => 'Down.']) : $answer(200, ['id' => 'c1']);
    case '500x1':
        $tries <= 1 ? $answer(500, null) : $answer(200, ['id' => 'o1']);
    case '429-1':
        $tries <= 1 ? $answer(429, null, ['code' => 'rate_limited', 'message' => 'Slow down.'], ['Retry-After' => '1']) : $answer(200, []);
    case '429-120':
        $answer(429, null, ['code' => 'rate_limited', 'message' => 'Slow down.'], ['Retry-After' => '120']);
    case '409x1':
        $tries <= 1 ? $answer(409, null, ['code' => 'request_in_progress']) : $answer(200, ['id' => 'c1']);
    case '422':
        $answer(422, null, ['code' => 'validation_failed', 'message' => 'Check the fields.', 'errors' => ['code' => 'Taken.']]);
    case '503':
        $answer(503, null);
    case 'slow':
        usleep(1_500_000);
        $answer(200, []);
    case 'csv':
        header('Content-Type: text/csv');
        echo "Order ID,Email\no1,a@example.com\n";
        exit;
    case 'pages':
        $rows = [['id' => 'o1'], ['id' => 'o2'], ['id' => 'o3'], ['id' => 'o4'], ['id' => 'o5']];
        $page = (int) ($query['page'] ?? 1);
        $answer(200, array_slice($rows, ($page - 1) * 2, 2), ['pages' => 3, 'total' => 5, 'meta' => ['statusCounts' => ['all' => 5]]]);
}

if (str_ends_with($path, '/customer/login')) {
    $answer(200, ['sent' => true]);
}

if (str_ends_with($path, '/customer/verify')) {
    $answer(200, ['token' => 'shoply_ct_abc', 'tokenType' => 'Bearer', 'expiresAt' => '2026-11-20T00:00:00Z', 'email' => 'a@example.com']);
}

if (str_ends_with($path, '/customer/logout')) {
    $answer(200, null);
}

if (str_ends_with($path, '/customer/affiliate/join')) {
    $answer(500, null);
}

$answer(200, ['id' => 'o1', 'email' => 'a@example.com']);
