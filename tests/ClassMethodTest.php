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
     * @throws \ReflectionException
     * @covers ::hydrate
     * @covers ::getValue
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

        $hydrator = new ClassMethod();

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

        $hydrator = new ClassMethod();
        $actual = $hydrator->extract($object);

        $expected = [];
        $expected['first_name'] = "Max";
        $expected['street_number_suffix'] = "a";
        $expected['email'] = "mail@example.com";
        $expected['phone'] = "123456";
        $expected['created_by'] = null;
        $expected['created_at'] = null;
        $expected['updated_by'] = null;
        $expected['updated_at'] = null;

        $this->assertEquals($expected, $actual);
    }

    /**
     * Test.
     *
     * @return void
     * @throws \ReflectionException
     * @covers ::hydrate
     * @covers ::getValue
     * @covers \Odan\Hydrator\StringUtil::snake
     */
    public function testHydrateSnakeCase()
    {
        $arr = [];
        $arr['first_name'] = "Max";
        $arr['street_number_suffix'] = "a";
        $arr['email'] = "mail@example.com";
        $arr['phone'] = "123456";
        $arr['not existing item'] = "test";
        $arr['created_by'] = 1;
        $arr['created_at'] = '2018-01-01 00:00:00';
        $arr['updated_by'] = 2;
        $arr['updated_at'] = '2018-02-01 00:00:00';

        $hydrator = new ClassMethod();

        $actual = $hydrator->hydrate($arr, new CamelCaseDto());
        $this->assertInstanceOf(CamelCaseDto::class, $actual);

        $expected = new CamelCaseDto();
        $expected->setFirstName('Max');
        $expected->setStreetNumberSuffix('a');
        $expected->setEmail('mail@example.com');
        $expected->setPhone('123456');
        $expected->setCreatedAt(new \DateTimeImmutable('2018-01-01 00:00:00'));
        $expected->setCreatedBy(1);
        $expected->setUpdatedAt(new \DateTime('2018-02-01 00:00:00'));
        $expected->setUpdatedBy(2);

        $this->assertEquals($expected, $actual);
    }
}
