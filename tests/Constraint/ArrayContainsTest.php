<?php

namespace Alezhu\PHPUnitArrayContainsAsserts\Constraint\Tests;

use Alezhu\PHPUnitArrayContainsAsserts\Constraint\ArrayContains;
use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Constraint\IsType;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\Exporter\Exporter;
use SplFixedArray;

class ArrayContainsTest extends TestCase
{
    public function test_matches_should_raise_exception_if_compare_assoc_array_with_unassoc_array()
    {
        $exception = new AssertionFailedError('Actual data is an associative array, but expected data is not');
        $this->expectExceptionObject($exception);
        $instance = new ArrayContains(['bar']);
        $instance->evaluate(["foo" => "bar"]);
    }

    public function test_matches_should_raise_exception_if_compare_unassoc_array_with_assoc_array()
    {
        $exception = new AssertionFailedError('Actual data is not an associative array, but expected data is that');
        $this->expectExceptionObject($exception);
        $instance = new ArrayContains(["foo" => "bar"]);
        $instance->evaluate(['bar']);
    }

    public function test_matches_unassoc_should_be_valid_if_all_expected_values_in_result()
    {
        $instance = new ArrayContains(["foo", "bar"]);
        $result = $instance->evaluate(["bar", "foo"], '', true);
        self::assertTrue($result);
    }

    public function test_matches_assoc_should_be_valid_if_all_expected_values_in_result()
    {
        $instance = new ArrayContains(["foo" => self::isType(IsType::TYPE_STRING), "bar" => 1]);
        $result = $instance->evaluate(["bar" => 1, "foo" => "value", "baz" => true], '', true);
        self::assertTrue($result);
    }

    public function test_matches_unassoc_should_be_valid_if_all_expected_values_in_ArrayAccess_result()
    {
        $instance = new ArrayContains(["foo", "bar"]);
        $result = SplFixedArray::fromArray(["bar", "foo", "baz"]);

        $result = $instance->evaluate($result, '', true);
        self::assertTrue($result);
    }

    public function test_matches_unassoc_should_be_valid_for_non_int_and_non_string_values()
    {
        $instance = new ArrayContains([true, false]);
        $result = SplFixedArray::fromArray([true, "foo", false]);

        $result = $instance->evaluate($result, '', true);
        self::assertTrue($result);
    }

    public function test_matches_unassoc_should_raise_exception_if_some_of_expected_values_is_absent_in_result()
    {
        $this->expectException(ExpectationFailedException::class);
        $result = ["bar"];
        $instance = new ArrayContains(["foo", "bar"]);
        $exporter = new Exporter();
        $this->expectExceptionMessage(
            sprintf(
                "Actual data not contains some values: (foo)\nFailed asserting that %s is contains expected values or key-value pairs.",
                $exporter->export($result)
            )
        );

        $instance->evaluate($result);
    }

    public function test_matches_assoc_should_raise_exception_if_some_of_expected_keys_is_absent_in_result()
    {
        $this->expectException(ExpectationFailedException::class);
        $result = ["bar" => "value"];
        $instance = new ArrayContains(["foo" => self::isType(IsType::TYPE_STRING), "bar" => 1]);
        $exporter = new Exporter();
        $this->expectExceptionMessage(
            sprintf(
                "Actual data not contains some expected keys: (foo)\nFailed asserting that %s is contains expected values or key-value pairs.",
                $exporter->export($result)
            )
        );

        $instance->evaluate($result);
    }

    public function test_matches_assoc_should_raise_exception_if_some_of_expected_value_is_invalid_in_result()
    {
        $this->expectException(ExpectationFailedException::class);
        $result = ["bar" => "value", "foo" => "value"];
        $instance = new ArrayContains(["foo" => self::isType(IsType::TYPE_STRING), "bar" => 1]);
        $exporter = new Exporter();
        $this->expectExceptionMessage(
            sprintf(
                "Actual data contains unexpected values: (bar)\nFailed asserting that %s is contains expected values or key-value pairs.",
                $exporter->export($result)
            )
        );

        $instance->evaluate($result);
    }

    public function test_toString_should_return_constraint_assertion()
    {
        $instance = new ArrayContains([]);
        $result = $instance->toString();
        self::assertEquals('is contains expected values or key-value pairs', $result);
    }
}
