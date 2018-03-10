<?php

namespace Odan\Hydrator;

/**
 * Any data key matching a publicly accessible property will be hydrated;
 * any public properties will be used for extraction.
 */
class ObjectProperty implements HydratorInterface
{
    /**
     * Hydrate $object with the provided $data.
     *
     * Naming strategy: Converts properties to camelCase (e.g. fooBarBaz).
     *
     * @param array $data
     * @param object $object
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        $properties = get_class_vars(get_class($object));
        foreach ($data as $name => $value) {
            $property = StringUtil::camel($name);
            if (isset($properties[$property]) || array_key_exists($property, $properties)) {
                $object->{$property} = $value;
            }
        }

        return $object;
    }

    /**
     * Extract values from an object
     *
     * Naming strategy: Converts array keys to snake_case.
     *
     * @param object $object
     * @return array
     */
    public function extract($object)
    {
        $array = array();
        $properties = get_class_vars(get_class($object));
        foreach ($properties as $property => $value) {
            $key = StringUtil::snake($property);
            $array[$key] = $object->{$property};
        }

        return $array;
    }
}
