<?php

declare(strict_types=1);

namespace loophp\collection\Contract\Operation;

use loophp\collection\Contract\Collection;

/**
 * @template TKey
 * @template T
 */
interface Mergeable
{
    /**
     * Merge one or more iterables onto a collection.
     *
     * @see https://loophp-collection.readthedocs.io/en/stable/pages/api.html#merge
     *
     * @param iterable<mixed> ...$sources
     *
     * @return Collection<TKey, T>
     */
    public function merge(iterable ...$sources): Collection;
}
