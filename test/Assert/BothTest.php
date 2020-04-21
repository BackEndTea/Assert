<?php

declare(strict_types=1);

namespace BackEndTea\Assert\Test\Assert;

use BackEndTea\Assert\Assert;
use BackEndTea\Assert\Test\Fixtures\IOne;
use BackEndTea\Assert\Test\Fixtures\ITwo;
use BackEndTea\Assert\Type;
use PHPUnit\Framework\TestCase;

final class BothTest extends TestCase
{
    public function testItCanBeBoth(): void
    {
        $testCase = new class implements IOne, ITwo
        {
            public function methodOne(): void
            {
            }

            public function methodTwo(): void
            {
            }
        };
        $this->assertSame(
            $testCase,
            Assert::both(
                Type::instance(IOne::class),
                Type::instance(ITwo::class)
            )($testCase)
        );
    }
}
