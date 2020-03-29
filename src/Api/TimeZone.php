<?php
/**
 * Copyright (c) 2019 - present
 * Google Maps PHP - TimeZone.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 8/10/2019
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Api;

use Biscolab\GoogleMaps\Abstracts\Api;
use Biscolab\GoogleMaps\Fields\GoogleMapsRequestFields;
use Biscolab\GoogleMaps\Http\GoogleMapsResult;
use Biscolab\GoogleMaps\Http\Result\ElevationResultsCollection;
use Biscolab\GoogleMaps\Http\Result\TimeZoneResult;
use Biscolab\GoogleMaps\Object\Location;

/**
 * Class TimeZone
 * @package Biscolab\GoogleMaps\Api
 *
 * @since   0.7.0
 * @see     https://developers.google.com/maps/documentation/timezone/intro
 */
class TimeZone extends Api
{

	/**
	 * @var string
	 */
	const SERVICE_ENDPOINT = 'timezone';

	/**
	 * @var string
	 */
	protected $result_type = TimeZoneResult::class;

	/**
	 * @param Location    $location
	 * @param int         $timestamp
	 * @param string|null $language
	 *
	 * @return GoogleMapsResult
	 */
	public function get(Location $location, int $timestamp, string $language = null): GoogleMapsResult
	{

		$params = [
			GoogleMapsRequestFields::LOCATION => $location,
			GoogleMapsRequestFields::TIMESTAMP => $timestamp,
		];

		if ($language) {
			$params[GoogleMapsRequestFields::LANGUAGE] = $language;
		}

		return $this->callApi($params);
	}
}