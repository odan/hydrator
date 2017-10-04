<?php

namespace Odan\Test;

require_once __DIR__ . '/../vendor/autoload.php';

use Odan\Hydrator\ObjectProperty;

$arr = [];
$arr['firstName'] = "Adam";
$arr['phone'] = "123456";
$arr['email'] = "adam@mail.com";
$arr['address'] = "U.S";

$hydrator = new ObjectProperty();

$obj = $hydrator->hydrate($arr, new ExamplePoco());
var_dump($obj);

$hydrator2 = new ObjectProperty(ObjectProperty::SNAKE_CASE);
print_r($hydrator2->extract($obj));


