<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - GoogleMapsElevationPositionalTesttionalTest.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 28/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\geocode\Tests;

use Biscolab\GoogleMaps\Api\Elevation;
use Biscolab\GoogleMaps\Enum\GoogleMapsApiConfigFields;
use Biscolab\GoogleMaps\Exception\RequestException;
use Biscolab\GoogleMaps\Fields\LatLngFields;
use Biscolab\GoogleMaps\Http\GoogleMapsResponse;
use Biscolab\GoogleMaps\Http\Result\ElevationResultsCollection;
use Biscolab\GoogleMaps\Object\Location;
use Biscolab\GoogleMaps\Values\GoogleMapsResponseStatusValues;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class GoogleMapsElevationPositionalTest extends TestCase
{

	/**
	 * @var Elevation
	 */
	protected $elevation_no_key;

	/**
	 * @var Elevation
	 */
	protected $elevation_with_key;

	/**
	 * @var Elevation
	 */
	protected $elevation_with_sensor;

	/**
	 * @var Response
	 */
	protected $mock_response_ok;

	/**
	 * @var Response
	 */
	protected $mock_response_ko;

	public function setUp()
	{

		// This is the sample value from Google Maps official documentation
		$default_response_OK = [
			'results' => [
				0 => [
					'elevation'  => 1608.6379394531,
					'resolution' => 4.7719759941101,
					'location'   => [
						'lat' => 39.7391536,
						'lng' => -104.9847034,
					],
				],
			],
			'status'  => 'OK',
		];

		$default_response_KO = array_merge($default_response_OK, [
			'status' => GoogleMapsResponseStatusValues::REQUEST_DENIED
		]);

		// Elevation with API key
		// Remember to associate a valid payment method to your project
		$this->elevation_with_key = new Elevation([
			GoogleMapsApiConfigFields::KEY => 'MyKey'
		]);

		// Elevation with sensor
		$this->elevation_with_sensor = new Elevation([
			GoogleMapsApiConfigFields::SENSOR => 'true'
		]);

		// Elevation with NO API key
		$this->elevation_no_key = new Elevation();

		$this->mock_response_ok = new Response(200, [], \GuzzleHttp\json_encode($default_response_OK));
		$this->mock_response_ko = new Response(200, [], \GuzzleHttp\json_encode($default_response_KO));
	}

	public function testCheckElevationConfig()
	{

		$this->assertEquals(Elevation::SERVICE_ENDPOINT,
			$this->elevation_with_key->getGoogleMapsApi()->getServiceEndpoint());
		$this->assertEquals('MyKey', $this->elevation_with_key->getGoogleMapsApi()->getKey());
		$this->assertEquals('', $this->elevation_no_key->getGoogleMapsApi()->getKey());
	}

	public function testCheckElevationConfigWithSensor()
	{

		$this->assertEquals('true', $this->elevation_with_sensor->getGoogleMapsApi()->getSensor());
	}

	public function testParseLocationsSingle()
	{

		$parsed_locations = $this->elevation_with_key->parseLocations(new Location([
			LatLngFields::LAT => 39.73915360,
			LatLngFields::LNG => -104.98470340,
		]));

		$this->assertEquals('39.7391536,-104.9847034', $parsed_locations);
	}

	public function testParseLocationsMulti()
	{

		$parsed_locations = $this->elevation_with_key->parseLocations([
			new Location([
				LatLngFields::LAT => 39.73915360,
				LatLngFields::LNG => -104.98470340,
			]),
			new Location([
				LatLngFields::LAT => 50.123,
				LatLngFields::LNG => 99.456,
			])
		]);

		$this->assertEquals('39.7391536,-104.9847034|50.123,99.456', $parsed_locations);
	}

	public function testCheckElevationResponseOk()
	{

		$response = new GoogleMapsResponse($this->mock_response_ok);

		/** @var ElevationResultsCollection $result */
		$result = new ElevationResultsCollection($response->getResults());

		$this->assertNotNull($result);

		$array_result = $result->first()->toArray();
		// Response array keys
		$this->assertArrayHasKey('location', $array_result);
		$this->assertArrayHasKey('elevation', $array_result);
		$this->assertArrayHasKey('resolution', $array_result);

		$this->assertEquals(200, $response->getHttpStatusCode());

	}

	public function testResponseKO()
	{

		$this->expectException(RequestException::class);
		new GoogleMapsResponse($this->mock_response_ko);
	}

}
