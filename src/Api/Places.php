<?php
/**
 * Copyright (c) 2019 - present
 * Google Maps PHP - Places.phpp
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 28/3/2019
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Api;

use Biscolab\GoogleMaps\Abstracts\Api;
use Biscolab\GoogleMaps\Config\Util;
use Biscolab\GoogleMaps\Enum\PlaceServicesEndpoints;
use Biscolab\GoogleMaps\Exception\InvalidArgumentException;
use Biscolab\GoogleMaps\Fields\GoogleMapsRequestFields;
use Biscolab\GoogleMaps\Fields\GoogleMapsResultFields;
use Biscolab\GoogleMaps\Http\GoogleMapsResultsCollection;
use Biscolab\GoogleMaps\Http\Result\PlaceResultsCollection;
use Biscolab\GoogleMaps\Object\Location;
use Biscolab\GoogleMaps\Values\PlaceInputTypeValues;
use Biscolab\GoogleMaps\Values\RankByValues;

/**
 * Class Places
 * @package Biscolab\GoogleMaps\Api
 *
 * @since   0.5.0
 * @see     https://developers.google.com/places/web-service/intro
 */
class Places extends Api
{

	/**
	 * @var string
	 */
	const SERVICE_ENDPOINT = 'place';

	/**
	 * @var string
	 */
	protected $result_collection = PlaceResultsCollection::class;

	/**
	 * @param string     $query
	 * @param array|null $params
	 * @param array|null $fields
	 *
	 * @return GoogleMapsResultsCollection
	 * @see https://developers.google.com/places/web-service/search#FindPlaceRequests
	 */
	public function findPlaceByText(
		string $query,
		?array $params = [],
		?array $fields = []
	): GoogleMapsResultsCollection {

		$params = array_merge($params, [
			GoogleMapsRequestFields::INPUT  => $query,
			GoogleMapsRequestFields::FIELDS => implode(',', $fields)
		]);

		return $this->findPlace($params);

	}

	/**
	 * Find Places requests
	 *
	 * @param array $params
	 *        GoogleMapsRequestFields::INPUT required
	 *
	 * @see     https://developers.google.com/places/web-service/search#FindPlaceRequests
	 * @return GoogleMapsResultsCollection
	 * @throws InvalidArgumentException
	 * @since   0.5.0
	 */
	public function findPlace(array $params): GoogleMapsResultsCollection
	{

		// see \Biscolab\GoogleMaps\Values\PlaceInputTypeValues
		if (empty($params[GoogleMapsRequestFields::INPUTTYPE])) {
			$params[GoogleMapsRequestFields::INPUTTYPE] = PlaceInputTypeValues::TEXTQUERY;
		}

		if (empty($params[GoogleMapsRequestFields::INPUT])) {
			throw new InvalidArgumentException(GoogleMapsRequestFields::INPUT . " field is required");
		}

		return $this->makeApiCall($params, PlaceServicesEndpoints::FINDPLACEFROMTEXT);
	}

	/**
	 * @param array  $params
	 * @param string $endpoint
	 *
	 * @return GoogleMapsResultsCollection
	 * @since   0.5.0
	 */
	public function makeApiCall(array $params, string $endpoint): GoogleMapsResultsCollection
	{

		return $this->callApi($params, $endpoint);
	}

	/**
	 * @param string     $number
	 * @param array|null $params
	 * @param array|null $fields
	 *
	 * @return GoogleMapsResultsCollection
	 */
	public function findPlaceByPhoneNumber(
		string $number,
		?array $params = [],
		?array $fields = []
	): GoogleMapsResultsCollection {

		$params = array_merge($params, [
			GoogleMapsRequestFields::INPUT     => $number,
			GoogleMapsRequestFields::INPUTTYPE => PlaceInputTypeValues::PHONENUMBER,
			GoogleMapsRequestFields::FIELDS    => implode(',', $fields)
		]);

		return $this->findPlace($params);

	}

	/**
	 * @param Location   $location
	 * @param int        $radius
	 * @param array|null $params
	 *
	 * @return GoogleMapsResultsCollection
	 */
	public function findNearbyPlaceByRadius(Location $location, int $radius, ?array $params = []): GoogleMapsResultsCollection
	{

		$params = array_merge($params, [
			GoogleMapsRequestFields::LOCATION => $location,
			GoogleMapsRequestFields::RADIUS => $radius
		]);

		return $this->findNearbyPlace($params);
	}

	/**
	 * @param Location $location
	 * @param array    $params
	 *
	 * @return GoogleMapsResultsCollection
	 */
	public function findNearbyPlaceByDistance(Location $location, array $params): GoogleMapsResultsCollection
	{

		$params = array_merge($params, [
			GoogleMapsRequestFields::LOCATION => $location,
			GoogleMapsRequestFields::RANKBY => RankByValues::DISTANCE
		]);

		return $this->findNearbyPlace($params);
	}

	/**
	 * Nearby Search requests
	 *
	 * @param array $params
	 *
	 * @return GoogleMapsResultsCollection
	 *
	 * @throws InvalidArgumentException
	 * @see     https://developers.google.com/places/web-service/search#PlaceSearchRequests
	 * @since   0.5.0
	 */
	public function findNearbyPlace(array $params): GoogleMapsResultsCollection
	{

		if (!empty($params[GoogleMapsRequestFields::LOCATION])) {//-33.8670522,151.1957362
			$location = $params[GoogleMapsRequestFields::LOCATION];
			if (!$location instanceof Location) {
				throw new InvalidArgumentException(GoogleMapsRequestFields::LOCATION . ' field must be instance of ' . Location::class . ' class');
			}
			$params[GoogleMapsRequestFields::LOCATION] = (string)$params[GoogleMapsRequestFields::LOCATION];
		} else {
			throw new InvalidArgumentException(GoogleMapsResultFields::LOCATION . ' field is required');
		}

		if (!empty($params[GoogleMapsRequestFields::RANKBY]) &&
			$params[GoogleMapsRequestFields::RANKBY] === RankByValues::DISTANCE
		) {
			if (empty($params[GoogleMapsRequestFields::KEYWORD]) &&
				empty($params[GoogleMapsRequestFields::NAME]) &&
				empty($params[GoogleMapsRequestFields::TYPE])) {
//				If rankby=distance (described under Optional parameters below) is specified,
// 				then one or more of keyword, name, or type is required.
				throw new InvalidArgumentException('If ' . GoogleMapsRequestFields::RANKBY . ' is set as "' . RankByValues::DISTANCE . '" one or more of ' . GoogleMapsRequestFields::KEYWORD . ', ' . GoogleMapsRequestFields::NAME . ', ' . GoogleMapsRequestFields::TYPE . ' fields are required');
			}
			if (!empty($params[GoogleMapsRequestFields::RADIUS])) {
// 				Note that radius must not be included if rankby=distance (described under Optional parameters below) is specified.
				throw new InvalidArgumentException(GoogleMapsRequestFields::RADIUS . ' must not be included if ' . GoogleMapsRequestFields::RANKBY . ' = ' . RankByValues::DISTANCE);
			}
		} elseif (empty($params[GoogleMapsRequestFields::RADIUS])) {
//			radius — Defines the distance (in meters) within which to return place results.
			throw new InvalidArgumentException(GoogleMapsRequestFields::RADIUS . ' field is required');
		}

		if (!empty($params[GoogleMapsRequestFields::RADIUS]) && floatval($params[GoogleMapsRequestFields::RADIUS]) > Util::MAX_PLACE_RADIUS_VALUE) {
// 			The maximum allowed radius is 50 000 meters.
			throw new InvalidArgumentException(GoogleMapsRequestFields::RADIUS . ' must be lower than ' . Util::MAX_PLACE_RADIUS_VALUE);
		}

		return $this->makeApiCall($params, PlaceServicesEndpoints::NEARBYSEARCH);
	}

	/**
	 * Nearby Search requests
	 *
	 * @param string     $query
	 * @param array|null $params
	 *
	 * @see     https://developers.google.com/places/web-service/search#TextSearchRequests
	 * @return GoogleMapsResultsCollection
	 * @throws InvalidArgumentException
	 * @since   0.5.0
	 */
	public function textSearch(string $query, ?array $params = []): GoogleMapsResultsCollection
	{

		$params = array_merge($params, [
			GoogleMapsRequestFields::QUERY => $query
		]);

		return $this->makeApiCall($params, PlaceServicesEndpoints::TEXTSEARCH);
	}

}