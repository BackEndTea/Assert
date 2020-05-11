<?php

declare(strict_types=1);

namespace BackEndTea\Assert\Test;

use BackEndTea\Assert\Type;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class TypeTest extends TestCase
{
    /**
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::int()
     */
    public function testInt(int $input): void
    {
        $this->assertSame($input, Type::int()($input));
    }

    /**
     * @param mixed $input
     *
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::string()
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::null()
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::bool()
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::float()
     */
    public function testNotInt($input): void
    {
        $call = Type::int();

        $this->expectException(InvalidArgumentException::class);
        $call($input);
    }

    /**
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::float()
     */
    public function testFloat(float $input): void
    {
        $this->assertSame($input, Type::float()($input));
    }

    /**
     * @param mixed $input
     *
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::int()
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::string()
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::null()
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::bool()
     */
    public function testNotFloat($input): void
    {
        $call = Type::float();

        $this->expectException(InvalidArgumentException::class);
        $call($input);
    }

    /**
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::bool()
     */
    public function testBool(bool $bool): void
    {
        $this->assertSame($bool, Type::bool()($bool));
    }

    /**
     * @param mixed $input
     *
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::int()
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::string()
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::null()
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::float()
     */
    public function testNotBool($input): void
    {
        $call = Type::bool();

        $this->expectException(InvalidArgumentException::class);
        $call($input);
    }

    /**
     * @param mixed $array
     *
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::array()
     */
    public function testArray($array): void
    {
        $this->assertSame($array, Type::array()($array));
    }

    /**
     * @param mixed $input
     *
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::int()
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::string()
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::null()
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::float()
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::bool()
     */
    public function testNotArray($input): void
    {
        $call = Type::array();

        $this->expectException(InvalidArgumentException::class);
        $call($input);
    }

    /**
     * @param mixed $object
     *
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::object()
     */
    public function testObject($object): void
    {
        $this->assertSame($object, Type::object()($object));
    }

    /**
     * @param mixed $input
     *
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::int()
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::string()
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::null()
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::float()
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::bool()
     * @dataProvider \BackEndTea\Assert\Test\TypeProvider::array()
     */
    public function testNotObject($input): void
    {
        $call = Type::object();

        $this->expectException(InvalidArgumentException::class);
        $call($input);
    }
}
