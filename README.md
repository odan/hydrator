# Hydrator

A high performance hydrator for PHP.

[![Latest Version on Packagist](https://img.shields.io/github/release/odan/hydrator.svg)](https://github.com/odan/hydrator/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE)
[![Build Status](https://travis-ci.org/odan/hydrator.svg?branch=master)](https://travis-ci.org/odan/hydrator)
[![Coverage Status](https://scrutinizer-ci.com/g/odan/hydrator/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/odan/hydrator/code-structure)
[![Quality Score](https://scrutinizer-ci.com/g/odan/hydrator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/odan/hydrator/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/odan/hydrator.svg)](https://packagist.org/packages/odan/hydrator)

## Requirements

* PHP >= 7.1

## Installation

```shell
composer require odan/hydrator
```

## Features

* Array to Object
* Object to Array

### ObjectProperty

Any data key matching a publicly accessible property will be hydrated;
any public properties will be used for extraction.

### ClassMethod
 
Any data key matching a setter method will be called in order to hydrate;
any method matching a getter method will be called for extraction.

## Usage

```php
// User entity
class User
{
    public $id;
    public $username;
    public $firstName;
    public $email;
}

// A row from the database
$userRow = [
    'id' => 1,
    'username' => 'admin',
    'first_name' => 'John Doe',
    'email' => 'john@example.com'
];

// Create the hydrator
$hydrator = new \Odan\Hydrator\ObjectProperty();

// Convert array to a new User object (with lower camel case properties)
$user = $hydrator->hydrate($userRow, new User());

print_r($user);

/*
User Object
(
    [id] => 1
    [username] => admin
    [firstName] => John Doe
    [email] => john@example.com
)
*/

// Convert User object to an array with lower camel case keys
$array = $hydrator->extract($user);

print_r($array);

/*
Array
(
    [id] => 1
    [username] => admin
    [first_name] => John Doe
    [email] => john@example.com
)
*/
```

## Alternatives

* https://github.com/zendframework/zend-hydrator
* https://github.com/doctrine/DoctrineModule/blob/master/docs/hydrator.md
* https://github.com/mark-gerarts/automapper-plus

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.


[PSR-1]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
[PSR-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[PSR-4]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md
[Composer]: http://getcomposer.org/
[PHPUnit]: http://phpunit.de/
