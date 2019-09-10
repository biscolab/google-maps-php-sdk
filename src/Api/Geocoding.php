<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - Geocoding.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Api;

use Biscolab\GoogleMaps\Abstracts\Api;
use Biscolab\GoogleMaps\Fields\GoogleMapsRequestFields;
use Biscolab\GoogleMaps\Http\GoogleMapsResultsCollection;
use Biscolab\GoogleMaps\Http\Result\GeocodingResultsCollection;
use Biscolab\GoogleMaps\Object\LatLng;

/**
 * Class Geocoding
 * @package Biscolab\GoogleMaps\Api
 *
 * @see     https://developers.google.com/maps/documentation/geocoding/start
 */
class Geocoding extends Api
{

	/**
	 * @var string
	 */
	const SERVICE_ENDPOINT = 'geocode';

	/**
	 * @var string
	 */
	protected $result_collection = GeocodingResultsCollection::class;

	/**
	 * @param string $literal_address
	 *
	 * @return GoogleMapsResultsCollection
	 */
	public function getByAddress(string $literal_address): GoogleMapsResultsCollection
	{

		return $this->callApi([
			GoogleMapsRequestFields::ADDRESS => $literal_address
		]);
	}

	/**
	 * @param LatLng $latlng
	 *
	 * @return GoogleMapsResultsCollection
	 */
	public function getReverse(LatLng $latlng): GoogleMapsResultsCollection
	{

		return $this->callApi([
			GoogleMapsRequestFields::LATLNG => $latlng
		]);
	}

	/**
	 * @param string $place_id
	 *
	 * @return GoogleMapsResultsCollection
	 */
	public function getByPlaceId(string $place_id): GoogleMapsResultsCollection
	{

		return $this->callApi([
			GoogleMapsRequestFields::PLACE_ID => $place_id
		]);
	}

}