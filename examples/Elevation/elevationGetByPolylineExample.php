<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - elevationGetByPolylineExample.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 30/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

use Biscolab\GoogleMaps\Api\Elevation;
use Biscolab\GoogleMaps\Enum\GoogleMapsApiConfigFields;

// Run "composer install" command or change with your actual autoload.php file
require '../../vendor/autoload.php';

// Further info about API key: https://developers.google.com/maps/documentation/elevation/get-api-key
$elevation = new Elevation([
	GoogleMapsApiConfigFields::KEY => 'YOUR_API_KEY'
]);

// Get data starting from a Location object
// Change with the Location object you want to analyze
// From Google official documentation you can try with "enc:gfo}EtohhU"
// see https://developers.google.com/maps/documentation/elevation/intro#Locations
$location = 'enc:gfo}EtohhU';
$results = $elevation->getByLocations($location);

// Get number of results
$results->count();

// Get first result
/** @var \Biscolab\GoogleMaps\Http\Result\ElevationResult $first_result */
$first_result = $results->current();

// Get elevation of first (and unique) result
// should be -52.799583435059
$elevation = $first_result->getElevation();

// Get resolution of first (and unique) result
// should be 19.08790397644
$resolution = $first_result->getResolution();

// Get resolution of first (and unique) result
$location = $first_result->getLocation();

// should be 36.45556
$location_lat = $location->getLat();

// should be -116.86667
$location_lng = $location->getLng();