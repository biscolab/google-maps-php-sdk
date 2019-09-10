<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - Path.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 15/10/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Object;

use Biscolab\GoogleMaps\Abstracts\AbstractCollection;

/**
 * Class Path
 * @package Biscolab\GoogleMaps\Object
 *
 * @see     https://developers.google.com/maps/documentation/geocoding/intro#Types
 */
class Path extends AbstractCollection
{

	/**
	 * @param $item
	 *
	 * @return Location
	 */
	protected function parseItem($item)
	{

		return ($item instanceof Location) ? $item : new Location($item);
	}
}