<?php
/**
 * Copyright (c) 2019 - present
 * Google Maps PHP - placesFindNearbyPlaceByDistance.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 9/9/2019
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

use Biscolab\GoogleMaps\Api\Places;
use Biscolab\GoogleMaps\Enum\GoogleMapsApiConfigFields;
use Biscolab\GoogleMaps\Fields\GoogleMapsRequestFields;
use Biscolab\GoogleMaps\Fields\LatLngFields;
use Biscolab\GoogleMaps\Object\Location;

// Run "composer install" command or change with your actual autoload.php file
require '../../vendor/autoload.php';

// Further info about API key: https://developers.google.com/places/web-service/get-api-key
$places = new Places([
	GoogleMapsApiConfigFields::KEY => 'YOUR_API_KEY'
]);

// Get data starting with location and radius
// see https://developers.google.com/places/web-service/search#PlaceSearchRequests
$location = new Location([
	LatLngFields::LAT => -33.8670522,
	LatLngFields::LNG => 151.1957362,
]);

// You MUST set at least one of following values
$params = [
	GoogleMapsRequestFields::KEYWORD => 'a keyword',
	GoogleMapsRequestFields::NAME => 'name of the place you are looking for',
	// Biscolab\GoogleMaps\Values\PlaceTypeValues enum class
	GoogleMapsRequestFields::TYPE => 'Type of the place you are looking for'
];

// https://developers.google.com/places/web-service/search#FindPlaceRequests
$result = $places->findNearbyPlaceByDistance($location, $params);

// Get number of results
$results->count(); // count($results)

// Get first result
/** @var \Biscolab\GoogleMaps\Http\Result\PlacesResult $first_result */
$first_result = $results->current();

// Get result Geometry and then get location (latitude and longitude)
$location = $first_result->getGeometry()->getLocation();

// Get place ID
$place_id = $first_result->getPlaceId();

// You can itarate result
//foreach ($results_by_phone_number as $candidate) {
//	...
//}