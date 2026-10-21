<?php

declare(strict_types=1);

namespace Shoply;

use Shoply\Generated\Routes;

/**
 * What a call of a route is made of: its address, where its fields go, and the options it was
 * given. Shared by Client and Customer.
 *
 * @internal
 */
final class Calls
{
    /** Options a call takes after its fields. No route has a field by these names. */
    public const OPTIONS = ['idempotencyKey', 'maxRetries', 'timeout', 'headers'];

    /**
     * @param array<int, mixed>    $path   what the caller gave, held to being IDs here
     * @param array<string, mixed> $params
     * @return array{route: array<string, mixed>, values: array<string, string>, query: ?array<string, mixed>, body: mixed, form: ?array<string, mixed>}
     */
    public static function prepare(string $id, array $path, array $params): array
    {
        $route = Routes::ALL[$id] ?? throw new \InvalidArgumentException("There is no route {$id}.");

        $values = [];

        foreach ($route['params'] as $index => $name) {
            $value = $path[$index] ?? '';

            if (!is_string($value) || $value === '') {
                throw new \InvalidArgumentException("{$id} needs {$name}.");
            }

            $values[$name] = $value;
        }

        // An option among the fields would be sent as a field and do nothing.
        foreach (self::OPTIONS as $option) {
            if (array_key_exists($option, $params)) {
                $args   = array_map(static fn (string $name): string => '$' . $name, $route['params']);
                $args[] = '$params';
                $args[] = "['{$option}' => ...]";

                throw new \InvalidArgumentException("{$option} is an option: pass it after the fields, as {$id}(" . implode(', ', $args) . ').');
            }
        }

        $query = null;
        $body  = null;
        $form  = null;

        if ($route['upload'] !== null) {
            $file = $params['file'] ?? null;

            if (is_string($file)) {
                if (!is_file($file)) {
                    throw new \InvalidArgumentException("There is no file at {$file}.");
                }

                $file = new \CURLFile($file, (string) ($params['contentType'] ?? (mime_content_type($file) ?: 'application/octet-stream')), (string) ($params['filename'] ?? basename($file)));
            } elseif ($file instanceof \CURLFile) {
                if (isset($params['filename'])) {
                    $file->setPostFilename((string) $params['filename']);
                }
            } else {
                throw new \InvalidArgumentException('An upload takes `file` as a path on disk or a CURLFile.');
            }

            $form = [(string) $route['upload'] => $file];

            // What the route takes beside the file (a dispute's file says its `kind`) is in the address.
            $query = array_intersect_key($params, array_flip($route['query']));
        } elseif ($route['body']) {
            $query = [];
            $body  = [];

            foreach ($params as $name => $value) {
                if (in_array($name, $route['query'], true)) {
                    $query[$name] = $value;
                } else {
                    $body[$name] = $value;
                }
            }

            // An empty body is an object, not a list.
            $body = $body === [] ? new \stdClass() : $body;
        } else {
            $query = $params;
        }

        return ['route' => $route, 'values' => $values, 'query' => $query, 'body' => $body, 'form' => $form];
    }

    /** @param array<string, string> $values */
    public static function fill(string $template, array $values): string
    {
        return (string) preg_replace_callback('/\{([A-Za-z]+)\}/', static fn (array $match): string => rawurlencode($values[$match[1]] ?? ''), $template);
    }
}
