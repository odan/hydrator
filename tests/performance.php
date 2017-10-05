<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Odan\Hydrator\ClassMethod;

$arr = [];
$arr['firstName'] = "Max";
$arr['streetNumberSuffix'] = "a";
$arr['email'] = "mail@example.com";
$arr['phone'] = "123456";
$arr['not existing item'] = "test";

$start = microtime(true);

for ($i = 0; $i < 10000; $i++) {
    $hydrator = new ClassMethod(ClassMethod::CAMEL_CASE);
    $object = $hydrator->hydrate($arr, new \Odan\Test\CamelCaseDto());
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

