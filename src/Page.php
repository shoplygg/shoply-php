<?php

declare(strict_types=1);

namespace Shoply;

/**
 * One page of a list: `data` its rows, `page` which page, `pages` how many there are, `total`
 * the rows in all, `meta` whatever else the list answers beside its rows. A `foreach` over it
 * walks every row from this page on, asking for the next page as it goes.
 *
 * @template T
 * @implements \IteratorAggregate<int, T>
 */
final class Page implements \IteratorAggregate
{
    /**
     * @param list<T>                      $data
     * @param array<string, mixed>|null    $meta
     * @param \Closure(int): Page<T>       $next
     */
    public function __construct(
        public readonly array $data,
        public readonly int $page,
        public readonly ?int $pages,
        public readonly ?int $total,
        public readonly ?array $meta,
        private readonly \Closure $next,
    ) {
    }

    public function hasNextPage(): bool
    {
        return $this->pages !== null && $this->page < $this->pages;
    }

    /**
     * The page after this one, or null when this is the last.
     *
     * @return Page<T>|null
     */
    public function nextPage(): ?Page
    {
        return $this->hasNextPage() ? ($this->next)($this->page + 1) : null;
    }

    /** @return \Generator<int, T> */
    public function getIterator(): \Generator
    {
        for ($page = $this; $page !== null; $page = $page->nextPage()) {
            yield from $page->data;
        }
    }
}
