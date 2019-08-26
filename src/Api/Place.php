<?php
/**
 * Copyright (c) 2019 - present
 * Google Maps PHP - Place.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 28/3/2019
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Api;

use Biscolab\GoogleMaps\Abstracts\Api;
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
 * Class Place
 * @package Biscolab\GoogleMaps\Api
 *
 * @since   0.5.0
 * @see     https://developers.google.com/places/web-service/intro
 */
class Place extends Api
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
	 * Find Place requests
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

		$request = $this->createRequest($params, $endpoint);

		return $this->getResultsCollections($request);
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

		if (empty($params[GoogleMapsRequestFields::RADIUS])) {
			throw new InvalidArgumentException(GoogleMapsRequestFields::RADIUS . ' field is required');
		}

		if (!empty($params[GoogleMapsRequestFields::RANKBY]) &&
			$params[GoogleMapsRequestFields::RANKBY] === RankByValues::DISTANCE &&
			empty($params[GoogleMapsRequestFields::KEYWORD]) &&
			empty($params[GoogleMapsRequestFields::NAME]) &&
			empty($params[GoogleMapsRequestFields::TYPE])
		) {
			throw new InvalidArgumentException('If ' . GoogleMapsRequestFields::RANKBY . ' is set as "' . RankByValues::DISTANCE . '" one or more of '.GoogleMapsRequestFields::KEYWORD.', '.GoogleMapsRequestFields::NAME.', '.GoogleMapsRequestFields::TYPE.' fields are required');
		}

		return $this->makeApiCall($params, PlaceServicesEndpoints::NEARBYSEARCH);
	}

	/**
	 * Nearby Search requests
	 *
	 * @param array $params
	 *
	 * @see     https://developers.google.com/places/web-service/search#TextSearchRequests
	 * @return GoogleMapsResultsCollection
	 * @since   0.5.0
	 */
	public function textSearch(array $params): GoogleMapsResultsCollection
	{

		return $this->makeApiCall($params, PlaceServicesEndpoints::TEXTSEARCH);
	}

}