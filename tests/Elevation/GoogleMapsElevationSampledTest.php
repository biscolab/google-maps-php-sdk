<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - GoogleMapsElevationSampledTest.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 15/10/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\geocode\Tests;

use Biscolab\GoogleMaps\Api\Elevation;
use Biscolab\GoogleMaps\Enum\GoogleMapsApiConfigFields;
use Biscolab\GoogleMaps\Exception\InvalidArgumentException;
use Biscolab\GoogleMaps\Fields\LatLngFields;
use Biscolab\GoogleMaps\Http\GoogleMapsResponse;
use Biscolab\GoogleMaps\Http\Result\ElevationResultsCollection;
use Biscolab\GoogleMaps\Object\Location;
use Biscolab\GoogleMaps\Object\Path;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class GoogleMapsElevationSampledTest extends TestCase {

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

	public function setUp() {

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
				1 => [
					'elevation'  => -1825.4562988281,
					'resolution' => 610.81292724609,
					'location'   => [
						'lat' => 77.046330732548,
						'lng' => -160.05321067231,
					],
				],
				2 => [
					'elevation'  => 2013.5008544922,
					'resolution' => 152.70323181152,
					'location'   => [
						'lat' => 50.123,
						'lng' => 99.456,
					],
				],
			],
			'status'  => 'OK',
		];

		// Elevation with API key
		// Remember to associate a valid payment method to your project
		$this->elevation_with_key = new Elevation([
			GoogleMapsApiConfigFields::KEY => 'MyKey'
		]);

		$this->mock_response_ok = new Response(200, [], \GuzzleHttp\json_encode($default_response_OK));
	}

	public function testCheckElevationSampledResponseOk() {

		$response = new GoogleMapsResponse($this->mock_response_ok);

		/** @var ElevationResultsCollection $result */
		$result = new ElevationResultsCollection($response->getResults());

		$this->assertNotNull($result);

		$this->assertEquals(3, $result->count());

		$array_result = $result->first()->toArray();
		// Response array keys
		$this->assertArrayHasKey('location', $array_result);
		$this->assertArrayHasKey('elevation', $array_result);
		$this->assertArrayHasKey('resolution', $array_result);

		$this->assertEquals(200, $response->getHttpStatusCode());

	}

	public function testExceptionIfPathItemsLessThanTwoArray() {

		$this->expectException(InvalidArgumentException::class);
		$this->elevation_with_key->getBySampledPath([
			new Location([
				LatLngFields::LAT => 39.73915360,
				LatLngFields::LNG => -104.9847034,
			])], 2);
	}

	public function testExceptionIfPathItemsLessThanTwoPath() {

		$this->expectException(InvalidArgumentException::class);
		$path = new Path([
			new Location([
				LatLngFields::LAT => 39.73915360,
				LatLngFields::LNG => -104.9847034,
			])]);
		$this->elevation_with_key->getBySampledPath($path, 2);
	}

	public function testExceptionIfSamplesLessThanOne() {

		$this->expectException(InvalidArgumentException::class);
		$this->elevation_with_key->getBySampledPath([
			new Location([
				LatLngFields::LAT => 39.73915360,
				LatLngFields::LNG => -104.9847034,
			],
			new Location([
				LatLngFields::LAT => 50.123,
				LatLngFields::LNG => 99.456,
			]))], 0);
	}

}
