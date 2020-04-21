<?php

declare(strict_types=1);

namespace BackEndTea\Assert\Test\Assert;

use BackEndTea\Assert\Assert;
use BackEndTea\Assert\Type;
use PHPUnit\Framework\TestCase;

final class AllTest extends TestCase
{
    public function testAllMatch(): void
    {
        $input    = [
            'foo',
            null,
            '',
            '12',
        ];
        $callback = Assert::either(
            Type::string(),
            Type::null()
        );
        $this->assertSame($input, Assert::all($callback)($input));
    }
}
