<?php

namespace Alezhu\PHPUnitArrayContainsAsserts\Constraint\Tests;

use Alezhu\PHPUnitArrayContainsAsserts\Constraint\ArrayContainsBase;
use ArrayAccess;
use ArrayIterator;
use ArrayObject;
use Countable;
use LimitIterator;
use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\TestCase;
use SplFixedArray;

class TestArrayContains extends ArrayContainsBase
{

    public function isAssocArray($array): bool
    {
        return parent::_isAssocArray($array);
    }

    public function toArray($value): array
    {
        return parent::_toArray($value);
    }

    public function toString(): string
    {
        return 'test stub';
    }


}

class TestArrayAccess implements ArrayAccess
{
    protected array $array;

    public function __construct(
        $array = []
    )
    {
        $this->array = $array;
    }

    public function offsetExists($offset): bool
    {
        return isset($this->array[$offset]);
    }

    public function offsetGet($offset): mixed
    {
        return $this->array[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        $this->array[$offset] = $value;
    }

    public function offsetUnset($offset): void
    {
        unset($this->array[$offset]);
    }
}

class ArrayContainsBaseTest extends TestCase
{

    public function test_1_construct()
    {
        $instance1 = new TestArrayContains([]);
        self::assertInstanceOf(ArrayContainsBase::class, $instance1);

        $instance2 = new TestArrayContains([], true);
        self::assertInstanceOf(ArrayContainsBase::class, $instance2);
    }

    public function test_isAssocArray_should_raise_exception_4_ArrayAccessObject_without_Countable()
    {
        $instance = new TestArrayContains([]);
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage("Not supported type");

        $instance->isAssocArray(new TestArrayAccess());
    }

    public function test_isAssocArray_should_raise_exception_4_bool()
    {
        $instance = new TestArrayContains([]);
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage("Not supported type");

        $instance->isAssocArray(true);
    }

    public function test_isAssocArray_should_raise_exception_4_int()
    {
        $instance = new TestArrayContains([]);
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage("Not supported type");

        $instance->isAssocArray(1);
    }

    public function test_isAssocArray_should_raise_exception_4_null()
    {
        $instance = new TestArrayContains([]);
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage("Not supported type");

        $instance->isAssocArray(null);
    }

    public function test_isAssocArray_should_raise_exception_4_object()
    {
        $instance = new TestArrayContains([]);
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage("Not supported type");

        $instance->isAssocArray($instance);
    }

    public function test_isAssocArray_should_raise_exception_4_string()
    {
        $instance = new TestArrayContains([]);
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage("Not supported type");

        $instance->isAssocArray("1");
    }

    public function test_isAssocArray_should_return_false_4_unassoc_arrayable_entities()
    {
        $instance = new TestArrayContains([]);
        self::assertFalse($instance->isAssocArray([]));
        self::assertFalse($instance->isAssocArray([1]));
        self::assertFalse($instance->isAssocArray([1, 2]));
        self::assertFalse($instance->isAssocArray([1, 2, 3]));
        self::assertFalse($instance->isAssocArray([0 => 1]));
        //ArrayAccess+Countable
        self::assertFalse($instance->isAssocArray(SplFixedArray::fromArray([1, 2, 3])));
        //Iterable
        self::assertFalse($instance->isAssocArray(new LimitIterator(new ArrayIterator([1, 2, 3]), 0, 3)));
    }

    public function test_isAssocArray_should_return_true_4_assoc_arrayable_entities()
    {
        $instance = new TestArrayContains([]);

        self::assertTrue($instance->isAssocArray([1 => 1]));
        self::assertTrue($instance->isAssocArray(["1" => "1", "2" => "2"]));
        self::assertTrue($instance->isAssocArray([1 => "1", 2 => "2"]));
        self::assertTrue($instance->isAssocArray(["1" => 1, "2" => 2, "3" => 3]));
        //ArrayAccess+Countable
        $array = new ArrayObject(["1" => 1, "2" => 2, "3" => 3]);
        self::assertTrue($instance->isAssocArray($array));
        //Iterable
        self::assertTrue($instance->isAssocArray($array->getIterator()));
    }

    public function test_toArray_should_return_array_4_ArrayObject()
    {
        $instance = new TestArrayContains([]);
        $value = new ArrayObject($instance);
        $result = $instance->toArray($value);
        self::assertIsArray($result);
    }

    public function test_toArray_should_return_array_4_Countable_ArrayAccess()
    {
        $instance = new TestArrayContains([]);
        $value = new class([1, 2, 3]) extends TestArrayAccess implements Countable {

            public function count(): int
            {
                return count($this->array);
            }
        };
        $result = $instance->toArray($value);
        self::assertIsArray($result);
    }

    public function test_toArray_should_return_array_4_Iterator()
    {
        $instance = new TestArrayContains([]);
        $value = new LimitIterator(new ArrayIterator([1, 2, 3]), 0, 3);
        $result = $instance->toArray($value);
        self::assertIsArray($result);
    }

    public function test_toArray_should_return_same_array_4_array()
    {
        $instance = new TestArrayContains([]);
        $value = [1, 2, 3];
        $result = $instance->toArray($value);
        self::assertSame($value, $result);
    }

    public function test_toArray_should_throw_exception_4_non_array_like_type()
    {
        $instance = new TestArrayContains([]);
        $value = "1,2,3";
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage('Not supported type');
        $instance->toArray($value);

    }
}
