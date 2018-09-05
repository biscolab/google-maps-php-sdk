<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - Address.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Object;

use Biscolab\GoogleMaps\Abstracts\AbstractCollection;

/**
 * Class Address
 * @package Biscolab\GoogleMaps\Object
 */
class Address extends AbstractCollection {

	/**
	 * @param $item
	 *
	 * @return AddressComponent
	 */
	protected function parseItem($item) {

		return new AddressComponent($item);
	}
}