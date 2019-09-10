<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - GoogleMapsElevationHttpTest.php author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 28/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\geocode\Tests\Elevation;

use Biscolab\GoogleMaps\Api\Elevation;
use Biscolab\GoogleMaps\Enum\GoogleMapsApiConfigFields;
use Biscolab\GoogleMaps\Fields\LatLngFields;
use Biscolab\GoogleMaps\Object\Location;
use Biscolab\GoogleMaps\Object\Path;
use Biscolab\GoogleMaps\Tests\TestCase;

class GoogleMapsElevationHttpTest extends TestCase
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

	public function setUp()
	{

		$this->elevation_with_key = new Elevation([
			GoogleMapsApiConfigFields::KEY => getenv("API_KEY")
		]);

		$this->elevation_with_sensor = new Elevation([
			GoogleMapsApiConfigFields::SENSOR => 'true'
		]);

		$this->elevation_no_key = new Elevation();
	}

	/**
	 * @test
	 */
	public function testCheckElevationConfig()
	{

		$this->assertEquals(Elevation::SERVICE_ENDPOINT,
			$this->elevation_with_key->getGoogleMapsApi()->getServiceEndpoint());
		$this->assertEquals(getenv("API_KEY"),
			$this->elevation_with_key->getGoogleMapsApi()->getKey());
		$this->assertEquals('', $this->elevation_no_key->getGoogleMapsApi()->getKey());
	}

	/**
	 * @test
	 */
	public function testCheckElevationConfigWithSensor()
	{

		$this->assertEquals('true', $this->elevation_with_sensor->getGoogleMapsApi()->getSensor());
	}

	/**
	 * @test
	 * @group http
	 */
	public function testCheckGeocodingFromLocation()
	{

		$result = $this->elevation_with_key->getByLocations(new Location([
			LatLngFields::LAT => 39.73915360,
			LatLngFields::LNG => -104.98470340,
		]));

		$this->assertNotNull($result);

		$array_result = $result->first()->toArray();
		$this->assertArrayHasKey('elevation', $array_result);
		$this->assertArrayHasKey('location', $array_result);
		$this->assertArrayHasKey('resolution', $array_result);

		$this->assertEquals(39.73915360, $array_result['location']['lat']);
		$this->assertEquals(-104.9847034, $array_result['location']['lng']);
		$this->assertEquals(1608.6379394531, $array_result['elevation']);

	}

	/**
	 * @test
	 * @group http
	 */
	public function testCheckGeocodingFromLocationMulti()
	{

		$result = $this->elevation_with_key->getByLocations([
			new Location([
				LatLngFields::LAT => 39.73915360,
				LatLngFields::LNG => -104.98470340,
			]),
			new Location([
				LatLngFields::LAT => 50.123,
				LatLngFields::LNG => 99.456,
			])
		]);

		$this->assertNotNull($result);

		$array_first_result = $result->first()->toArray();
		$array_last_result = $result->last()->toArray();

		$this->assertArrayHasKey('elevation', $array_first_result);
		$this->assertArrayHasKey('location', $array_first_result);
		$this->assertArrayHasKey('resolution', $array_first_result);

		$this->assertEquals(39.73915360, $array_first_result['location']['lat']);
		$this->assertEquals(-104.9847034, $array_first_result['location']['lng']);
		$this->assertEquals(1608.6379394531, $array_first_result['elevation']);

		$this->assertArrayHasKey('elevation', $array_last_result);
		$this->assertArrayHasKey('location', $array_last_result);
		$this->assertArrayHasKey('resolution', $array_last_result);

		$this->assertEquals(50.123, $array_last_result['location']['lat']);
		$this->assertEquals(99.456, $array_last_result['location']['lng']);
		$this->assertEquals(2013.5008544922, $array_last_result['elevation']);

	}

	/**
	 * @test
	 * @group http
	 */
	public function testCheckElevationBySampledPath()
	{

		$result = $this->elevation_with_key->getBySampledPath([
			new Location([
				LatLngFields::LAT => 39.73915360,
				LatLngFields::LNG => -104.98470340,
			]),
			new Location([
				LatLngFields::LAT => 50.123,
				LatLngFields::LNG => 99.456,
			])
		], 3);

		$this->assertNotNull($result);

		$array_first_result = $result->first()->toArray();
		$array_last_result = $result->last()->toArray();

		$this->assertArrayHasKey('elevation', $array_first_result);
		$this->assertArrayHasKey('location', $array_first_result);
		$this->assertArrayHasKey('resolution', $array_first_result);

		$this->assertEquals(39.73915360, $array_first_result['location']['lat']);
		$this->assertEquals(-104.9847034, $array_first_result['location']['lng']);
		$this->assertEquals(1608.6379394531, $array_first_result['elevation']);

		$this->assertArrayHasKey('elevation', $array_last_result);
		$this->assertArrayHasKey('location', $array_last_result);
		$this->assertArrayHasKey('resolution', $array_last_result);

		$this->assertEquals(50.123, $array_last_result['location']['lat']);
		$this->assertEquals(99.456, $array_last_result['location']['lng']);
		$this->assertEquals(2013.5008544922, $array_last_result['elevation']);

	}

	/**
	 * @test
	 * @group http
	 */
	public function testCheckElevationBySampledPathPAssingPath()
	{

		$path = new Path([
			new Location([
				LatLngFields::LAT => 39.73915360,
				LatLngFields::LNG => -104.98470340,
			]),
			new Location([
				LatLngFields::LAT => 50.123,
				LatLngFields::LNG => 99.456,
			])
		]);

		$result = $this->elevation_with_key->getBySampledPath($path, 3);

		$this->assertNotNull($result);

		$array_first_result = $result->first()->toArray();
		$array_last_result = $result->last()->toArray();

		$this->assertArrayHasKey('elevation', $array_first_result);
		$this->assertArrayHasKey('location', $array_first_result);
		$this->assertArrayHasKey('resolution', $array_first_result);

		$this->assertEquals(39.73915360, $array_first_result['location']['lat']);
		$this->assertEquals(-104.9847034, $array_first_result['location']['lng']);
		$this->assertEquals(1608.6379394531, $array_first_result['elevation']);

		$this->assertArrayHasKey('elevation', $array_last_result);
		$this->assertArrayHasKey('location', $array_last_result);
		$this->assertArrayHasKey('resolution', $array_last_result);

		$this->assertEquals(50.123, $array_last_result['location']['lat']);
		$this->assertEquals(99.456, $array_last_result['location']['lng']);
		$this->assertEquals(2013.5008544922, $array_last_result['elevation']);

	}
}
