<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - AddressComponent.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Object;

use Biscolab\GoogleMaps\Abstracts\AbstractObject;
use Biscolab\GoogleMaps\Fields\AddressComponentFields;

/**
 * Class AddressComponent
 * @package Biscolab\GoogleMaps\Object
 */
class AddressComponent extends AbstractObject {

	/**
	 * @var string
	 */
	protected $long_name = null;

	/**
	 * @var string
	 */
	protected $short_name = null;

	/**
	 * @var array
	 */
	protected $types = null;

	/**
	 * @var array
	 */
	protected $typeCheck = [
		AddressComponentFields::LONG_NAME  => 'string',
		AddressComponentFields::SHORT_NAME => 'string',
		AddressComponentFields::TYPES      => 'array'
	];

	/**
	 * @return string
	 */
	public function getLongName(): string {

		return $this->long_name;
	}

	/**
	 * @param string $long_name
	 *
	 * @return $this
	 */
	public function setLongName(string $long_name): AddressComponent {

		$this->long_name = $long_name;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getShortName(): string {

		return $this->short_name;
	}

	/**
	 * @param string $short_name
	 *
	 * @return $this
	 */
	public function setShortName(string $short_name): AddressComponent {

		$this->short_name = $short_name;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getTypes(): array {

		return $this->types;
	}

	/**
	 * @param array $types
	 *
	 * @return $this
	 */
	public function setTypes(array $types): AddressComponent {

		$this->types = $types;

		return $this;
	}
}