<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated;

/** What a resource asks to make a call. */
interface Caller
{
    /**
     * @param array<int, mixed>    $path    the address's IDs, in order
     * @param array<string, mixed> $params  the fields
     * @param array<string, mixed> $options
     */
    public function call(string $id, array $path, array $params, array $options): mixed;
}
