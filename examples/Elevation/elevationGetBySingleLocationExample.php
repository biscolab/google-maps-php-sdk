<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - elevationGetBySingleLocationExample.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 30/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

use Biscolab\GoogleMaps\Api\Elevation;
use Biscolab\GoogleMaps\Enum\GoogleMapsApiConfigFields;
use Biscolab\GoogleMaps\Fields\LatLngFields;
use Biscolab\GoogleMaps\Object\Location;

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
$location = new Location([
	LatLngFields::LAT => 39.73915360,
	LatLngFields::LNG => -104.9847034,
]);
$results = $elevation->getByLocations($location);

// Get number of results
$results->count();

// Get first result
/** @var \Biscolab\GoogleMaps\Http\Result\ElevationResult $first_result */
$first_result = $results->current();

// Get elevation of first (and unique) result
// should be 1608.637939453125
$elevation = $first_result->getElevation();

// Get resolution of first (and unique) result
// should be 4.771975994110107
$resolution = $first_result->getResolution();