<?php

declare(strict_types=1);

namespace drupol\collection\Operation;

use drupol\collection\Collection;
use drupol\collection\Contract\Operation;

/**
 * Class Distinct.
 */
final class Distinct implements Operation
{
    /**
     * {@inheritdoc}
     */
    public function on(iterable $collection)
    {
        return static function () use ($collection) {
            $seen = new Collection([]);

            foreach ($collection as $key => $value) {
                if (true === $seen->contains($value)) {
                    continue;
                }

                $seen = $seen
                    ->append($value)
                    ->rebase();

                yield $key => $value;
            }
        };
    }
}