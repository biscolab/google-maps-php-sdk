<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - AbstractObject.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Abstracts;

use Biscolab\GoogleMaps\Exception\Exception;
use function Biscolab\GoogleMaps\camel2Snake;

/**
 * Class AbstractObject
 * @package Biscolab\GoogleMaps\Abstracts
 */
abstract class AbstractObject
{

	/**
	 * @var array
	 */
	protected $typeCheck = [];

	/**
	 * @var array
	 */
	protected $required = [];

	/**
	 * @var array
	 */
	protected $errors = [];

	/**
	 * AbstractObject constructor.
	 *
	 * @param array $args
	 */
	public function __construct(?array $args = [])
	{

		if (is_null($args)) {
			$args = [];
		}

		$this->setArgs($args);
	}

	/**
	 * @param array $args
	 *
	 * @throws Exception
	 */
	protected function setArgs(array $args)
	{

		foreach ($this->typeCheck as $field_name => $field_type) {
			if (empty($args[$field_name]) || is_null($args[$field_name])) {
				if ($this->isFieldRequired($field_name)) {
					$this->addError('Missing "' . $field_name . '" in ' . static::class);
				}
			} else {
				$this->$field_name = $this->parseFieldValue($field_type, $args[$field_name]);
			}
		}
		$this->throwErrors();
	}

	/**
	 * @param string $field_name
	 *
	 * @return bool
	 */
	protected function isFieldRequired(string $field_name): bool
	{

		return in_array($field_name, $this->required);
	}

	/**
	 * @param string $error
	 *
	 * @return array
	 */
	protected function addError(string $error): array
	{

		array_push($this->errors, $error);

		return $this->errors;
	}

	/**
	 * @param string $field_type
	 * @param string $field_value
	 *
	 * @return mixed
	 */
	protected function parseFieldValue(string $field_type, $field_value)
	{

		switch ($field_type) {
			case 'string':
			case 'int':
			case 'float':
			case 'array':
			case 'json':
				return $field_value;
			default:
				return ($field_value instanceof $field_type) ? $field_value : new $field_type($field_value);
		}
	}

	/**
	 * @throws Exception
	 */
	protected function throwErrors()
	{

		if (count($this->errors)) {
			throw new Exception(implode(', ', $this->errors));
		}
	}

	/**
	 * @return string
	 */
	public function toJson(): string
	{

		return json_encode($this->toArray());
	}

	/**
	 * @return array
	 */
	public function toArray(): array
	{

		$fields = get_object_vars($this);

		foreach ($fields as $field_name => $field_value) {

			if (!is_scalar($field_value) && method_exists($field_value, 'toJson')) {
				$fields[$field_name] = $field_value->toArray();
			}
		}

		return $fields;
	}

	/**
	 * @return string
	 */
	public function __toString(): string
	{

		return implode(',', $this->toArray());
	}

	/**
	 * @param $name
	 * @param $arguments
	 *
	 * @return mixed
	 */
	public function __call($name, $arguments)
	{

		preg_match('/(?<=(g|s)et)([A-Za-z0-9])\w+/', $name, $match);

		$camel_field = (empty($match[0])) ? '' : $match[0];

		$snake_field = $this->getFieldName($camel_field);

		$field_type = (empty($this->typeCheck[$snake_field])) ? null : $this->typeCheck[$snake_field];

		if (!empty($match[1]) && $field_type) {
			switch ($match[1]) {
				case 's':
					return $this->$snake_field = $this->parseFieldValue($field_type, current($arguments));
				case 'g':
					return $this->$snake_field;
			}
		}
	}

	/**
	 * @param string $initial_field_name
	 *
	 * @return string
	 */
	protected function getFieldName(string $initial_field_name): string
	{

		return camel2Snake($initial_field_name);
	}

}