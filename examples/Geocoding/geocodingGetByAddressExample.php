<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - geocodingGetByAddressExample.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 15/9/2018
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

// Get data starting from a literal address
// Change with the address you want to analyze
// From Google official documentation you can try with "1600 Amphitheatre Parkway, Mountain View, CA"
// see https://developers.google.com/maps/documentation/geocoding/start
$address = '1600 Amphitheatre Parkway, Mountain View, CA';
$results_by_address = $geocoding->getByAddress($address);

// Get number of results
$results_by_address->count();

// Get first result
/** @var \Biscolab\GoogleMaps\Http\Result\GeocodingResult $first_result */
$first_result = $results_by_address->current();

// Get result Geometry and then get location (latitude and longitude)
$location = $first_result->getGeometry()->getLocation();

// Get place ID
$place_id = $first_result->getPlaceId();

