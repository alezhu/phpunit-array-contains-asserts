<?php

namespace Alezhu\PHPUnitArrayContainsAsserts;

use Alezhu\PHPUnitArrayContainsAsserts\Constraint\ArrayContains;
use Alezhu\PHPUnitArrayContainsAsserts\Constraint\ArrayContainsOnly;
use ArrayAccess;
use Iterator;
use PHPUnit\Framework\Assert as PhpUnitAssert;
use PHPUnit\Framework\InvalidArgumentException;

trait ArrayContainsTrait
{
    /**
     * @param $subset
     * @param $array
     * @param bool $strict
     * @param string $message
     * @return void
     */
    public static function assertArrayContains($subset, $array, bool $strict = false, string $message = '')
    {
        if (!(is_array($subset) || $subset instanceof ArrayAccess || $subset instanceof Iterator)) {
            throw InvalidArgumentException::create(
                1,
                'array or ArrayAccess or Iterator'
            );
        }
        if (!(is_array($array) || $array instanceof ArrayAccess || $array instanceof Iterator)) {
            throw InvalidArgumentException::create(
                2,
                'array or ArrayAccess or Iterator'
            );
        }

        $constraint = new ArrayContains($subset, $strict);
        PhpUnitAssert::assertThat($array, $constraint, $message);
    }

    /**
     * @param $subset
     * @param $array
     * @param bool $strict
     * @param string $message
     * @return void
     */
    public static function assertArrayContainsOnly($subset, $array, bool $strict = false, string $message = '')
    {
        if (!(is_array($subset) || $subset instanceof ArrayAccess || $subset instanceof Iterator)) {
            throw InvalidArgumentException::create(
                1,
                'array or ArrayAccess or Iterator'
            );
        }
        if (!(is_array($array) || $array instanceof ArrayAccess || $array instanceof Iterator)) {
            throw InvalidArgumentException::create(
                2,
                'array or ArrayAccess or Iterator'
            );
        }

        $constraint = new ArrayContainsOnly($subset, $strict);
        PhpUnitAssert::assertThat($array, $constraint, $message);
    }
}
