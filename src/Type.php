<?php

declare(strict_types=1);

namespace BackEndTea\Assert;

use InvalidArgumentException;
use function is_array;
use function is_bool;
use function is_float;
use function is_int;
use function is_object;
use function is_string;

final class Type
{
    private function __construct()
    {
    }

    /**
     * @return callable(mixed): string
     */
    public static function string(): callable
    {
        /**
         * @throws InvalidArgumentException
         */
        return static function ($input): string {
            if (! is_string($input)) {
                throw new InvalidArgumentException();
            }

            return $input;
        };
    }

    /**
     * @return callable(mixed): int
     */
    public static function int(): callable
    {
        /**
         * @throws InvalidArgumentException
         */
        return static function ($input): int {
            if (! is_int($input)) {
                throw new InvalidArgumentException();
            }

            return $input;
        };
    }

    /**
     * @return callable(mixed): float
     */
    public static function float(): callable
    {
        /**
         * @throws InvalidArgumentException
         */
        return static function ($input): float {
            if (! is_float($input)) {
                throw new InvalidArgumentException();
            }

            return $input;
        };
    }

    /**
     * @return callable(mixed): bool
     */
    public static function bool(): callable
    {
        /**
         * @throws InvalidArgumentException
         */
        return static function ($input): bool {
            if (! is_bool($input)) {
                throw new InvalidArgumentException();
            }

            return $input;
        };
    }

    /**
     * @return callable(mixed): array<mixed>
     */
    public static function array(): callable
    {
        return static function ($input): array {
            if (! is_array($input)) {
                throw new InvalidArgumentException();
            }

            return $input;
        };
    }

    /**
     * @return callable(mixed): object
     */
    public static function object(): callable
    {
        return static function ($input): object {
            if (! is_object($input)) {
                throw new InvalidArgumentException();
            }

            return $input;
        };
    }

    /**
     * @return callable(mixed): null
     */
    public static function null(): callable
    {
        return static function ($input) {
            if ($input !== null) {
                throw new InvalidArgumentException();
            }

            return $input;
        };
    }

    /**
     * @param class-string<T> $className
     *
     * @return callable(mixed): T
     *
     * @template T
     */
    public static function instance(string $className): callable
    {
        return static function ($input) use ($className) {
            if ($input instanceof $className) {
                return $input;
            }

            throw new InvalidArgumentException();
        };
    }
}
