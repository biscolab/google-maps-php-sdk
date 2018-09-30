<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - GeocodingResultsCollection.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Http\Result;

use Biscolab\GoogleMaps\Http\GoogleMapsResultsCollection;

/**
 * Class GeocodingResultsCollection
 * @package Biscolab\GoogleMaps\Http\Result
 */
class GeocodingResultsCollection extends GoogleMapsResultsCollection {

	/**
	 * @var string
	 */
	protected $item_class = GeocodingResult::class;
}