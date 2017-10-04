<?php

namespace Odan\Hydrator;

/**
 * Any data key matching a publicly accessible property will be hydrated;
 * any public properties will be used for extraction.
 */
class ObjectProperty implements HydratorInterface
{

    /**
     * Camel case
     */
    const CAMEL_CASE = 1;

    /**
     * Snake case
     */
    const SNAKE_CASE = 2;

    /**
     * @var int
     */
    protected $case;

    /**
     * ClassMethod constructor.
     *
     * @param int $case
     */
    public function __construct($case = self::CAMEL_CASE)
    {
        $this->case = $case;
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param array $data
     * @param object $object
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        $properties = get_class_vars(get_class($object));
        foreach ($data as $name => $value) {
            if ($this->case === self::SNAKE_CASE) {
                $property = StringUtil::snake($name);
            } else {
                $property = StringUtil::camel($name);
            }
            if (array_key_exists($property, $properties)) {
                $object->{$property} = $value;
            }
        }
        return $object;
    }

    /**
     * Extract values from an object
     *
     * @param object $object
     * @return array
     */
    public function extract($object)
    {
        $array = array();
        $properties = get_class_vars(get_class($object));
        foreach ($properties as $property => $value) {
            if ($this->case === self::SNAKE_CASE) {
                $key = StringUtil::snake($property);
            } else {
                $key = StringUtil::camel($property);
            }
            $array[$key] = $object->{$property};
        }
        return $array;
    }
}
