# Release Notes for Algolia

## 4.0.0 - 2022-07-05

### Added
* Support for Craft 4

## 3.1.0 - 2022-02-11

### Changed
* Algolia PHP SDK updated to 3.2
* PHP 7.3+ required
* Craft 3.5+ required
* Swapped tightenco/collect with illuminate/collections

## 3.0.1 - 2021-06-29

### Fixed
* Coerce filters with boolean values to a string value of `"true"` or `"false"` to cooperate with Algolia syntax engine

## 3.0.0 - 2021-06-29

### Added
* Helper to convert an object of filters into the stringified Algolia syntax for filtered searches

### Changed
* Algolia PHP SDK updated to 3.x
* PHP 7.1+ required
* Craft 3.1.19+ required

## 2.0.0 - 2019-03-15

Initial Craft 3 release
