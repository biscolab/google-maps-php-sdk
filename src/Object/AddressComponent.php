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
}