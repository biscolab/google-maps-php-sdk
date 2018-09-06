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
use Biscolab\GoogleMaps\Http\GoogleMapsRequest;
use Biscolab\GoogleMaps\Http\GoogleMapsResultsCollection;
use Biscolab\GoogleMaps\Http\Result\GeocodingResultsCollection;
use Biscolab\GoogleMaps\Object\LatLng;

/**
 * Class Geocoding
 * @package Biscolab\GoogleMaps\Api
 *
 * @see     https://developers.google.com/maps/documentation/geocoding/start
 */
class Geocoding extends Api {

	/**
	 * @var string
	 */
	const SERVICE_ENDPOINT = 'geocode';

	/**
	 * @param string $literal_address
	 *
	 * @return GoogleMapsResultsCollection
	 */
	public function getByAddress(string $literal_address): GoogleMapsResultsCollection {

		$request = new GoogleMapsRequest([
			GoogleMapsRequestFields::ADDRESS => $literal_address
		]);

		return $this->getResultsCollections($request);
	}

	/**
	 * @param LatLng $latlng
	 *
	 * @return GoogleMapsResultsCollection
	 */
	public function getReverse(LatLng $latlng): GoogleMapsResultsCollection {

		$request = $this->createRequest([
			GoogleMapsRequestFields::LATLNG => $latlng
		]);

		return $this->getResultsCollections($request);
	}

	/**
	 * @param string $place_id
	 *
	 * @return GoogleMapsResultsCollection
	 */
	public function getByPlaceId(string $place_id): GoogleMapsResultsCollection {

		$request = $this->createRequest([
			GoogleMapsRequestFields::PLACE_ID => $place_id
		]);

		return $this->getResultsCollections($request);
	}

	/**
	 * @param GoogleMapsRequest $request
	 *
	 * @return GoogleMapsResultsCollection
	 */
	public function getResultsCollections(GoogleMapsRequest $request): GoogleMapsResultsCollection {

		$results = $this->getGoogleMapsApi()->get($request)->getResults();

		return new GeocodingResultsCollection($results);
	}

	/**
	 * @param array $params
	 *
	 * @return GoogleMapsRequest
	 */
	public function createRequest(array $params): GoogleMapsRequest {

		return new GoogleMapsRequest($params);
	}

}