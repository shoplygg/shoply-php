<?php

declare(strict_types=1);

namespace Shoply;

/** A route's answer that is a file, a CSV or a PDF, as it came. */
final class File implements \Stringable
{
    /**
     * @param array<string, string> $headers by lowercase name
     */
    public function __construct(
        public readonly string $body,
        public readonly array $headers,
    ) {
    }

    /** Its type, "text/csv". */
    public function contentType(): ?string
    {
        return $this->headers['content-type'] ?? null;
    }

    /** Written to a file. */
    public function save(string $path): void
    {
        if (file_put_contents($path, $this->body) === false) {
            throw new \RuntimeException("Could not write {$path}.");
        }
    }

    public function __toString(): string
    {
        return $this->body;
    }
}
