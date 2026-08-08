# PHPUnit arrayContains asserts

[![Total Downloads](https://poser.pugx.org/alezhu/phpunit-array-contains-asserts/downloads)](https://packagist.org/packages/alezhu/phpunit-array-contains-asserts)
[![License](https://poser.pugx.org/alezhu/phpunit-array-contains-asserts/license)](https://packagist.org/packages/alezhu/phpunit-array-contains-asserts)

Provides PHPUnit assertions to test when array-like data contains expected data with expected structure.

### Supported PHPUnit Versions & Status

| PHPUnit Version | Latest Package Release | Build Status | Coverage | PHP Version |
| :--- | :--- | :--- | :--- | :--- |
| **PHPUnit 11** | [![PHPUnit 11 Tag](https://img.shields.io/github/v/tag/alezhu/phpunit-array-contains-asserts?filter=11.*&label=v11)](https://github.com/alezhu/phpunit-array-contains-asserts/releases/tag/11.0.0) | [![PHPUnit 11 Build Status](https://img.shields.io/github/actions/workflow/status/alezhu/phpunit-array-contains-asserts/main.yml?branch=main&label=Build)](https://github.com/alezhu/phpunit-array-contains-asserts/actions/workflows/main.yml) | [![Coverage Status](https://coveralls.io/repos/github/alezhu/phpunit-array-contains-asserts/badge.svg?branch=main)](https://coveralls.io/github/alezhu/phpunit-array-contains-asserts?branch=main) | ![PHP >= 8.2](https://img.shields.io/badge/PHP-%3E%3D%208.2-8892BF) |
| **PHPUnit 10** | [![PHPUnit 10 Tag](https://img.shields.io/github/v/tag/alezhu/phpunit-array-contains-asserts?filter=10.*&label=v10)](https://github.com/alezhu/phpunit-array-contains-asserts/releases/tag/10.0.5) | [![PHPUnit 10 Build Status](https://img.shields.io/github/actions/workflow/status/alezhu/phpunit-array-contains-asserts/main.yml?branch=main&label=Build)](https://github.com/alezhu/phpunit-array-contains-asserts/actions/workflows/main.yml) | [![Coverage Status](https://coveralls.io/repos/github/alezhu/phpunit-array-contains-asserts/badge.svg?branch=main)](https://coveralls.io/github/alezhu/phpunit-array-contains-asserts?branch=main) | ![PHP >= 8.1](https://img.shields.io/badge/PHP-%3E%3D%208.1-8892BF) |

> [!NOTE]
> For older PHPUnit versions, please use the corresponding branch:
> - For **PHPUnit 9**: Use the [PHPUnit_9 branch](https://github.com/alezhu/phpunit-array-contains-asserts/tree/PHPUnit_9).
> - For **PHPUnit 8**: Use the [PHPUnit_8 branch](https://github.com/alezhu/phpunit-array-contains-asserts/tree/PHPUnit_8).

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
  static [class
  `Alezhu\PHPUnitArrayContainsAsserts\Assert`](https://github.com/alezhu/phpunit-array-contains-asserts/blob/main/src/Assert.php)
- By using
  the [trait
  `Alezhu\PHPUnitArrayContainsAsserts\ArrayContainsTrait`](https://github.com/alezhu/phpunit-array-contains-asserts/blob/main/src/ArrayContainsTrait.php)
  in your test case
- By creating
  new [constraint instances](https://github.com/alezhu/phpunit-array-contains-asserts/tree/main/src/Constraint) (
  `Alezhu\PHPUnitArrayContainsAsserts\Constraint\…`)

All options do the same, the only difference is that the static class and trait both
throw [class
`Alezhu\PHPUnitArrayContainsAsserts\Exception\InvalidArgumentTypeException`](https://github.com/alezhu/phpunit-array-contains-asserts/blob/main/src/Exception/InvalidArgumentTypeException.php) (
or `PHPUnit\Framework\InvalidArgumentException` for PHPUnit 9 and 8) exceptions for
invalid parameters.
Creating new constraint instances is useful for advanced assertions, e.g. together
with `PHPUnit\Framework\Constraint\LogicalAnd`.

### Constraint `ArrayContains`

The [
`ArrayContains` constraint](https://github.com/alezhu/phpunit-array-contains-asserts/blob/main/src/Constraint/ArrayContains.php)
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

The [
`ArrayContainsOnly` constraint](https://github.com/alezhu/phpunit-array-contains-asserts/blob/main/src/Constraint/ArrayContainsOnly.php)
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
