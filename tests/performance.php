<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Odan\Hydrator\ClassMethod;

$arr = [];
$arr['firstName'] = "Max";
$arr['streetNumberSuffix'] = "a";
$arr['email'] = "mail@example.com";
$arr['phone'] = "123456";
$arr['not existing item'] = "test";

// User entity
class User
{
    public $id;
    public $username;
    public $firstName;
    public $email;
}

// User row (from database)
$userRow = [
    'id' => 1,
    'username' => 'admin',
    'first_name' => 'John Doe',
    'email' => 'john@exmaple.com'
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
    [email] => john@exmaple.com
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
    [firstName] => John Doe
    [email] => john@exmaple.com
)
*/

exit;

$start = microtime(true);

for ($i = 0; $i < 10000; $i++) {
    $hydrator = new ClassMethod(ClassMethod::CAMEL_CASE);
    $object = $hydrator->hydrate($arr, new \Odan\Test\CamelCaseDto());
    $hydrator->extract($object);

    $hydrator = new ClassMethod(ClassMethod::SNAKE_CASE);
    $object = $hydrator->hydrate($arr, new \Odan\Test\SnakeCaseDto());
    $hydrator->extract($object);

    $hydrator = new \Odan\Hydrator\ObjectProperty(ClassMethod::CAMEL_CASE);
    $object = $hydrator->hydrate($arr, new \Odan\Test\CamelCasePoco());
    $hydrator->extract($object);

    $hydrator = new \Odan\Hydrator\ObjectProperty(ClassMethod::SNAKE_CASE);
    $object = $hydrator->hydrate($arr, new \Odan\Test\SnakeCasePoco());
    $hydrator->extract($object);
}

$end = microtime(true);
echo "Time: " . ($end - $start) . "\n";
echo "Memory: " . memory_get_peak_usage(true) . "\n";

