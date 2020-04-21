<?php

declare(strict_types=1);

namespace BackEndTea\Assert\Test;

use Generator;
use const INF;
use const PHP_INT_MAX;
use const PHP_INT_MIN;

final class TypeProvider
{
    private function __construct()
    {
    }

    /**
     * @return Generator<array<string|null>>
     */
    public static function nullableString(): Generator
    {
        yield from self::string();
        yield from self::null();
    }

    /**
     * @return Generator<array<string>>
     */
    public static function string(): Generator
    {
        yield [''];
        yield ['12'];
        yield ['8.4'];
        yield[(string) INF];
        yield ['foooo'];
        yield ['true'];
        yield ['false'];
        yield ['null'];
        yield ['😎😎😎'];
        yield ['normal text'];
        yield [self::class];
    }

    /**
     * @return Generator<array<null>>
     */
    public static function null(): Generator
    {
        yield [null];
    }

    /**
     * @return Generator<array<bool>>
     */
    public static function bool(): Generator
    {
        yield [true];
        yield [false];
    }

    /**
     * @return Generator<array<int>>
     */
    public static function int(): Generator
    {
        yield [1];
        yield [0];
        yield [PHP_INT_MAX];
        yield [PHP_INT_MIN];
        yield [-0];
        yield [-12];
        yield [16];
    }

    /**
     * @return Generator<array<float>>
     */
    public static function float(): Generator
    {
        yield [1.7];
        yield [0.0];
        yield [0.2];
        yield [INF];
        yield [-0.0];
        yield [-0.3];
        yield [-12.3];
        yield [-12.0];
        yield [16.2];
        yield [18.0];
    }
}
