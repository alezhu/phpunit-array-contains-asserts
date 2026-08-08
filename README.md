# PHPUnit arrayContains asserts

[![Total Downloads](https://poser.pugx.org/alezhu/phpunit-array-contains-asserts/downloads)](https://packagist.org/packages/alezhu/phpunit-array-contains-asserts)
[![License](https://poser.pugx.org/alezhu/phpunit-array-contains-asserts/license)](https://packagist.org/packages/alezhu/phpunit-array-contains-asserts)

Provides PHPUnit assertions to test when array-like data contains expected data with expected structure.

### Supported PHPUnit Versions & Status

| PHPUnit Version | Latest Package Release | Build Status | Coverage | PHP Version |
| :--- | :--- | :--- | :--- | :--- |
| **PHPUnit 11** | [![PHPUnit 11 Tag](https://img.shields.io/github/v/tag/alezhu/phpunit-array-contains-asserts?filter=11.*&label=v11)](https://github.com/alezhu/phpunit-array-contains-asserts/releases/tag/11.0.0) | [![PHPUnit 11 Build Status](https://img.shields.io/github/actions/workflow/status/alezhu/phpunit-array-contains-asserts/main.yml?branch=main&label=Build)](https://github.com/alezhu/phpunit-array-contains-asserts/actions/workflows/main.yml) | [![Coverage Status](https://coveralls.io/repos/github/alezhu/phpunit-array-contains-asserts/badge.svg?branch=main)](https://coveralls.io/github/alezhu/phpunit-array-contains-asserts?branch=main) | ![PHP >= 8.2](https://img.shields.io/badge/PHP-%3E%3D%208.2-8892BF) |
| **PHPUnit 10** | [![PHPUnit 10 Tag](https://img.shields.io/github/v/tag/alezhu/phpunit-array-contains-asserts?filter=10.*&label=v10)](https://github.com/alezhu/phpunit-array-contains-asserts/releases/tag/10.0.5) | [![PHPUnit 10 Build Status](https://img.shields.io/github/actions/workflow/status/alezhu/phpunit-array-contains-asserts/main.yml?branch=main&label=Build)](https://github.com/alezhu/phpunit-array-contains-asserts/actions/workflows/main.yml) | [![Coverage Status](https://coveralls.io/repos/github/alezhu/phpunit-array-contains-asserts/badge.svg?branch=main)](https://coveralls.io/github/alezhu/phpunit-array-contains-asserts?branch=main) | ![PHP >= 8.1](https://img.shields.io/badge/PHP-%3E%3D%208.1-8892BF) |
| **PHPUnit 9** | [![PHPUnit 9 Tag](https://img.shields.io/github/v/tag/alezhu/phpunit-array-contains-asserts?filter=9.*&label=v9)](https://github.com/alezhu/phpunit-array-contains-asserts/releases/tag/9.0.4) | [![PHPUnit 9 Build Status](https://img.shields.io/github/actions/workflow/status/alezhu/phpunit-array-contains-asserts/main.yml?branch=PHPUnit_9&label=Build)](https://github.com/alezhu/phpunit-array-contains-asserts/actions/workflows/main.yml) | [![Coverage Status](https://coveralls.io/repos/github/alezhu/phpunit-array-contains-asserts/badge.svg?branch=PHPUnit_9)](https://coveralls.io/github/alezhu/phpunit-array-contains-asserts?branch=PHPUnit_9) | ![PHP >= 7.3](https://img.shields.io/badge/PHP-%3E%3D%207.3-8892BF) |
| **PHPUnit 8** | [![PHPUnit 8 Tag](https://img.shields.io/github/v/tag/alezhu/phpunit-array-contains-asserts?filter=8.*&label=v8)](https://github.com/alezhu/phpunit-array-contains-asserts/releases/tag/8.0.6) | [![PHPUnit 8 Build Status](https://img.shields.io/github/actions/workflow/status/alezhu/phpunit-array-contains-asserts/main.yml?branch=PHPUnit_8&label=Build)](https://github.com/alezhu/phpunit-array-contains-asserts/actions/workflows/main.yml) | [![Coverage Status](https://coveralls.io/repos/github/alezhu/phpunit-array-contains-asserts/badge.svg?branch=PHPUnit_8)](https://coveralls.io/github/alezhu/phpunit-array-contains-asserts?branch=PHPUnit_8) | ![PHP >= 7.2](https://img.shields.io/badge/PHP-%3E%3D%207.2-8892BF) |

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
  `Alezhu\PHPUnitArrayContainsAsserts\Assert`](https://github.com/alezhu/phpunit-array-contains-asserts/blob/PHPUnit_8/src/Assert.php)
- By using
  the [trait
  `Alezhu\PHPUnitArrayContainsAsserts\ArrayContainsTrait`](https://github.com/alezhu/phpunit-array-contains-asserts/blob/PHPUnit_8/src/ArrayContainsTrait.php)
  in your test case
- By creating
  new [constraint instances](https://github.com/alezhu/phpunit-array-contains-asserts/tree/PHPUnit_8/src/Constraint) (
  `Alezhu\PHPUnitArrayContainsAsserts\Constraint\…`)

All options do the same, the only difference is that the static class and trait both
throw [class
`Alezhu\PHPUnitArrayContainsAsserts\Exception\InvalidArgumentTypeException`](https://github.com/alezhu/phpunit-array-contains-asserts/blob/PHPUnit_8/src/Exception/InvalidArgumentTypeException.php) (
or `PHPUnit\Framework\InvalidArgumentException` for PHPUnit 9 and 8) exceptions for
invalid parameters.
Creating new constraint instances is useful for advanced assertions, e.g. together
with `PHPUnit\Framework\Constraint\LogicalAnd`.

### Constraint `ArrayContains`

The [
`ArrayContains` constraint](https://github.com/alezhu/phpunit-array-contains-asserts/blob/PHPUnit_8/src/Constraint/ArrayContains.php)
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
`ArrayContainsOnly` constraint](https://github.com/alezhu/phpunit-array-contains-asserts/blob/PHPUnit_8/src/Constraint/ArrayContainsOnly.php)
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
