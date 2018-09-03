<?php
/**
 * Copyright (c) 2018 - present
 * GoogleMapsApi - GeocodingResultsCollection.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 31/8/2018
 * MIT license: https://github.com/biscolab/google-maps-php-sdk/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Http\Result;

use Biscolab\GoogleMaps\Http\GoogleMapsResultsCollection;

/**
 * Class GeocodingResultsCollection
 * @package Biscolab\GoogleMaps\Http\Result
 */
class GeocodingResultsCollection extends GoogleMapsResultsCollection {

	/**
	 * @param $item
	 *
	 * @return GeocodingResult
	 */
	protected function parseItem($item) {

		return new GeocodingResult($item);
	}
}