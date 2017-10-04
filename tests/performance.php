<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Odan\Hydrator\ClassMethod;

$arr = [];
$arr['firstName'] = "Max";
$arr['streetNumberSuffix'] = "a";
$arr['email'] = "mail@example.com";
$arr['phone'] = "123456";
$arr['not existing item'] = "test";

$hydrator = new ClassMethod(ClassMethod::CAMEL_CASE);

$start = microtime(true);

for ($i = 0; $i < 100000; $i++) {
    $hydrator->hydrate($arr, new \Odan\Test\CamelCaseDto());
}

$end = microtime(true);
echo "Time: " . ($end - $start) . "\n";
echo "Memory: " . memory_get_peak_usage(true) . "\n";

