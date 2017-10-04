<?php

namespace Odan\Hydrator;

/**
 * Any data key matching a setter method will be called in order to hydrate;
 * any method matching a getter method will be called for extraction.
 */
class ClassMethod implements HydratorInterface {

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
	public function __construct($case = self::SNAKE_CASE) {
		$this->case = $case;
	}

	/**
	 * Hydrate $object with the provided $data.
	 *
	 * @param array $data
	 * @param object $object
	 * @return object
	 */
	public function hydrate(array $data, $object) {
		$methods = array_flip(get_class_methods(get_class($object)));
		foreach ($data as $key => $value) {
			if ($this->case === self::SNAKE_CASE) {
				$method = StringUtil::snake('set_' . $key);
			} else {
				$method = StringUtil::camel('set_' . $key);
			}
			if (isset($methods[$method])) {
				$object->$method($value);
			}
		}
		return $object;
	}

	/**
	 * Extract values from an object
	 *
	 * @param  object $object
	 * @return array
	 */
	public function extract($object) {
		$array = array();
		$methods = get_class_methods(get_class($object));

		foreach ($methods as $method) {
			preg_match(' /^(get)(.*?)$/i', $method, $matches);
			if (!isset($matches[2])) {
				continue;
			}
			if ($this->case === self::SNAKE_CASE) {
				$key = StringUtil::snake($matches[2]);
			} else {
				$key = StringUtil::camel($matches[2]);
			}
			$array[$key] = $object->$method();
		}
		return $array;
	}

}

