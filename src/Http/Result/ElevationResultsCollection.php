<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - ElevationResultsCollection.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 28/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Http\Result;

use Biscolab\GoogleMaps\Http\GoogleMapsResultsCollection;

/**
 * Class GeocodingResultsCollection
 * @package Biscolab\GoogleMaps\Http\Result
 *
 * @since   0.3.0
 */
class ElevationResultsCollection extends GoogleMapsResultsCollection {

	/**
	 * @var string
	 */
	protected $item_class = ElevationResult::class;
}