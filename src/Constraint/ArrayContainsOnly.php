<?php

namespace Alezhu\PHPUnitArrayContainsAsserts\Constraint;

use SebastianBergmann\Comparator\ComparisonFailure;

class ArrayContainsOnly extends ArrayContains
{
    protected function _matchAssoc($other): bool
    {
        $result = parent::_matchAssoc($other);
        if ($result) {
            $subset = $this->_toArray($this->subset);
            foreach ($this->other_array as $key => $value) {
                if (!array_key_exists($key, $subset)) {
                    $failure = new ComparisonFailure($this->subset, $other, var_export($this->subset, true), var_export($other, true));
                    $this->fail($other, "Actual data contains unexpected keys: ($key)", $failure);
                };
            }
        }
        return $result;
    }

    protected function _matchUnAssoc($other): bool
    {
        $result = parent::_matchUnAssoc($other);
        if ($result) {
            $subset = $this->_toArray($this->subset);
            $flip_fail = false;
            set_error_handler(function () use (&$flip_fail) {
                $flip_fail = true;
            }, E_WARNING);
            $assoc_array = array_flip($subset);
            restore_error_handler();

            foreach ($other as $value) {
                if (
                    (!$flip_fail && !array_key_exists($value, $assoc_array))
                    ||
                    ($flip_fail && !in_array($value, $subset, $this->strict))
                ) {
                    $failure = new ComparisonFailure($this->subset, $other, var_export($this->subset, true), var_export($other, true));
                    $this->fail($other, "Actual data contains unexpected values: ($value)", $failure);
                }
            }
        }
        return $result;
    }

    public function toString(): string
    {
        return 'is contains only expected values or key-value pairs';
    }


}
