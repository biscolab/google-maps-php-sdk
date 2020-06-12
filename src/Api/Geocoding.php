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
	 * The language in which to return results
	 * https://developers.google.com/maps/faq#languagesupport
	 *
	 * @var null|string
	 */
	private $language = null;

	/**
	 * @var string
	 */
	const SERVICE_ENDPOINT = 'geocode';

	/**
	 * @var string
	 */
	protected $result_collection_type = GeocodingResultsCollection::class;

	/**
	 * Set the language in which to return results
	 *
	 * @param null|string $language
	 * @return self
	 */
	public function setLanguage(?string $language = null): self
	{
		$this->language = $language;
		return $this;
	}

	/**
	 * Add language to $params list if necessary
	 *
	 * @param array $params
	 * @return array
	 * @since 0.8.0
	 */
	public function prepareParams(array $params): array
	{
		if ($this->language) {
			$params[GoogleMapsRequestFields::LANGUAGE] = $this->language;
		}
		return $params;
	}

	/**
	 * Geocoding (Address Lookup)
	 * 
	 * @param string $literal_address
	 * @param string $region
	 *
	 * @return GoogleMapsResultsCollection
	 */
	public function getByAddress(string $literal_address, ?string $region = null): GoogleMapsResultsCollection
	{
		$params = [
			GoogleMapsRequestFields::ADDRESS => $literal_address
		];
		if ($region) {
			$params[GoogleMapsRequestFields::REGION] = $region;
		}
		$params = $this->prepareParams($params);
		return $this->callApi($params);
	}

	/**
	 * ALIAS: getByLatLng
	 * Geocoding (Latitude/Longitude Lookup)
	 * 
	 * @param LatLng $latlng
	 *
	 * @return GoogleMapsResultsCollection
	 * @deprecated 0.8.0
	 */
	public function getReverse(LatLng $latlng): GoogleMapsResultsCollection
	{
		return $this->getByLatLng($latlng);
	}

	/**
	 * Geocoding (Latitude/Longitude Lookup)
	 * 
	 * @param LatLng $latlng
	 *
	 * @return GoogleMapsResultsCollection
	 * @since 0.8.0
	 */
	public function getByLatLng(LatLng $latlng): GoogleMapsResultsCollection
	{
		$params = $this->prepareParams([
			GoogleMapsRequestFields::LATLNG => $latlng
		]);
		return $this->callApi($params);
	}

	/**
	 * Retrieving an Address for a Place ID
	 * 
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
