<?php

declare(strict_types=1);

include __DIR__ . '/../../vendor/autoload.php';

use loophp\collection\Collection;
use loophp\collection\Contract\Collection as CollectionInterface;

/**
 * @phpstan-param CollectionInterface<int, int> $collection
 *
 * @psalm-param CollectionInterface<int, int<0, 2>> $collection
 */
function keys_checkIntList(CollectionInterface $collection): void {}
/**
 * @param CollectionInterface<int, string> $collection
 */
function keys_checkStringList(CollectionInterface $collection): void {}

keys_checkIntList(Collection::fromIterable([1, 2, 3])->keys());
keys_checkStringList(Collection::fromIterable(['foo' => 'f', 'bar' => 'f'])->keys());

// VALID failure -> mixed keys
/** @psalm-suppress InvalidArgument @phpstan-ignore-next-line */
keys_checkIntList(Collection::fromIterable([1, 2, 'foo' => 4])->keys());
/** @psalm-suppress InvalidArgument @phpstan-ignore-next-line */
keys_checkStringList(Collection::fromIterable([1, 2, 'foo' => 4])->keys());
