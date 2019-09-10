<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - geocodingGetPlaceIdExample.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 16/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

use Biscolab\GoogleMaps\Api\Geocoding;
use Biscolab\GoogleMaps\Enum\GoogleMapsApiConfigFields;

// Run "composer install" command or change with your actual autoload.php file
require '../../vendor/autoload.php';

// Further info about API key: https://developers.google.com/maps/documentation/geolocation/get-api-key
$geocoding = new Geocoding([
	GoogleMapsApiConfigFields::KEY => 'YOUR_API_KEY'
]);

// Get data starting from a place_ID
// Change with the place_ID you want to analyze
// From Google official documentation you can try with "ChIJd8BlQ2BZwokRAFUEcm_qrcA"
// see https://developers.google.com/maps/documentation/geocoding/intro#place-id
$place_id = 'ChIJd8BlQ2BZwokRAFUEcm_qrcA';
$results_by_place_id = $geocoding->getByPlaceId($place_id);

// Get number of results
$results_by_place_id->count();

// Get first result
/** @var \Biscolab\GoogleMaps\Http\Result\GeocodingResult $first_result */
$first_result = $results_by_place_id->current();

// Get result Geometry and then get location (latitude and longitude)
$location = $first_result->getGeometry()->getLocation();

// Get result address of the result
// The address is splitted in several components
$address = $first_result->getAddress();