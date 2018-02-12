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

        $hydrator = new ObjectProperty();

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
     * @covers \Odan\Hydrator\StringUtil::camel
     */
    public function testHydrateSnakeCase()
    {
        $arr = [];
        $arr['first_name'] = "Max";
        $arr['street_number_suffix'] = "a";
        $arr['email'] = "mail@example.com";
        $arr['phone'] = "123456";
        $arr['not existing item'] = "test";

        $hydrator = new ObjectProperty();

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

        $hydrator = new ObjectProperty();
        $actual = $hydrator->extract($object);

        $expected = [];
        $expected['first_name'] = "Max";
        $expected['street_number_suffix'] = "a";
        $expected['email'] = "mail@example.com";
        $expected['phone'] = "123456";

        $this->assertEquals($expected, $actual);
    }

    /**
     * Test
     *
     * @return void
     * @covers ::extract
     * @covers \Odan\Hydrator\StringUtil::snake
     */
    public function testExtractCamelCase()
    {
        $object = new CamelCasePoco();
        $object->firstName = 'Max';
        $object->streetNumberSuffix = 'a';
        $object->email = 'mail@example.com';
        $object->phone = '123456';

        $hydrator = new ObjectProperty();
        $actual = $hydrator->extract($object);

        $expected = [];
        $expected['first_name'] = "Max";
        $expected['street_number_suffix'] = "a";
        $expected['email'] = "mail@example.com";
        $expected['phone'] = "123456";

        $this->assertEquals($expected, $actual);
    }
}
