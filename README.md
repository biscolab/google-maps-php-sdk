# Google Maps PHP SDK

![Packagist version](https://img.shields.io/packagist/v/biscolab/google-maps-php-sdk.svg) [![Scrutinizer](https://img.shields.io/scrutinizer/g/biscolab/google-maps-php-sdk.svg)](https://scrutinizer-ci.com/g/biscolab/google-maps-php-sdk/)

Google Maps PHP (unofficial library) - **Documentation coming soon**.
This provide simple functions to work with Google Maps APIs. You can find further informations in [Google Maps Platform Documentation](https://developers.google.com/maps/documentation/)
Google Maps provide many services, actually at this moment this package implements only **Geocoding** service but others will be available soon.

## Google Maps Services

* Geocoding (ready)
* Directions (soon)
* Distance Matrix (soon)
* Elevation (soon)
* Geolocation (not scheduled)
* Places (soon)
* Road (soon)
* Time Zone (soon)

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

## Reference
Go to [complete reference](https://biscolab.com/google-maps-php-reference/)

## Test

```sh
composer test
```

## License
[![MIT License](https://img.shields.io/github/license/biscolab/google-maps-php-sdk.svg)](https://github.com/biscolab/google-maps-php-sdk/blob/master/LICENSE)