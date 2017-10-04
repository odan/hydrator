# Hydrator
 
[![Latest Version on Packagist](https://img.shields.io/github/release/odan/hydrator.svg)](https://github.com/odan/hydrator/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE.md)
[![Build Status](https://travis-ci.org/odan/hydrator.svg?branch=master)](https://travis-ci.org/odan/hydrator)
[![Coverage Status](https://scrutinizer-ci.com/g/odan/hydrator/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/odan/hydrator/code-structure)
[![Quality Score](https://scrutinizer-ci.com/g/odan/hydrator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/odan/hydrator/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/odan/hydrator.svg)](https://packagist.org/packages/odan/hydrator)


## Features

### ObjectProperty

Any data key matching a publicly accessible property will be hydrated;
any public properties will be used for extraction.

### ClassMethod
 
Any data key matching a setter method will be called in order to hydrate;
any method matching a getter method will be called for extraction.

## Installation

```shell
composer require odan/hydrator
```

## Requirements

* PHP 7.x
* MySQL


## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.


[PSR-1]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
[PSR-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[PSR-4]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md
[Composer]: http://getcomposer.org/
[PHPUnit]: http://phpunit.de/
