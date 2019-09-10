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
 *
 * @see     https://developers.google.com/maps/documentation/geocoding/intro#Types
 */
class Address extends AbstractCollection
{

	/**
	 * @param $item
	 *
	 * @return AddressComponent
	 */
	protected function parseItem($item)
	{

		return ($item instanceof AddressComponent) ? $item : new AddressComponent($item);
	}
}