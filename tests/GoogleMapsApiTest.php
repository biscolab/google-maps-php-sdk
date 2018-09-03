<?php
/**
 * Copyright (c) 2018 - present
 * GoogleMapsApi - GoogleMapsApiTest.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 31/8/2018
 * MIT license: https://github.com/biscolab/google-maps-php-sdk/blob/master/LICENSE
 */

namespace Biscolab\geocode\Tests;

use Biscolab\GoogleMaps\Enum\GoogleMapsApiConfigFields;
use Biscolab\GoogleMaps\GoogleMapsApi;
use PHPUnit\Framework\TestCase;

class GoogleMapsApiTest extends TestCase {

	/**
	 * @test
	 */
	public function checkApiKeyTest() {

		$gm = new GoogleMapsApi([
			GoogleMapsApiConfigFields::SERVICE_ENDPOINT => 'geocode',
			GoogleMapsApiConfigFields::KEY              => 'test_key'
		]);
		$this->assertEquals($gm->getKey(), 'test_key');
		$this->assertEquals($gm->getServiceEndpoint(), 'geocode');
	}
}
