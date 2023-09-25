# PHPUnit arrayContains asserts

[![Latest Stable Version](http://poser.pugx.org/alezhu/phpunit-array-contains-asserts/v)](https://packagist.org/packages/alezhu/phpunit-array-contains-asserts)
[![Total Downloads](http://poser.pugx.org/alezhu/phpunit-array-contains-asserts/downloads)](https://packagist.org/packages/alezhu/phpunit-array-contains-asserts)
[![License](http://poser.pugx.org/alezhu/phpunit-array-contains-asserts/license)](https://packagist.org/packages/alezhu/phpunit-array-contains-asserts)
[![PHP Version Require](http://poser.pugx.org/alezhu/phpunit-array-contains-asserts/require/php)](https://packagist.org/packages/alezhu/phpunit-array-contains-asserts)

Provides PHPUnit assertions to test then array-like data contains expected data with expected structure.

This PHPUnit extension was written for PHPUnit 10, but also has branches for PHPUnit 8 and PHPUnit 9 . If it doesn't
work properly, please don't hesitate to open
a [new Issue on GitHub](https://github.com/alezhu/phpunit-array-contains-asserts/issues), or, even better, create a Pull
Request with a proposed fix .

**Table of contents:**

1. [Install](#install)
2. [Usage](#usage)
    1. [Constraint `ArrayContains`](#constraint-ArrayContains)
    2. [Constraint `ArrayContainsOnly`](#constraint-ArrayContainsOnly)

Install
-------

`PHPUnit arrayContains asserts` is available
on [Packagist.org](https://packagist.org/packages/alezhu/phpunit-array-contains-asserts) and can be installed
using [Composer](https://getcomposer.org/):

```shell
composer require --dev alezhu/phpunit-array-contains-asserts
```

Usage
-----

There are three (basically equivalent) options to use `PHPUnitArrayAssertions`:

- By using the
  static [class `Alezhu\PHPUnitArrayContainsAsserts\Assert`](https://github.com/alezhu/phpunit-array-contains-asserts/blob/main/src/Assert.php)
- By using
  the [trait `Alezhu\PHPUnitArrayContainsAsserts\ArrayContainsTrait`](https://github.com/alezhu/phpunit-array-contains-asserts/blob/main/src/ArrayContainsTrait.php)
  in your test case
- By creating
  new [constraint instances](https://github.com/alezhu/phpunit-array-contains-asserts/tree/main/src/Constraint) (`Alezhu\PHPUnitArrayContainsAsserts\Constraint\…`)

All options do the same, the only difference is that the static class and trait both
throw [class `Alezhu\PHPUnitArrayContainsAsserts\Exception\InvalidArgumentTypeException`](https://github.com/alezhu/phpunit-array-contains-asserts/blob/main/src/Exception/InvalidArgumentTypeException.php) (
or `PHPUnit\Framework\InvalidArgumentException` for PHPUnit 9 and 8) exceptions for
invalid parameters.
Creating new constraint instances is useful for advanced assertions, e.g. together
with `PHPUnit\Framework\Constraint\LogicalAnd`.

### Constraint `ArrayContains`

The [`ArrayContains` constraint](https://github.com/alezhu/phpunit-array-contains-asserts/blob/main/src/Constraint/ArrayContains.php)
asserts that an array contains all expected values (for non-associative arrays) or all expected keys with expected
values (for associative arrays).

Expected values can be set directly or via another PHPUnit constraints (`PHPUnit\Framework\Constraint\...`).

Expected and actual data can be array or iterator or inherit ArrayObject or implements ArrayAccess+Countable interfaces.

Expected and actual data must have same associative kind.

**Usage:**

```php
use Alezhu\PHPUnitArrayContainsAsserts\Assert;
use PHPUnit\Framework\Constraint\IsType;

//Passed
Assert::assertArrayContains(
    [
        "foo" => new isType(IsType::TYPE_STRING), 
        "baz" => 1
    ], 
    [
        "foo" => "value",
        "bar" => true, 
        "baz" => 1
    ]
); 
//Not Passed
Assert::assertArrayContains(
    [
        "foo" => new isType(IsType::TYPE_STRING), 
        "baz" => 1
    ], 
    [
        "foo" => "bar", 
    ]
); 
```

### Constraint `ArrayContainsOnly`

The [`ArrayContainsOnly` constraint](https://github.com/alezhu/phpunit-array-contains-asserts/blob/main/src/Constraint/ArrayContainsOnly.php)
asserts that an array contains **only** all expected values (for non-associative arrays) or ***only*** all expected keys
with expected values (for associative arrays).

Expected values can be set directly or via another PHPUnit constraints (`PHPUnit\Framework\Constraint\...`).

Expected and actual data can be array or iterator or inherit ArrayObject or implements ArrayAccess+Countable interfaces.

Expected and actual data must have same associative kind.

**Usage:**

```php
use Alezhu\PHPUnitArrayContainsAsserts\Assert;
use PHPUnit\Framework\Constraint\IsType;

//Passed
Assert::assertArrayContainsOnly(
    [
        "foo" => new isType(IsType::TYPE_STRING), 
        "baz" => 1
    ], 
    [
        "foo" => "value",
        "baz" => 1
    ]
); 
//Not Passed
Assert::assertArrayContainsOnly(
    [
        "foo" => new isType(IsType::TYPE_STRING), 
        "baz" => 1
    ], 
    [
        "foo" => "bar",
        "bar" => true, 
        "baz" => 1         
    ]
); 
```
