<?php

declare(strict_types=1);

namespace BackEndTea\Assert\Test\Assert;

use BackEndTea\Assert\Assert;
use BackEndTea\Assert\Type;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class NotTest extends TestCase
{
    /**
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::nullableString
     */
    public function testNotNullableString(?string $input): void
    {
        $callable = Assert::not(
            Assert::either(
                Type::string(),
                Type::null()
            )
        );
        $this->expectException(InvalidArgumentException::class);
        $callable($input);
    }

    public function testNotNotNullableString(): void
    {
        $callable = Assert::not(
            Assert::either(
                Type::string(),
                Type::null()
            )
        );
        $this->assertSame(12, $callable(12));
    }
}
