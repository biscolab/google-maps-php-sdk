<?php

/**
 * Copyright (c) 2019 - present
 * Google Maps PHP - timeZone.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 9/10/2019
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

use Biscolab\GoogleMaps\Api\TimeZone;
use Biscolab\GoogleMaps\Enum\GoogleMapsApiConfigFields;
use Biscolab\GoogleMaps\Fields\LatLngFields;
use Biscolab\GoogleMaps\Object\Location;

// Run "composer install" command or change with your actual autoload.php file
require '../../vendor/autoload.php';

// Further info about API key: https://developers.google.com/maps/documentation/timezone/get-api-key
$timezone = new TimeZone([
	GoogleMapsApiConfigFields::KEY => 'YOUR_API_KEY'
]);

// https://developers.google.com/maps/documentation/timezone/start#sample-request
$location = new Location([LatLngFields::LAT => 38.908133, LatLngFields::LNG => -77.047119]);
$timestamp = 1458000000;
$results = $timezone->get($location, $timestamp);

// get dstOffset: should be 3600
$results->getDdstOffset();

// get rawOffset: should be -18000
$results->getRawOffset();

// get timeZoneId: should be "America/New_York"
$results->getTimeZoneId();

// get timeZoneName: should be "Eastern Daylight Time"
$results->getTimeZoneName();
