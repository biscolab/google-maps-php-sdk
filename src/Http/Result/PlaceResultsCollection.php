<?php
/**
 * Copyright (c) 2019 - present
 * Google Maps PHP - PlaceResultsCollection.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 1/8/2019
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Http\Result;

use Biscolab\GoogleMaps\Http\GoogleMapsResultsCollection;

/**
 * Class PlaceResultsCollection
 * @package Biscolab\GoogleMaps\Http\Result
 *
 * @since   0.5.0
 */
class PlaceResultsCollection extends GoogleMapsResultsCollection
{

	/**
	 * @var string
	 */
	protected $item_class = PlaceResult::class;
}