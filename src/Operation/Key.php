<?php

declare(strict_types=1);

namespace loophp\collection\Operation;

use Closure;
use Generator;
use Iterator;

/**
 * @psalm-template TKey
 * @psalm-template TKey of array-key
 * @psalm-template T
 */
final class Key extends AbstractOperation
{
    /**
     * @psalm-return Closure(int): Closure(Iterator<TKey, T>): Generator<int, TKey>
     */
    public function __invoke(): Closure
    {
        return
            /**
             * @psalm-param int $index
             *
             * @psalm-return Closure(Iterator<TKey, T>): Generator<int, TKey>
             */
            static function (int $index): Closure {
                /** @psalm-var Closure(Iterator<TKey, T>): Generator<int, TKey> $pipe */
                $pipe = Pipe::of()(
                    Limit::of()(1)($index),
                    Flip::of()
                );

                // Point free style.
                return $pipe;
            };
    }
}
