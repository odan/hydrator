<?php

namespace Odan\Test;

use Odan\Hydrator\ClassMethod;

/**
 * @coversDefaultClass \Odan\Hydrator\ClassMethod
 */
class ClassMethodTest extends AbstractTest
{

    /**
     * Test.
     *
     * @return void
     * @covers ::hydrate
     * @covers ::__construct
     * @covers \Odan\Hydrator\StringUtil::camel
     */
    public function testHydrateCamelCase()
    {
        $arr = [];
        $arr['firstName'] = "Max";
        $arr['streetNumberSuffix'] = "a";
        $arr['email'] = "mail@example.com";
        $arr['phone'] = "123456";
        $arr['not existing item'] = "test";

        $hydrator = new ClassMethod(ClassMethod::CAMEL_CASE);

        $actual = $hydrator->hydrate($arr, new CamelCaseDto());
        $this->assertInstanceOf(CamelCaseDto::class, $actual);

        $expected = new CamelCaseDto();
        $expected->setFirstName('Max');
        $expected->setStreetNumberSuffix('a');
        $expected->setEmail('mail@example.com');
        $expected->setPhone('123456');

        $this->assertEquals($expected, $actual);
    }

    /**
     * Test.
     *
     * @return void
     * @covers ::hydrate
     * @covers \Odan\Hydrator\StringUtil::snake
     */
    public function testHydrateSnakeCase()
    {
        $arr = [];
        $arr['firstName'] = "Max";
        $arr['streetNumberSuffix'] = "a";
        $arr['email'] = "mail@example.com";
        $arr['phone'] = "123456";
        $arr['not existing item'] = "test";

        $hydrator = new ClassMethod(ClassMethod::SNAKE_CASE);

        $actual = $hydrator->hydrate($arr, new SnakeCaseDto());
        $this->assertInstanceOf(SnakeCaseDto::class, $actual);

        $expected = new SnakeCaseDto();
        $expected->set_first_name('Max');
        $expected->set_street_number_suffix('a');
        $expected->set_email('mail@example.com');
        $expected->set_phone('123456');

        $this->assertEquals($expected, $actual);
    }

    /**
     * Test
     *
     * @return void
     * @covers ::extract
     */
    public function testExtractCamelCase()
    {
        $object = new CamelCaseDto();
        $object->setFirstName('Max');
        $object->setStreetNumberSuffix('a');
        $object->setEmail('mail@example.com');
        $object->setPhone('123456');

        $hydrator = new ClassMethod(ClassMethod::CAMEL_CASE);
        $actual = $hydrator->extract($object);

        $expected = [];
        $expected['firstName'] = "Max";
        $expected['streetNumberSuffix'] = "a";
        $expected['email'] = "mail@example.com";
        $expected['phone'] = "123456";

        $this->assertEquals($expected, $actual);
    }

    /**
     * Test
     *
     * @return void
     * @covers ::extract
     */
    public function testExtractSnakeCase()
    {
        $object = new CamelCaseDto();
        $object->setFirstName('Max');
        $object->setStreetNumberSuffix('a');
        $object->setEmail('mail@example.com');
        $object->setPhone('123456');

        $hydrator = new ClassMethod(ClassMethod::SNAKE_CASE);
        $actual = $hydrator->extract($object);

        $expected = [];
        $expected['first_name'] = "Max";
        $expected['street_number_suffix'] = "a";
        $expected['email'] = "mail@example.com";
        $expected['phone'] = "123456";

        $this->assertEquals($expected, $actual);
    }
}
