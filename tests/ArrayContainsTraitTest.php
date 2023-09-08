<?php

namespace Alezhu\PHPUnitArrayContainsAsserts\Tests;


use Alezhu\PHPUnitArrayContainsAsserts\Assert;
use PHPUnit\Framework\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ArrayContainsTraitTest extends TestCase
{
    public function test_assertArrayContains_should_be_valid_for_valid_arguments()
    {
        Assert::assertArrayContains(["foo" => "bar", "baz" => 1], ["foo" => "bar", "baz" => 1]);
    }

    public function test_assertArrayContainsOnly_should_be_valid_for_valid_arguments()
    {
        Assert::assertArrayContainsOnly(["foo" => "bar", "baz" => 1], ["foo" => "bar", "baz" => 1]);
    }

    public function test_assertArrayContains_should_raise_exception_if_passed_not_array_like_subset()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Argument #1 must be array or ArrayAccess or Iterator");

        Assert::assertArrayContains("string", []);
    }

    public function test_assertArrayContains_should_raise_exception_if_passed_not_array_like_actual()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Argument #2 must be array or ArrayAccess or Iterator");

        Assert::assertArrayContains([], "string");
    }

    public function test_assertArrayContainsOnly_should_raise_exception_if_passed_not_array_like_subset()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Argument #1 must be array or ArrayAccess or Iterator");

        Assert::assertArrayContainsOnly("string", []);
    }

    public function test_assertArrayContainsOnly_should_raise_exception_if_passed_not_array_like_actual()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Argument #2 must be array or ArrayAccess or Iterator");

        Assert::assertArrayContainsOnly([], "string");
    }
}
