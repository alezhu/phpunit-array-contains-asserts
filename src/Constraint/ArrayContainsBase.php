<?php

namespace Alezhu\PHPUnitArrayContainsAsserts\Constraint;

use ArrayAccess;
use ArrayObject;
use Countable;
use Iterator;
use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Constraint\Constraint;

if (!function_exists('array_is_list')) {
    function array_is_list($arr): bool
    {
        if ($arr === []) {
            return true;
        }
        return array_keys($arr) === range(0, count($arr) - 1);
    }
}

abstract class ArrayContainsBase extends Constraint
{
    /**
     * @var iterable|array
     */
    protected $subset;

    /**
     * @var bool
     */
    protected $strict;

    /**
     * @param array $subset
     * @param bool $strict
     */
    public function __construct(array $subset, bool $strict = false)
    {
        $this->subset = $subset;
        $this->strict = $strict;
    }

    protected function _isAssocArray($array): bool
    {
        if (is_array($array)) {
            return !array_is_list($array);
        }
        if ($array instanceof ArrayAccess) {
            if ($array instanceof Countable) {
                $count = $array->count();
                for ($index = 0; $index < $count; ++$index) {
                    if (!$array->offsetExists($index)) return true;
                }
                return false;
            } else {
                throw new AssertionFailedError('Not supported type');
            }
        }
        if ($array instanceof Iterator) {
            $index = 0;
            for ($array->rewind(); $array->valid(); $array->next()) {
                if ($array->key() !== $index++) return true;
            }
            return false;
        }

        throw new AssertionFailedError('Not supported type');
    }

    protected function _toArray($value)
    {
        if (is_array($value)) return $value;
        if ($value instanceof ArrayObject) {
            return $value->getArrayCopy();
        }

        if ($value instanceof Iterator) {
            return iterator_to_array($value);
        }

        if ($value instanceof ArrayAccess) {
            if ($value instanceof Countable) {
                $count = $value->count();
                $result = [];
                for ($index = 0; $index < $count; ++$index) {
                    $result[$index] = $value->offsetGet($index);
                }
                return $result;
            }
        }
        throw new AssertionFailedError('Not supported type');
    }
}
