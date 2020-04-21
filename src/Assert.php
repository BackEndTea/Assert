<?php

declare(strict_types=1);

namespace BackEndTea\Assert;

use InvalidArgumentException;

final class Assert
{
    private function __construct()
    {
    }

    /**
     * @param callable(mixed): TFirst  $first
     * @param callable(mixed): TSecond $second
     *
     * @return callable(mixed): (TFirst|TSecond)
     *
     * @template TFirst
     * @template TSecond
     */
    public static function either(callable $first, callable $second): callable
    {
        return static function ($input) use ($first, $second) {
            try {
                return $first($input);
            } catch (InvalidArgumentException $e) {
                // pass through
            }

            try {
                return $second($input);
            } catch (InvalidArgumentException $e) {
                // pass through
            }

            throw new InvalidArgumentException();
        };
    }

    /**
     * @param callable(mixed): TFirst    $first
     * @param callable(mixed): (TSecond) $second
     *
     * @return callable(mixed): (TFirst&TSecond)
     *
     * @template TFirst
     * @template TSecond
     */
    public static function both(callable $first, callable $second): callable
    {
        return static function ($input) use ($first, $second) {
            return $second($first($input));
        };
    }

    /**
     * @param callable(mixed): T $callable
     *
     * @return callable(array<mixed> ): array<T>
     *
     * @template T
     */
    public static function all(callable $callable): callable
    {
        return static function (array $input) use ($callable) {
            /**
             * @var mixed $value
             */
            foreach ($input as $key => $value) {
                $input[$key] = $callable($value);
            }

            return $input;
        };
    }

    /**
     * @param callable(mixed): mixed $callable
     *
     * @return callable(mixed): mixed
     *
     * @futre-param callable(mixed): TNot $callable
     * @future-return callable(T): T~TNot
     * @future-template T
     * @future-template TNot
     */
    public static function not(callable $callable): callable
    {
        return static function ($input) use ($callable) {
            try {
                $callable($input);
            } catch (InvalidArgumentException $e) {
                return $input;
            }

            throw new InvalidArgumentException();
        };
    }
}
