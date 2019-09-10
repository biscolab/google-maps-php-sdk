<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - geocodingGetReverseExample.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 16/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

use Biscolab\GoogleMaps\Api\Geocoding;
use Biscolab\GoogleMaps\Enum\GoogleMapsApiConfigFields;
use Biscolab\GoogleMaps\Fields\LatLngFields;
use Biscolab\GoogleMaps\Object\LatLng;

// Run "composer install" command or change with your actual autoload.php file
require '../../vendor/autoload.php';

// Further info about API key: https://developers.google.com/maps/documentation/geolocation/get-api-key
$geocoding = new Geocoding([
	GoogleMapsApiConfigFields::KEY => 'YOUR_API_KEY'
]);

// Get data starting from a LatLng object
// Change with the LatLng object you want to analyze
// From Google official documentation you can try with "40.714224,-73.961452"
// see https://developers.google.com/maps/documentation/geocoding/start
$lat_lng = new LatLng([
	LatLngFields::LAT => 40.714224,
	LatLngFields::LNG => -73.961452,
]);
$results_reverse = $geocoding->getReverse($lat_lng);

// Get number of results
$results_reverse->count();

// Get first result
/** @var \Biscolab\GoogleMaps\Http\Result\GeocodingResult $first_result */
$first_result = $results_reverse->current();

// Get result first address of the result
// The address is splitted in several components
$address = $first_result->getAddress();

// Get place ID
$location = $first_result->getPlaceId();