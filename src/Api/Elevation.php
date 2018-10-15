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
use Biscolab\GoogleMaps\Exception\InvalidArgumentException;
use Biscolab\GoogleMaps\Fields\GoogleMapsRequestFields;
use Biscolab\GoogleMaps\Http\GoogleMapsResultsCollection;
use Biscolab\GoogleMaps\Http\Result\ElevationResultsCollection;
use Biscolab\GoogleMaps\Object\LatLng;
use Biscolab\GoogleMaps\Object\Path;

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
	 * @return GoogleMapsResultsCollection
	 *
	 * @since 0.3.0
	 */
	public function getByLocations($locations): GoogleMapsResultsCollection {

		$locations = $this->parseLocations($locations);

		$request = $this->createRequest([
			GoogleMapsRequestFields::LOCATIONS => $locations
		]);

		return $this->getResultsCollections($request);
	}

	/**
	 * @param array|string $locations
	 *
	 * @return string
	 *
	 * @since   0.3.0
	 */
	public function parseLocations($locations): string {

		if($locations instanceof Path) {
			$locations = $locations->toArray();
		}

		if (is_array($locations)) {
			$locations = implode('|', array_map(function ($item) {

				return (string)$item;
			}, $locations));
		}

		return (string)$locations;
	}

	/**
	 * Sampled Path Requests
	 *
	 * @param array|string $path
	 * This parameter takes either a multiple locations passed as an array or as an encoded polyline
	 *
	 * @param int          $samples
	 * This will be the number of results as well
	 *
	 * @throws InvalidArgumentException
	 * @return GoogleMapsResultsCollection
	 *
	 * @since 0.4.0
	 */
	public function getBySampledPath($path, int $samples): GoogleMapsResultsCollection {

		if ((is_array($path) && count($path) < 2) ||
			$path instanceof Path && $path->count() < 2) {
			throw new InvalidArgumentException('The number of items provided in the path must be greater than 1 (One)');
		}

		if ($samples <= 0) {
			throw new InvalidArgumentException('The number of samples must be greater than 0 (Zero)');
		}

		$path = $this->parseLocations($path);

		$request = $this->createRequest([
			GoogleMapsRequestFields::PATH    => $path,
			GoogleMapsRequestFields::SAMPLES => $samples,
		]);

		return $this->getResultsCollections($request);
	}

}