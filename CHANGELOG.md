# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [13.0.0] - 2026-08-09

### Added
- Support for PHPUnit 13 on PHP 8.4 and 8.5.

## [12.0.0] - 2026-08-08

### Added
- Support for PHPUnit 12 on PHP 8.3, 8.4, and 8.5.
- Dedicated `PHPUnit_11` branch for PHPUnit 11 maintenance.

### Changed
- Require PHP 8.3 or higher.
- Update test suite constraints and helper methods for PHPUnit 12 compatibility.
- Update XML schema configuration for PHPUnit 12.

## [11.0.0] - 2026-08-08

### Added
- Support for PHP 8.4 and PHP 8.5 in test matrix.
- Reusable GitHub Actions test workflow (`.github/workflows/tests.yml`).
- Main CI workflow (`.github/workflows/main.yml`) and Release workflow (`.github/workflows/release.yml`).
- Dependabot configuration (`.github/dependabot.yml`) for Composer and GitHub Actions updates.

### Removed
- Legacy separate GitHub Actions workflows (`php.yml`, `phpunit_8.yml`, `phpunit_9.yml`).

## [10.0.5] - 2025-01-30

### Added
- Support for PHPUnit 11.

## [10.0.4] - 2023-09-08

### Fixed
- Internal improvements and bug fixes.

## [10.0.3] - 2023-09-08

### Fixed
- Test suite stability improvements.

## [10.0.2] - 2023-09-07

### Fixed
- Minor fixes in PHPUnit 10 constraint evaluations.

## [10.0.1] - 2023-09-07

### Fixed
- Code adaptation for PHPUnit 10 and PHP 8.

## [10.0.0] - 2023-09-06

### Added
- Support for PHPUnit 10.
- Initial release for PHPUnit 10 baseline.

## [9.0.3] - 2025-03-04

### Changed
- Support PHP >= 7.3 for PHPUnit 9 branch.

## [9.0.2] - 2023-09-08

### Changed
- Extract code coverage execution into a dedicated script in `composer.json`.

## [9.0.0] - 2023-09-06

### Added
- Initial release for PHPUnit 9 branch.

## [8.0.5] - 2023-09-09

### Fixed
- Final release build for PHPUnit 8 branch.

## [8.0.0] - 2023-09-05

### Added
- Initial release of PHPUnit arrayContains asserts for PHPUnit 8.
