<?php

/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - GoogleMapsGeocodingHttpTestp
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace BiscolabBiscolab\GoogleMaps\Tests\Geocoding;

use Biscolab\GoogleMaps\Api\Geocoding;
use Biscolab\GoogleMaps\Enum\GoogleMapsApiConfigFields;
use Biscolab\GoogleMaps\Fields\LatLngFields;
use Biscolab\GoogleMaps\Http\Result\GeocodingResultsCollection;
use Biscolab\GoogleMaps\Object\LatLng;
use Biscolab\GoogleMaps\Tests\TestCase;

class GoogleMapsGeocodingHttpTest extends TestCase
{

	/**
	 * @var Geocoding
	 */
	protected $geocoding_no_key;

	/**
	 * @var Geocoding
	 */
	protected $geocoding_with_key;

	/**
	 * @var Geocoding
	 */
	protected $geocoding_with_sensor;

	public function setUp()
	{

		$this->geocoding_with_key = new Geocoding([
			GoogleMapsApiConfigFields::KEY => getenv("API_KEY")
		]);

		$this->geocoding_with_sensor = new Geocoding([
			GoogleMapsApiConfigFields::SENSOR => 'true'
		]);

		$this->geocoding_no_key = new Geocoding();
	}

	/**
	 * @test
	 */
	public function testCheckGeocodingConfig()
	{

		$this->assertEquals(
			Geocoding::SERVICE_ENDPOINT,
			$this->geocoding_with_key->getGoogleMapsApi()->getServiceEndpoint()
		);
		$this->assertEquals(
			getenv("API_KEY"),
			$this->geocoding_with_key->getGoogleMapsApi()->getKey()
		);
		$this->assertEquals('', $this->geocoding_no_key->getGoogleMapsApi()->getKey());
	}

	/**
	 * @test
	 */
	public function testCheckGeocodingConfigWithSensor()
	{

		$this->assertEquals('true', $this->geocoding_with_sensor->getGoogleMapsApi()->getSensor());
	}

	/**
	 * @test
	 * @group http
	 */
	public function testCheckGeocodingFromAddress()
	{

		/** @var GeocodingResultsCollection $result */
		$result = $this->geocoding_with_key->getByAddress('sliema');

		$this->assertNotNull($result);

		$array_result = $result->first()->toArray();
		$this->assertArrayHasKey('address_components', $array_result);
		$this->assertArrayHasKey('geometry', $array_result);
		$this->assertArrayHasKey('place_id', $array_result);
		$this->assertArrayHasKey('formatted_address', $array_result);
		$this->assertArrayHasKey('types', $array_result);

		$this->assertArrayHasKey('location', $array_result['geometry']);
	}

	/**
	 * @test
	 * @group http
	 */
	public function testCheckGeocodingFromAddressWithRegion()
	{

		/** @var GeocodingResultsCollection $result */
		$result = $this->geocoding_with_key->getByAddress('sliema', 'es');

		$this->assertNotNull($result);

		$array_result = $result->first()->toArray();
		$this->assertArrayHasKey('address_components', $array_result);
		$this->assertArrayHasKey('geometry', $array_result);
		$this->assertArrayHasKey('place_id', $array_result);
		$this->assertArrayHasKey('formatted_address', $array_result);
		$this->assertArrayHasKey('types', $array_result);

		$this->assertArrayHasKey('location', $array_result['geometry']);
	}

	/**
	 * @test
	 * @group http
	 */
	public function testCheckGeocodingFromAddressWithLAnguage()
	{

		/** @var GeocodingResultsCollection $result */
		$result = $this->geocoding_with_key->setLanguage('es')->getByAddress('sliema');

		$this->assertNotNull($result);

		$array_result = $result->first()->toArray();
		$this->assertArrayHasKey('address_components', $array_result);
		$this->assertArrayHasKey('geometry', $array_result);
		$this->assertArrayHasKey('place_id', $array_result);
		$this->assertArrayHasKey('formatted_address', $array_result);
		$this->assertArrayHasKey('types', $array_result);

		$this->assertArrayHasKey('location', $array_result['geometry']);
	}

	/**
	 * @test
	 * @group http
	 */
	public function testCheckGeocodingFromLatLng()
	{

		/** @var GeocodingResultsCollection $result */
		$result = $this->geocoding_with_key->getReverse(new LatLng([
			LatLngFields::LAT => '12',
			LatLngFields::LNG => '22',
		]));

		$this->assertNotNull($result);

		$array_result = $result->first()->toArray();
		$this->assertArrayHasKey('address_components', $array_result);
		$this->assertArrayHasKey('geometry', $array_result);
		$this->assertArrayHasKey('place_id', $array_result);
		$this->assertArrayHasKey('formatted_address', $array_result);
		$this->assertArrayHasKey('types', $array_result);
	}

	/**
	 * @test
	 * @group http
	 */
	public function testCheckGeocodingFromLatLngWithLanguage()
	{

		/** @var GeocodingResultsCollection $result */
		$result = $this->geocoding_with_key->setLanguage('es')->getReverse(new LatLng([
			LatLngFields::LAT => '12',
			LatLngFields::LNG => '22',
		]));

		$this->assertNotNull($result);

		$array_result = $result->first()->toArray();
		$this->assertArrayHasKey('address_components', $array_result);
		$this->assertArrayHasKey('geometry', $array_result);
		$this->assertArrayHasKey('place_id', $array_result);
		$this->assertArrayHasKey('formatted_address', $array_result);
		$this->assertArrayHasKey('types', $array_result);
	}

	/**
	 * @test
	 * @group http
	 */
	public function testCheckGeocodingFromPlaceId()
	{

		/** @var GeocodingResultsCollection $result */
		$result = $this->geocoding_with_key->getByPlaceId('ChIJd8BlQ2BZwokRAFUEcm_qrcA');

		$this->assertNotNull($result);

		$array_result = $result->first()->toArray();
		$this->assertArrayHasKey('address_components', $array_result);
		$this->assertArrayHasKey('geometry', $array_result);
		$this->assertArrayHasKey('place_id', $array_result);
		$this->assertArrayHasKey('formatted_address', $array_result);
		$this->assertArrayHasKey('types', $array_result);
	}
}
