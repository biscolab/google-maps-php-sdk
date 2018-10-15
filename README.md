# Google Maps PHP SDK

[![Packagist version](https://img.shields.io/packagist/v/biscolab/google-maps-php-sdk.svg)](https://packagist.org/packages/biscolab/google-maps-php-sdk) [![Scrutinizer](https://img.shields.io/scrutinizer/g/biscolab/google-maps-php-sdk.svg)](https://scrutinizer-ci.com/g/biscolab/google-maps-php-sdk/) [![Build Status](https://travis-ci.org/biscolab/google-maps-php-sdk.svg?branch=master)](https://travis-ci.org/biscolab/google-maps-php-sdk)

Google Maps PHP (unofficial library).
This provide simple functions to work with Google Maps APIs. You can find further informations in [Google Maps Platform Documentation](https://developers.google.com/maps/documentation/)

Google Maps provide many services, actually at this moment this package implements only **Geocoding** service but others will be available soon.

## Reference & Documentation
Go to [complete reference](https://biscolab.com/google-maps-php-reference/) or read [documentation](https://gmaps.biscolab.com/)

## Google Maps Services

### Ready
* Geocoding :ballot_box_with_check:
* Elevation :ballot_box_with_check:

### ASAP
* Directions (soon)
* Distance Matrix (soon)
* Places (soon)
* Road (soon)
* Time Zone (soon)

### Not scheduled
* Geolocation (not scheduled)

## Installation

You can install the package via composer:
```sh
composer require biscolab/google-maps-php-sdk
```
Notice! The package is not yet stable, you may find trouble with your minimum stability settings. 
**Further documentation coming asap**.

## Configuration

### API key

First of all you need an API key: [Get API Key](https://developers.google.com/maps/documentation/geolocation/get-api-key)

### Initialize the Geocoding object

```php

use Biscolab\GoogleMaps\Api\Geocoding;
use Biscolab\GoogleMaps\Enum\GoogleMapsApiConfigFields;

$geocoding = new Geocoding([
	GoogleMapsApiConfigFields::KEY => 'YOUR_API_KEY'
]);
```

### Get results

```php
// get results by address as string
$results = $geocoding->getByAddress('Insert your address here, city, postal code etc...');

// or results by Location/LatLng object
$results = $geocoding->getReverse(new LatLng([
			LatLngFields::LAT => $lat,
			LatLngFields::LNG => $lng,
		]));
		
// or results by Place ID as string
$results = $geocoding->getByPlaceId('YOUR_PLACE_ID');

```

### Use results
Results is/are a `Biscolab\GoogleMaps\Http\GeocodingResultsCollection` object.  
First thing you should know how many results there are in your `GeocodingResultsCollection` using `count
` method.
```php
$number_of_results = $results->count();
```
To retrieve the first result you can use the `first` method:

```php

$first_result = $results->first();

```

Every result had the following methods to retrieve member variables:

* getAddressComponents (return Address)
* getFormattedAddress (return string)
* getGeometry (return Geometry)
* getPlaceId (return string)
* getTypes (return array)

## Test

```sh
composer test
```

## Examples

Watch the [examples](https://github.com/biscolab/google-maps-php-sdk/tree/master/examples)

## License
[![MIT License](https://img.shields.io/github/license/biscolab/google-maps-php-sdk.svg)](https://github.com/biscolab/google-maps-php-sdk/blob/master/LICENSE)
