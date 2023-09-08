<?php

namespace Alezhu\PHPUnitArrayContainsAsserts\Tests\Constraint;

use Alezhu\PHPUnitArrayContainsAsserts\Constraint\ArrayContainsOnly;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\Exporter\Exporter;

class ArrayContainsOnlyTest extends TestCase
{

    public function test_toString_should_return_constraint_assertion()
    {
        $instance = new ArrayContainsOnly([]);
        $result = $instance->toString();
        self::assertEquals('is contains only expected values or key-value pairs', $result);
    }

    public function test_matches_unassoc_should_be_valid_if_only_expected_values_in_result()
    {
        $instance = new ArrayContainsOnly(["foo", "bar"]);
        $result = $instance->evaluate(["bar", "foo"], '', true);
        self::assertTrue($result);
    }

    public function test_matches_unassoc_should_raise_exception_if_result_contains_unexpected_values()
    {
        $instance = new ArrayContainsOnly(["foo", "bar"]);
        $result = ["bar", "foo", "baz"];
        $this->expectException(ExpectationFailedException::class);

        $exporter = new Exporter();

        $this->expectExceptionMessage(
            sprintf(
                "Actual data contains unexpected values: (baz)\nFailed asserting that %s is contains only expected values or key-value pairs.",
                $exporter->export($result)
            )
        );
        $instance->evaluate($result, '', true);
    }

    public function test_matches_assoc_should_be_valid_if_all_expected_values_in_result()
    {
        $instance = new ArrayContainsOnly(["foo" => self::isType("string"), "bar" => 1]);
        $result = $instance->evaluate(["bar" => 1, "foo" => "value"], '', true);
        self::assertTrue($result);
    }

    public function test_matches_assoc_should_raise_exception_if_result_contains_unexpected_keys()
    {
        $this->expectException(ExpectationFailedException::class);
        $result = ["bar" => "value", "foo" => 1];
        $instance = new ArrayContainsOnly(["bar" => "value"]);
        $exporter = new Exporter();
        $this->expectExceptionMessage(
            sprintf(
                "Actual data contains unexpected keys: (foo)\nFailed asserting that %s is contains only expected values or key-value pairs.",
                $exporter->export($result)
            )
        );

        $instance->evaluate($result);
    }
}
