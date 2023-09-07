<?php

namespace Alezhu\PHPUnitArrayContainsAsserts\Constraint;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\Constraint\IsEqual;
use PHPUnit\Framework\Constraint\IsIdentical;
use SebastianBergmann\Comparator\ComparisonFailure;


class ArrayContains extends ArrayContainsBase
{
    protected array $other_array;

    public function toString(): string
    {
        return 'is contains expected values or key-value pairs';
    }

    protected function _matchAssoc(mixed $other): bool
    {
        foreach ($this->subset as $key => $value) {
            if (!array_key_exists($key, $this->other_array)) {
                $failure = new ComparisonFailure($this->subset, $other, var_export($this->subset, true), var_export($other, true));
                $this->fail($other, "Actual data not contains some expected keys: ($key)", $failure);
            }

            $actual = $this->other_array[$key];
            $constraint = $value instanceof Constraint ? $value : ($this->strict ? new IsIdentical($value) : new IsEqual($value));
            $valid = $constraint->evaluate($actual, '', true);
            if (!$valid) {
                $failure = new ComparisonFailure($this->subset, $other, var_export($this->subset, true), var_export($other, true));
                $this->fail($other, "Actual data contains unexpected values: ($key)", $failure);
            }
        }
        return true;
    }

    protected function _matchUnAssoc(mixed $other): bool
    {
        $flip_fail = false;
        set_error_handler(function () use (&$flip_fail) {
            $flip_fail = true;
        }, E_WARNING);
        $assoc_array = array_flip($this->other_array);
        restore_error_handler();

        foreach ($this->subset as $value) {
            if (
                (!$flip_fail && !array_key_exists($value, $assoc_array))
                ||
                ($flip_fail && !in_array($value, $this->other_array, $this->strict))
            ) {
                $failure = new ComparisonFailure($this->subset, $other, var_export($this->subset, true), var_export($other, true));
                $this->fail($other, "Actual data not contains some values: ($value)", $failure);
            }
        }
        return true;
    }

    protected function matches($other): bool
    {
        if ($this->_isAssocArray($other)) {
            if (!$this->_isAssocArray($this->subset)) {
                throw new AssertionFailedError('Actual data is an associative array, but expected data is not');
            }
            $this->other_array = $this->_toArray($other);
            return $this->_matchAssoc($other);
        } else {
            if ($this->_isAssocArray($this->subset)) {
                throw new AssertionFailedError('Actual data is not an associative array, but expected data is that');
            }
            $this->other_array = $this->_toArray($other);
            return $this->_matchUnAssoc($other);
        }
    }
}
