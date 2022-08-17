# Google Maps PHP SDK

[![Packagist version](https://img.shields.io/packagist/v/biscolab/google-maps-php-sdk.svg)](https://packagist.org/packages/biscolab/google-maps-php-sdk) [![Scrutinizer](https://img.shields.io/scrutinizer/g/biscolab/google-maps-php-sdk.svg)](https://scrutinizer-ci.com/g/biscolab/google-maps-php-sdk/) [![Build Status](https://travis-ci.org/biscolab/google-maps-php-sdk.svg?branch=master)](https://travis-ci.org/biscolab/google-maps-php-sdk)

Google Maps PHP (unofficial library).
This provide simple functions to work with Google Maps APIs. You can find further informations in [Google Maps Platform Documentation](https://developers.google.com/maps/documentation/)

Google Maps provide many services, actually at this moment this package implements only **Geocoding** service but others will be available soon.

## Reference & Documentation

Go to [complete reference](https://biscolab.com/google-maps-php-reference/) or read [documentation](https://gmaps-php-docs.biscolab.com/)

## Google Maps Services

### Ready

-   Geocoding :ballot_box_with_check:
-   Elevation :ballot_box_with_check:
-   Places :ballot_box_with_check:
-   Time Zone :ballot_box_with_check:

### ASAP

-   Directions (soon)
-   Distance Matrix (soon)
-   Road (soon)

### Not scheduled

-   Geolocation (not scheduled)

## Installation

You can install the package via composer:

```sh
composer require biscolab/google-maps-php-sdk
```

## Examples

Watch the [examples](https://github.com/biscolab/google-maps-php-sdk/tree/master/examples)

## License

[![MIT License](https://img.shields.io/github/license/biscolab/google-maps-php-sdk.svg)](https://github.com/biscolab/google-maps-php-sdk/blob/master/LICENSE)

## Documentation

This provide simple functions to work with Google Maps APIs. You can find further informations in [Google Maps Platform Documentation](https://developers.google.com/maps/documentation/)

## Reference

You can find [complete API references](https://biscolab.com/google-maps-php-reference/)

## Google Maps Services

### Ready

- [Geocoding](/docs/geocoding)
- [Elevation](/docs/elevation) (Positional and Sampled Path Requests)
- [Places](/docs/places) (Search and Details)
- [Time Zone](/docs/timezone)

### ASAP

- Directions (soon)
- Distance Matrix (soon)
- Road (soon)

### Not scheduled

- Geolocation (not scheduled)

## System requirements

PHP 7.1 or greater

## Composer

Install the package via composer:
```sh
composer require biscolab/google-maps-php-sdk
```
Notice! The package is not yet stable, you may find trouble with your minimum stability settings. 
**Further documentation coming asap**.

Google Maps is a service supplied by Google and first of all you must register your app project on the Google Cloud Platform Console and get a Google API key which you can add to your app or website (source: official Google Maps documentation).

1. Read the <a href="https://cloud.google.com/maps-platform/pricing/" target="_blank">Pricing table</a>
2. <a href="https://cloud.google.com/maps-platform/" target="_blank">Create your project</a> by clicking on "Get started"
3. Create project credentials
4. Enable services (Geocoding API, Elevation API, etc...)

## Google Console

<a href="https://console.cloud.google.com/" target="_blank">Google Console main page</a>

# Geocoding API

The Geocoding API is a service that provides geocoding and reverse geocoding of addresses.

<a href="https://developers.google.com/maps/documentation/geocoding/start" target="_blank">Official Google Geocoding documentation</a>

## Initialize Geocoding Object

First of all replace `YOUR_API_KEY` with your actual API key.

```php
use Biscolab\GoogleMaps\Api\Geocoding;
use Biscolab\GoogleMaps\Enum\GoogleMapsApiConfigFields;

$geocoding = new Geocoding([
	GoogleMapsApiConfigFields::KEY => 'YOUR_API_KEY'
]);
```

## Get results

You have 3 different ways to retrieve data of your place!

Go to complete <a href="https://biscolab.com/google-maps-php-reference/Biscolab/GoogleMaps/Api/Geocoding.html" target="_blank">SDK reference</a>

### Geocoding (Latitude/Longitude Lookup) by address as string

[Official Google documentation](https://developers.google.com/maps/documentation/geocoding/intro#geocoding)

`getByAddress` accept following arguments:

| Name    | Required | Type     | Description                                                                                                                                                                    |
| ------- | -------- | -------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| address | yes      | `string` | The street address or plus code that you want to geocode                                                                                                                       |
| region  | no       | `string` | The region code, specified as a ccTLD ("top-level domain") two-character value. More info [here](https://developers.google.com/maps/documentation/geocoding/intro#RegionCodes) |

```php

$results = $geocoding->getByAddress('Insert your address here, city, postal code etc...');

```

Change response language using `setLanguage` method

> You can find the list of supported languages here: [https://developers.google.com/maps/faq#languagesupport](https://developers.google.com/maps/faq#languagesupport)

```php
// Set Spanish language
$results = $geocoding->setLanguage('es')->getByAddress('Insert your address here, city, postal code etc...');

```

### Reverse Geocoding (Address Lookup) by Location/LatLng object

[Official Google documentation](https://developers.google.com/maps/documentation/geocoding/intro#ReverseGeocoding)

`getByLatLng` (`getReverse` alias is deprecated) accept a `LatLng` object which represents the location of the place.

```php
$results = $geocoding->getByLatLng(new LatLng([
			LatLngFields::LAT => $lat,
			LatLngFields::LNG => $lng,
		]));

// Alias `getReverse` deprecated!!!
$results = $geocoding->getReverse(new LatLng([
			LatLngFields::LAT => $lat,
			LatLngFields::LNG => $lng,
		]));
```

Change response language using `setLanguage` method

> You can find the list of supported languages here: [https://developers.google.com/maps/faq#languagesupport](https://developers.google.com/maps/faq#languagesupport)

```php
// Set Spanish language
$results = $geocoding->setLanguage('es')->getByLatLng(new LatLng([
			LatLngFields::LAT => $lat,
			LatLngFields::LNG => $lng,
		]));

// Use the same way for getReverse (alias) method
```

### By Place ID as string

`getByPlaceId` accept as parameter the address the place ID.

```php
$results = $geocoding->getByPlaceId('YOUR_PLACE_ID');

```

## Use results

Results is/are a `Biscolab\GoogleMaps\Http\GeocodingResultsCollection` object.  
First thing you should know how many results there are in your `GeocodingResultsCollection` using `count` method.

```php
$number_of_results = $results->count();
```

To retrieve the first result you can use the `first` method:

```php
$first_result = $results->first();
```

`$first_result` is an instance of `GeocodingResult` class and has the following methods:

| Method name              | Return Type |
| ------------------------ | ----------- |
| `getAddressComponents()` | `Address`   |
| `getFormattedAddress()`  | `string`    |
| `getGeometry()`          | `Geometry`  |
| `getPlaceId()`           | `string`    |
| `getTypes()`             | `array`     |

# Elevation API

The Elevation API provides elevation data for all locations on the surface of the earth, including depth locations on the ocean floor (which return negative values).

There are two types of request:

* Positional Requests
* Sampled Path Requests

At the moment this package support only **Positional Requests** but I'm working on **Sampled Path Requests** and it will be available soon.   

<a href="https://developers.google.com/maps/documentation/elevation/start" target="_blank">Official Google Elevation documentation</a>

## Initialize Elevation Object

First of all replace `YOUR_API_KEY` with your actual API key.


```php
use Biscolab\GoogleMaps\Api\Elevation;
use Biscolab\GoogleMaps\Enum\GoogleMapsApiConfigFields;

$elevation = new Elevation([
	GoogleMapsApiConfigFields::KEY => 'YOUR_API_KEY'
]);
```

## Get results (Positional Requests)

First of all you have to prepare the `locations` variable, it can be a single `Location` object, an array of `Location` objects or a polyline string.

### Single Location object

Create a Location object using latitude and longitude.

```php
// get results by single Location object
$locations = new Location([
	LatLngFields::LAT => 39.73915360,
	LatLngFields::LNG => -104.9847034,
]);
```

### Array of Location objects

Using multiple Location objects inside an array

```php
// or by multiple Location objects
$locations = [
	new Location([
		LatLngFields::LAT => 39.73915360,
		LatLngFields::LNG => -104.9847034,
	]),
	// ... more locations
	new Location([
		LatLngFields::LAT => 50.123,
		LatLngFields::LNG => 99.456,
	])
];
```
### Polyline encoded string

Encode a location using the <a href="https://developers.google.com/maps/documentation/utilities/polylinealgorithm" target="_blank">Encoded Polyline Algorithm Format</a>

```php
// or by polyline
$locations = 'enc:gfo}EtohhU';
```
### Make API call

```php
// make API call
$results = $elevation->getByLocations($locations);
```

## Get results (Sampled Path Requests)

First of all you have to prepare the `path` variable, it can be an array of `Location` objects or a polyline string.

### Array of Location objects

Using multiple Location objects inside an array

```php
// or by multiple Location objects
$path = [
	new Location([
		LatLngFields::LAT => 39.73915360,
		LatLngFields::LNG => -104.9847034,
	]),
	// ... more locations
	new Location([
		LatLngFields::LAT => 50.123,
		LatLngFields::LNG => 99.456,
	])
];
```
### Polyline encoded string

Encode a location using the <a href="https://developers.google.com/maps/documentation/elevation/intro#Paths" target="_blank">Encoded Polyline Algorithm Format</a>

```php
// or by polyline
$path = 'enc:gfo}EtohhUxD@bAxJmGF';
```
### Make API call

```php
// make API call
$samples = 5; // must be int > 0
$results = $elevation->getBySampledPath($path, $samples);
```

## Use results
Results is/are a `Biscolab\GoogleMaps\Http\ElevationResultsCollection` object.  
First thing you should know how many results there are in your `ElevationResultsCollection` using `count
` method.

```php
$number_of_results = $results->count();
```
To retrieve the first result you can use the `first` method:

```php
$first_result = $results->first();
```

`$first_result` is an instance of `ElevationResult` class and has the following methods:

| Method name | Return Type |
| --------------------- | --------------------- |
|`getLocation()`  | `Location` |
|`getElevation()`    | `float` |
|`getResolution()`    | `float` |

 # Places API

The Places API allows you to query for place information on a variety of categories, such as: establishments, prominent points of interest, geographic locations, and more. You can search for places either by proximity or a text string (credits: <a href="https://developers.google.com/places/web-service/search" target="_blank">Official Documentation website</a>.

There are 3 types of request:

* Find Place requests
* Nearby Search requests
* Text Search requests 

<a href="https://developers.google.com/places/web-service/search" target="_blank">Official Google Place documentation</a>

## Initialize Places Object

First of all replace `YOUR_API_KEY` with your actual API key.


```php
use Biscolab\GoogleMaps\Api\Places;
use Biscolab\GoogleMaps\Enum\GoogleMapsApiConfigFields;

$place = new Places([
	GoogleMapsApiConfigFields::KEY => 'YOUR_API_KEY'
]);
```

## Find Places requests

This function takes a text input (name, address or phone number) and returns a place.

### Using name or address

Search place using the "name" or "address".

```php
use Biscolab\GoogleMaps\Fields\GoogleMapsRequestFields;

// get results by place's name or address
$result = $places->findPlaceByText("Museum of Contemporary Art Australia");
```

`findPlaceByText` method accepts 3 arguments

| Name | Type | Description | Default |
| ------------ | ----------------- | ----------------- | --------------------- |
| `$query` | `string` | The address (or the name) specifying which place to search for | Required |
| `$params` | `array` | The list of search params to add to API request | `[]` |
| `$fields` | `array` | The fields specifying the types of place data to return | `[]` |

Find further details about request fields (required, types, etc...) here: <a href="https://developers.google.com/places/web-service/search#FindPlaceRequests" target="_blank">https://developers.google.com/places/web-service/search#FindPlaceRequests</a>

### Using phone number

Search place using the "phone number".

```php
use Biscolab\GoogleMaps\Fields\GoogleMapsRequestFields;

// get results by place's phone number
$result = $places->findPlaceByPhoneNumber("+61293744000");
```

`findPlaceByPhoneNumber` method accepts 3 arguments

| Name | Type | Description | Default |
| ------------ | ----------------- | ----------------- | --------------------- |
| `$number` | `string` | The phone number specifying which place to search for | Required |
| `$params` | `array` | The list of search params to add to API request | `[]` |
| `$fields` | `array` | The fields specifying the types of place data to return | `[]` |

Find further details about request fields (required, types, etc...) here: <a href="https://developers.google.com/places/web-service/search#FindPlaceRequests" target="_blank">https://developers.google.com/places/web-service/search#FindPlaceRequests</a>

## Nearby Search requests

This function looks for places within a specified area.

### Using location & radius

```php

use Biscolab\GoogleMaps\Object\Location;
use Biscolab\GoogleMaps\Fields\GoogleMapsRequestFields;

$location = new Location([
        LatLngFields::LAT => -33.8670522,
        LatLngFields::LNG => 151.1957362,
    ]);
$radius = 1000;

$result = $places->findNearbyPlaceByRadius($location, $radius);
```

`findNearbyPlaceByRadius` method accepts 3 arguments

| Name | Type | Description | Default |
| ------------ | ----------------- | ----------------- | --------------------- |
| `$location` | `Location` | must be instance of `Biscolab\GoogleMaps\Object\Location` class | Required |
| `$radius` | `int` | defines the distance in meters. Maximum allowed value is 50000. | Required |
| `$params` | `array` | additional parameters to add to API call | `[]` |

### Rank by distance

```php

use Biscolab\GoogleMaps\Object\Location;
use Biscolab\GoogleMaps\Fields\GoogleMapsRequestFields;

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

$result = $places->findNearbyPlaceByDistance($location, $params);
```
`findNearbyPlaceByDistance` method accepts 2 arguments

| Name | Type | Description | Default |
| ------------ | ----------------- | ----------------- | --------------------- |
| `$location` | `Location` | must be instance of `Biscolab\GoogleMaps\Object\Location` class | Required |
| `$params` | `array` | additional parameters to add to API call. You MUST set at least one of following values: `keyword`, `name`, `type` | `[]` |


Find further details about request fields (required, types, etc...) here: <a href="https://developers.google.com/places/web-service/search#PlaceSearchRequests" target="_blank">https://developers.google.com/places/web-service/search#PlaceSearchRequests</a>

## Text Search request

This service returns information about a set of places based on a string.

### Search by query

```php

use Biscolab\GoogleMaps\Fields\GoogleMapsRequestFields;

$query = "restaurants in Sydney";

$params = [
    ...
];

$result = $places->textSearch($query, $params);
```

`textSearch` method accepts 2 arguments

| Name | Type | Description | Default |
| ------------ | ----------------- | ----------------- | --------------------- |
| `$query` | `string` | The text string on which to search, for example: "restaurant" or "123 Main Street". | Required |
| `$params` | `array` | additional parameters to add to API call | `[]` |

Find further details about request fields (required, types, etc...) here: <a href="https://developers.google.com/places/web-service/search#TextSearchRequests" target="_blank">https://developers.google.com/places/web-service/search#TextSearchRequests</a>

## Place's Details

```php

use Biscolab\GoogleMaps\Fields\GoogleMapsRequestFields;

$place_id = "ChIJN1t_tDeuEmsRUsoyG83frY4";

$params = [
    ...
];

$result = $places->details($place_id, $params);
```

`details` method accepts 2 arguments

| Name | Type | Description | Default |
| ------------ | ----------------- | ----------------- | --------------------- |
| `$place_id` | `string` | A textual identifier that uniquely identifies a place, returned from a **Place Search**. | Required |
| `$params` | `array` | additional parameters to add to API call | `[]` |

Find further details about request fields (required, types, etc...) here: <a href="https://developers.google.com/places/web-service/details#PlaceDetailsRequests" target="_blank">https://developers.google.com/places/web-service/details#PlaceDetailsRequests</a>

## Use results
Results is/are a `Biscolab\GoogleMaps\Http\PlaceResultsCollection` object.  

### Current page
First thing you should know how many results there are in your `PlaceResultsCollection` using `count
` method.

```php
$number_of_results = $results->count();
```

To retrieve the first result you can use the `first` method:

```php
$first_result = $results->first();
```

`$first_result` is an instance of `PlaceResult` class and has the following methods:

| Method name | Return Type |
| --------------------- | --------------------- |
|`getPhotos()`  | `PhotoCollection` |
|`getGeometry()`    | `Geometry` |
|`getFormattedAddress()`    | `string` |
|`getName()`    | `string` |
|`getIcon()`    | `string` |
|`getId()`  | `string` |
|`getPlaceId()`     | `string` |
|`getReference()`   | `string` |
|`getVicinity()`   | `string` |
|`getTypes()`   | `array` |
|`getOpeningHours()`    | `array` |
|`getPriceLevel()`  | `int` |
|`getRating()`  | `float` |
|`getPermanentlyClose()`    | `bool` |
|`getPlusCode()`    | `array` |

### Next result page

Results can be paginated. How do you know id a result has more pages?

```php

// getNextPage method checks if $result has "next page"
$next_page_result = $result->getNextPage();

````

# Time Zone API

The Time Zone API provides time offset data for locations on the surface of the earth

<a href="https://developers.google.com/maps/documentation/timezone/start" target="_blank">Official Google TimeZone documentation</a>

## Initialize TimeZone Object

First of all replace `YOUR_API_KEY` with your actual API key.

```php
use Biscolab\GoogleMaps\Api\TimeZone;
use Biscolab\GoogleMaps\Enum\GoogleMapsApiConfigFields;

$timezone = new TimeZone([
	GoogleMapsApiConfigFields::KEY => 'YOUR_API_KEY'
]);

```

## Get result

Go to complete <a href="https://biscolab.com/google-maps-php-reference/Biscolab/GoogleMaps/Api/TimeZone.html" target="_blank">SDK reference</a>

### By location and timestamp

```php

$result = $timezone->get($location, $timestamp, $language);

```

`get` accepts 3 arguments

| Name         | Requested | Type                                | Description                                                                                                                                       |     |
| ------------ | --------- | ----------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------- | --- |
| `$location`  | Yes       | Biscolab\GoogleMaps\Object\Location | Represents the location to look up                                                                                                                |
| `$timestamp` | Yes       | integer                             | The Time Zone API uses the `$timestamp` to determine whether or not Daylight Savings should be applied, based on the time zone of the `$location` |
| `$language`  | No        | string                              | The language in which to return results                                                                                                           |

## Use result

Result is an instance of `Biscolab\GoogleMaps\Http\Result\TimeZoneResult` class and has the following methods:

| Method name         | Return Type |
| ------------------- | ----------- |
| `getDdstOffset()`   | `int`       |
| `getRawOffset()`    | `int`       |
| `getTimeZoneId()`   | `string`    |
| `getTimeZoneName()` | `string`    |
