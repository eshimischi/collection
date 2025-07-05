<?php

declare(strict_types=1);

namespace tests\loophp\collection;

use loophp\collection\Collection;
use loophp\PhpUnitIterableAssertions\Traits\IterableAssertions;
use PHPUnit\Framework\TestCase;
use tests\loophp\collection\Traits\GenericCollectionProviders;

/**
 * @internal
 *
 * @coversDefaultClass \loophp\collection
 */
final class CustomCollectionGenericOperationTest extends TestCase
{
    use GenericCollectionProviders;
    use IterableAssertions;

    /**
     * @dataProvider allOperationProvider
     * @dataProvider appendOperationProvider
     * @dataProvider applyOperationProvider
     * @dataProvider associateOperationProvider
     * @dataProvider averagesOperationProvider
     * @dataProvider cacheOperationProvider
     * @dataProvider chunkOperationProvider
     * @dataProvider coalesceOperationProvider
     * @dataProvider collapseOperationProvider
     * @dataProvider columnOperationProvider
     * @dataProvider combinateOperationProvider
     * @dataProvider combineOperationProvider
     * @dataProvider compactOperationProvider
     * @dataProvider cycleOperationProvider
     * @dataProvider diffOperationProvider
     * @dataProvider diffKeysOperationProvider
     * @dataProvider distinctOperationProvider
     * @dataProvider dropOperationProvider
     * @dataProvider dropWhileOperationProvider
     * @dataProvider dumpOperationProvider
     * @dataProvider duplicateOperationProvider
     * @dataProvider explodeOperationProvider
     * @dataProvider filterOperationProvider
     * @dataProvider flatMapOperationProvider
     * @dataProvider flattenOperationProvider
     * @dataProvider flipOperationProvider
     * @dataProvider forgetOperationProvider
     * @dataProvider frequencyOperationProvider
     * @dataProvider groupOperationProvider
     * @dataProvider groupByOperationProvider
     * @dataProvider ifThenElseOperationProvider
     * @dataProvider initOperationProvider
     * @dataProvider initsOperationProvider
     * @dataProvider intersectOperationProvider
     * @dataProvider intersectKeysOperationProvider
     * @dataProvider intersperseOperationProvider
     * @dataProvider keysOperationProvider
     * @dataProvider limitOperationProvider
     * @dataProvider linesOperationProvider
     * @dataProvider mapOperationProvider
     * @dataProvider mapNOperationProvider
     * @dataProvider matchingOperationProvider
     * @dataProvider mergeOperationProvider
     * @dataProvider normalizeOperationProvider
     * @dataProvider nthOperationProvider
     * @dataProvider packOperationProvider
     * @dataProvider padOperationProvider
     * @dataProvider pairOperationProvider
     * @dataProvider permutateOperationProvider
     * @dataProvider pipeOperationProvider
     * @dataProvider pluckOperationProvider
     * @dataProvider prependOperationProvider
     * @dataProvider productOperationProvider
     * @dataProvider reductionOperationProvider
     * @dataProvider rejectOperationProvider
     * @dataProvider reverseOperationProvider
     * @dataProvider scaleOperationProvider
     * @dataProvider scanLeftOperationProvider
     * @dataProvider scanLeft1OperationProvider
     * @dataProvider scanRightOperationProvider
     * @dataProvider scanRight1OperationProvider
     * @dataProvider shuffleOperationProvider
     * @dataProvider sinceOperationProvider
     * @dataProvider sliceOperationProvider
     * @dataProvider sortOperationProvider
     * @dataProvider splitOperationProvider
     * @dataProvider squashOperationProvider
     * @dataProvider strictOperationProvider
     * @dataProvider tailOperationProvider
     * @dataProvider tailsOperationProvider
     * @dataProvider takeWhileOperationProvider
     * @dataProvider transposeOperationProvider
     * @dataProvider unpackOperationProvider
     * @dataProvider unpairOperationProvider
     * @dataProvider untilOperationProvider
     * @dataProvider unwindowOperationProvider
     * @dataProvider unwrapOperationProvider
     * @dataProvider unzipOperationProvider
     * @dataProvider whenOperationProvider
     * @dataProvider windowOperationProvider
     * @dataProvider wordsOperationProvider
     * @dataProvider wrapOperationProvider
     * @dataProvider zipOperationProvider
     */
    public function testCollectionGeneric(
        string $operation,
        array $parameters,
        iterable $actual,
        iterable $expected,
        int $limit = 0
    ): void {
        $actual = (new CustomCollection(Collection::fromIterable($actual)))
            ->{$operation}(...$parameters);

        if (0 !== $limit) {
            $actual = $actual->limit($limit);
        }

        $this::assertIdenticalIterable(
            $expected,
            $actual
        );
    }

    /**
     * @dataProvider compareOperationProvider
     * @dataProvider containsOperationProvider
     * @dataProvider currentOperationProvider
     * @dataProvider equalsOperationProvider
     * @dataProvider everyOperationProvider
     * @dataProvider falsyOperationProvider
     * @dataProvider findOperationProvider
     * @dataProvider firstOperationProvider
     * @dataProvider foldLeftOperationProvider
     * @dataProvider foldLeft1OperationProvider
     * @dataProvider foldRightOperationProvider
     * @dataProvider foldRight1OperationProvider
     * @dataProvider getOperationProvider
     * @dataProvider hasOperationProvider
     * @dataProvider headOperationProvider
     * @dataProvider implodeOperationProvider
     * @dataProvider isEmptyOperationProvider
     * @dataProvider isNotEmptyOperationProvider
     * @dataProvider keyOperationProvider
     * @dataProvider lastOperationProvider
     * @dataProvider matchOperationProvider
     * @dataProvider maxOperationProvider
     * @dataProvider minOperationProvider
     * @dataProvider nullsyOperationProvider
     * @dataProvider reduceOperationProvider
     * @dataProvider sameOperationProvider
     * @dataProvider truthyOperationProvider
     * @dataProvider unlinesOperationProvider
     * @dataProvider unwordsOperationProvider
     */
    public function testGenericScalar(
        string $operation,
        array $parameters,
        iterable $actual,
        mixed $expected
    ): void {
        self::assertSame(
            $expected,
            (new CustomCollection(Collection::fromIterable($actual)))->{$operation}(...$parameters)
        );
    }
}
