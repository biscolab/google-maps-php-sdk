<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - elevationGetBySampledPathExampleWithPath.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 15/10/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

use Biscolab\GoogleMaps\Api\Elevation;
use Biscolab\GoogleMaps\Enum\GoogleMapsApiConfigFields;
use Biscolab\GoogleMaps\Fields\LatLngFields;
use Biscolab\GoogleMaps\Object\Location;
use Biscolab\GoogleMaps\Object\Path;

// Run "composer install" command or change with your actual autoload.php file
require '../../vendor/autoload.php';

// Further info about API key: https://developers.google.com/maps/documentation/elevation/get-api-key
$elevation = new Elevation([
	GoogleMapsApiConfigFields::KEY => 'YOUR_API_KEY'
]);

// Get data starting from a Location object
// Change with the Location object you want to analyze
// From Google official documentation you can try with "39.73915360,-104.9847034"
// see https://developers.google.com/maps/documentation/geocoding/start
$path = new Path([
	new Location([
		LatLngFields::LAT => 39.73915360,
		LatLngFields::LNG => -104.9847034,
	]),
	new Location([
		LatLngFields::LAT => 50.123,
		LatLngFields::LNG => 99.456,
	])
]);

// The response will contains 5 results
$results = $elevation->getBySampledPath($path, 5);

// Get number of results
$number_of_results = $results->count();

// Get first result
/** @var \Biscolab\GoogleMaps\Http\Result\ElevationResult $first_result */
$first_result = $results->current();
/** @var \Biscolab\GoogleMaps\Http\Result\ElevationResult $last_result */
$last_result = $results->last();

// Get elevation of first result
// should be 1608.637939453125
$first_elevation = $first_result->getElevation();

// Get resolution of first result
// should be 4.771975994110107
$first_resolution = $first_result->getResolution();

// Get elevation of last result
// should be 2013.5008544922
$last_elevation = $last_result->getElevation();

// Get resolution of last result
// should be 152.70323181152
$last_resolution = $last_result->getResolution();
