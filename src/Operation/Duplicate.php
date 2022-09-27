<?php

declare(strict_types=1);

namespace loophp\collection\Operation;

use ArrayIterator;
use Closure;
use Generator;

/**
 * @immutable
 *
 * @template TKey
 * @template T
 *
 * phpcs:disable Generic.Files.LineLength.TooLong
 */
final class Duplicate extends AbstractOperation
{
    /**
     * @template U
     *
     * @return Closure(callable(U): Closure(U): bool): Closure(callable(T, TKey): U): Closure(iterable<TKey, T>): Generator<TKey, T>
     */
    public function __invoke(): Closure
    {
        return
            /**
             * @param callable(U): (Closure(U): bool) $comparatorCallback
             *
             * @return Closure(callable(T, TKey): U): Closure(iterable<TKey, T>): Generator<TKey, T>
             */
            static fn (callable $comparatorCallback): Closure =>
                /**
                 * @param callable(T, TKey): U $accessorCallback
                 *
                 * @return Closure(iterable<TKey, T>): Generator<TKey, T>
                 */
                static function (callable $accessorCallback) use ($comparatorCallback): Closure {
                    /** @var ArrayIterator<int, array{0: TKey, 1: T}> $stack */
                    $stack = new ArrayIterator();

                    $filter = (new Filter())()(
                        /**
                         * @param T $value
                         * @param TKey $key
                         */
                        static function ($value, $key) use ($comparatorCallback, $accessorCallback, $stack): bool {
                            $matcher =
                                /**
                                 * @param array{0: TKey, 1: T} $item
                                 */
                                static fn (int $index, array $item): bool => !$comparatorCallback($accessorCallback($value, $key))($accessorCallback($item[1], $item[0]));

                            $every = (new Every())()($matcher)($stack)->current();

                            if (false === $every) {
                                return true;
                            }

                            $stack->append([$key, $value]);

                            return false;
                        }
                    );

                    // Point free style.
                    return $filter;
                };
    }
}
