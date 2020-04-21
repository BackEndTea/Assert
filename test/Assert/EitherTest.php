<?php

declare(strict_types=1);

namespace BackEndTea\Assert\Test\Assert;

use BackEndTea\Assert\Assert;
use BackEndTea\Assert\Type;
use Generator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class EitherTest extends TestCase
{
    /**
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::nullableString
     */
    public function testItCanBeNullableString(?string $input): void
    {
        $this->assertSame(
            $input,
            Assert::either(
                Type::string(),
                Type::null()
            )($input)
        );
    }

    /**
     * @param mixed $input
     *
     * @dataProvider provideNotNullableStrings
     */
    public function testItErrorsOnOtherTypes($input): void
    {
        $this->expectException(InvalidArgumentException::class);

        Assert::either(
            Type::string(),
            Type::null()
        )($input);
    }

    /**
     * @return Generator<array<string|null>>
     */
    public function provideNullableString(): Generator
    {
        yield [''];
        yield ['aaa'];
        yield [null];
    }

    /**
     * @return Generator<array<mixed>>
     */
    public function provideNotNullableStrings(): Generator
    {
        yield [[]];
        yield [12];
        yield [
            new class{
            },
        ];

        yield [
            new class{
                public function __toString(): string
                {
                    return 'boo';
                }
            },
        ];
    }
}
