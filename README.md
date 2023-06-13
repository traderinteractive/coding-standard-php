# DWS Coding Standard
[![Latest Stable Version](https://poser.pugx.org/traderinteractive/coding-standard/v/stable)](https://packagist.org/packages/traderinteractive/coding-standard)
[![Latest Unstable Version](https://poser.pugx.org/traderinteractive/coding-standard/v/unstable)](https://packagist.org/packages/traderinteractive/coding-standard)
[![License](https://poser.pugx.org/traderinteractive/coding-standard/license)](https://packagist.org/packages/traderinteractive/coding-standard)

[![Total Downloads](https://poser.pugx.org/traderinteractive/coding-standard/downloads)](https://packagist.org/packages/traderinteractive/coding-standard)
[![Daily Downloads](https://poser.pugx.org/traderinteractive/coding-standard/d/daily)](https://packagist.org/packages/traderinteractive/coding-standard)
[![Monthly Downloads](https://poser.pugx.org/traderinteractive/coding-standard/d/monthly)](https://packagist.org/packages/traderinteractive/coding-standard)

A fairly complete [PHP_CodeSniffer](http://www.squizlabs.com/php-codesniffer) coding standard.  See the [standard document](standard.md) to
see what "sniffs" are enforced.

## Composer

This standard is meant to be used in a project using [Composer](http://getcomposer.org).  It can be added to your project's composer.json as follows:

```sh
composer require traderinteractive/coding-standard
```

Then to use it, you can run the following (or add to your build process):

```bash
./vendor/bin/phpcs --standard=$(pwd)/vendor/traderinteractive/coding-standard/DWS YOUR_FILES_AND_DIRECTORIES
```

## Contact

Developers may be contacted at:

 * [Pull Requests](https://github.com/traderinteractive/coding-standard-php/pulls)
 * [Issues](https://github.com/traderinteractive/coding-standard-php/issues)

## Tests

Tests for the sniffs are included, and are run using the included build:

```bash
./vendor/bin/phpunit
```
