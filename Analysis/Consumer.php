<?php

declare(strict_types=1);

namespace BackEndTea\Assert\Analysis;

use BackEndTea\Assert\Assert;
use BackEndTea\Assert\Test\Fixtures\IFour;
use BackEndTea\Assert\Test\Fixtures\IOne;
use BackEndTea\Assert\Test\Fixtures\IThree;
use BackEndTea\Assert\Test\Fixtures\ITwo;
use BackEndTea\Assert\Type;

/**
 * @internal
 */
final class Consumer
{
    public function consumeNullOr(string $input): ?string
    {
        return Assert::either(
            Type::string(),
            Type::null()
        )($input);
    }

    public function consumeInterFaces(object $input): void
    {
        $result = Assert::both(
            Type::instance(IOne::class),
            Type::instance(ITwo::class)
        )($input);
        $result->methodOne();
        $result->methodTwo();
    }

    /**
     * @param mixed $input
     *
     * @return array<string|null>
     */
    public function consumeNullableArrayType($input): array
    {
        $callback = Assert::either(
            Type::string(),
            Type::null()
        );

        return Assert::all($callback)(Type::array()($input));
    }

    /**
     * @param mixed $input
     */
    public function moreComplex($input): void
    {
        $input = Assert::either(
            Assert::both(
                Type::instance(IOne::class),
                Type::instance(ITwo::class)
            ),
            Assert::either(
                Type::string(),
                Type::null()
            )
        )($input);

        /*
         * After this we know $input is of type IOne&ITwo, as they are in the Both
         */
        if (! ($input instanceof IOne)) {
            return;
        }

        $input->methodOne();
        $input->methodTwo();
    }

    /**
     * @param mixed $input
     */
    public function consumeMultipleBoths($input): void
    {
        $input = Assert::both(
            Assert::both(
                Type::instance(IOne::class),
                Type::instance(ITwo::class),
            ),
            Assert::both(
                Type::instance(IThree::class),
                Type::instance(IFour::class),
            )
        )($input);

        $input->methodOne();
        $input->methodTwo();
        $input->methodThree();
        $input->methodFour();
    }
}
