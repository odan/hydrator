<?php

namespace Odan\Test;

use Odan\Hydrator\ObjectProperty;

/**
 * @coversDefaultClass \Odan\Hydrator\ObjectProperty
 */
class ObjectPropertyTest extends AbstractTest
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

        $hydrator = new ObjectProperty(ObjectProperty::CAMEL_CASE);

        $actual = $hydrator->hydrate($arr, new CamelCasePoco());
        $this->assertInstanceOf(CamelCasePoco::class, $actual);

        $expected = new CamelCasePoco();
        $expected->firstName = 'Max';
        $expected->streetNumberSuffix = 'a';
        $expected->email = 'mail@example.com';
        $expected->phone = '123456';

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

        $hydrator = new ObjectProperty(ObjectProperty::SNAKE_CASE);

        $actual = $hydrator->hydrate($arr, new SnakeCasePoco());
        $this->assertInstanceOf(SnakeCasePoco::class, $actual);

        $expected = new SnakeCasePoco();
        $expected->first_name = 'Max';
        $expected->street_number_suffix = 'a';
        $expected->email = 'mail@example.com';
        $expected->phone = '123456';

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
        $object = new SnakeCasePoco();
        $object->first_name = 'Max';
        $object->street_number_suffix = 'a';
        $object->email = 'mail@example.com';
        $object->phone = '123456';

        $hydrator = new ObjectProperty(ObjectProperty::CAMEL_CASE);
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
        $object = new SnakeCasePoco();
        $object->first_name = 'Max';
        $object->street_number_suffix = 'a';
        $object->email = 'mail@example.com';
        $object->phone = '123456';

        $hydrator = new ObjectProperty(ObjectProperty::SNAKE_CASE);
        $actual = $hydrator->extract($object);

        $expected = [];
        $expected['first_name'] = "Max";
        $expected['street_number_suffix'] = "a";
        $expected['email'] = "mail@example.com";
        $expected['phone'] = "123456";

        $this->assertEquals($expected, $actual);
    }
}
