<?php

namespace Odan\Hydrator;

use DateTime;
use DateTimeImmutable;
use ReflectionException;
use ReflectionParameter;

/**
 * Any data key matching a setter method will be called in order to hydrate;
 * any method matching a getter method will be called for extraction.
 */
class ClassMethod implements HydratorInterface
{

    /**
     * Hydrate $object with the provided $data.
     *
     * Naming strategy:
     *
     * Naming strategy: Call camelCase setter methods (getFooBarBaz)
     *
     * @param array $data
     * @param object $object
     * @return object
     * @throws ReflectionException
     */
    public function hydrate(array $data, $object)
    {
        $methods = array_flip(get_class_methods(get_class($object)));
        $class = get_class($object);

        foreach ($data as $key => $value) {
            $method = StringUtil::camel('set_' . $key);

            if (!isset($methods[$method])) {
                continue;
            }

            $object->$method($this->getValue($class, $method, $value));
        }

        return $object;
    }

    /**
     * Get value.
     *
     * @param string $class The class name
     * @param string $method The method name
     * @param mixed $value The default value
     * @return mixed|DateTime|DateTimeImmutable The value
     * @throws ReflectionException
     */
    private function getValue(string $class, string $method, $value)
    {
        $parameter = new ReflectionParameter(array($class, $method), 0);
        $type = $parameter->getType();

        if ($type) {
            $dataType = $type->getName();
            if ($dataType === 'DateTimeImmutable') {
                $value = new DateTimeImmutable($value);
            }
            if ($dataType === 'DateTime') {
                $value = new DateTime($value);
            }
        }

        return $value;
    }

    /**
     * Extract values from an object
     *
     * Naming strategy: Converts array keys to snake_case.
     *
     * @param  object $object
     * @return array
     */
    public function extract($object)
    {
        $array = array();
        $methods = get_class_methods(get_class($object));

        foreach ($methods as $method) {
            preg_match(' /^(get)(.*?)$/i', $method, $matches);
            if (!isset($matches[2])) {
                continue;
            }
            $key = StringUtil::snake($matches[2]);
            $array[$key] = $object->$method();
        }

        return $array;
    }
}
