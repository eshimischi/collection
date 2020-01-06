<?php

declare(strict_types=1);

namespace loophp\collection\Operation;

use Closure;
use Generator;
use loophp\collection\Contract\Operation;

/**
 * Class Until.
 */
final class Until implements Operation
{
    /**
     * @var callable
     */
    private $callable;

    /**
     * Until constructor.
     *
     * @param callable $callable
     */
    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }

    /**
     * {@inheritdoc}
     */
    public function on(iterable $collection): Closure
    {
        $callable = $this->callable;

        return static function () use ($callable, $collection): Generator {
            foreach ($collection as $key => $value) {
                yield $key => $value;

                if (true === $callable($value, $key)) {
                    break;
                }
            }
        };
    }
}