<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - Elevation.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 28/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Api;

use Biscolab\GoogleMaps\Abstracts\Api;
use Biscolab\GoogleMaps\Fields\GoogleMapsRequestFields;
use Biscolab\GoogleMaps\Http\GoogleMapsResultsCollection;
use Biscolab\GoogleMaps\Http\Result\ElevationResultsCollection;
use Biscolab\GoogleMaps\Object\LatLng;

/**
 * Class Elevation
 * @package Biscolab\GoogleMaps\Api
 *
 * @since   0.3.0
 * @see     https://developers.google.com/maps/documentation/elevation/start
 */
class Elevation extends Api {

	/**
	 * @var string
	 */
	const SERVICE_ENDPOINT = 'elevation';

	/**
	 * @var string
	 */
	protected $result_collection = ElevationResultsCollection::class;

	/**
	 * Positional Requests
	 *
	 * @param LatLng|string|array $locations
	 * This parameter takes either a single location or multiple locations passed as an array or as an encoded polyline
	 *
	 * @since 0.3.0
	 *
	 * @return GoogleMapsResultsCollection
	 */
	public function getByLocations($locations): GoogleMapsResultsCollection {

		$locations = $this->parseLocations($locations);

		$request = $this->createRequest([
			GoogleMapsRequestFields::LOCATIONS => $locations
		]);

		return $this->getResultsCollections($request);
	}

	/**
	 * @param $locations
	 *
	 * @since   0.3.0
	 *
	 * @return string
	 */
	public function parseLocations($locations): string {

		if (is_array($locations)) {
			$locations = implode('|', array_map(function ($item) {

				return (string)$item;
			}, $locations));
		}

		return (string)$locations;
	}

}