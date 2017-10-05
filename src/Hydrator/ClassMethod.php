<?php

namespace Odan\Hydrator;

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
     */
    public function hydrate(array $data, $object)
    {
        $methods = array_flip(get_class_methods(get_class($object)));
        foreach ($data as $key => $value) {
            $method = StringUtil::camel('set_' . $key);
            if (isset($methods[$method])) {
                $object->$method($value);
            }
        }
        return $object;
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
