<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - GoogleMapsApiTest.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\geocode\Tests;

use Biscolab\GoogleMaps\Enum\GoogleMapsApiConfigFields;
use Biscolab\GoogleMaps\GoogleMapsApi;
use Biscolab\GoogleMaps\Tests\TestCase;

class GoogleMapsApiTest extends TestCase
{

	/**
	 * @test
	 */
	public function checkGeocoderApiKeyTest()
	{

		$gm = new GoogleMapsApi([
			GoogleMapsApiConfigFields::SERVICE_ENDPOINT => 'geocode',
			GoogleMapsApiConfigFields::KEY              => 'test_key'
		]);
		$this->assertEquals($gm->getKey(), 'test_key');
		$this->assertEquals($gm->getServiceEndpoint(), 'geocode');
	}

	/**
	 * @test
	 */
	public function checkElevationApiKeyTest()
	{

		$gm = new GoogleMapsApi([
			GoogleMapsApiConfigFields::SERVICE_ENDPOINT => 'elevation',
			GoogleMapsApiConfigFields::KEY              => 'test_key'
		]);
		$this->assertEquals($gm->getKey(), 'test_key');
		$this->assertEquals($gm->getServiceEndpoint(), 'elevation');
	}

	/**
	 * @test
	 */
	public function checkPlaceApiKeyTest()
	{

		$gm = new GoogleMapsApi([
			GoogleMapsApiConfigFields::SERVICE_ENDPOINT => 'place',
			GoogleMapsApiConfigFields::KEY              => 'test_key'
		]);
		$this->assertEquals($gm->getKey(), 'test_key');
		$this->assertEquals($gm->getServiceEndpoint(), 'place');
	}

}
