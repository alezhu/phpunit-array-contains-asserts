<?php

namespace Alezhu\PHPUnitArrayContainsAsserts\Tests\Exception;

use Alezhu\PHPUnitArrayContainsAsserts\Exception\InvalidArgumentTypeException;
use PHPUnit\Framework\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class InvalidArgumentTypeExceptionTest extends TestCase
{

    public function test_create()
    {
        $argument = 1;
        $type = "array";

        $instance = InvalidArgumentTypeException::create($argument, $type);
        self::assertInstanceOf(InvalidArgumentTypeException::class, $instance);

        $result = $instance->getMessage();
        $expect = sprintf("Argument #%d must be %s", $argument, $type);
        self::assertEquals($expect, $result);
    }

    public function test_1_construct()
    {
        $instance = new InvalidArgumentTypeException(1, "");
        self::assertInstanceOf(InvalidArgumentTypeException::class, $instance);
        self::assertInstanceOf(InvalidArgumentException::class, $instance);
    }
}
