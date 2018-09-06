<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - LatLngTest.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\geocode\Tests;

use Biscolab\GoogleMaps\Fields\LatLngFields;
use Biscolab\GoogleMaps\Object\LatLng;
use PHPUnit\Framework\TestCase;

/**
 * Class LatLngTest
 * @package Biscolab\geocode\Tests
 */
class LatLngTest extends TestCase {

	/**
	 * @test
	 */
	public function testLatLngSetterGetter() {

		$lat_lng = new LatLng();

		$lat_lng->setLat(-50.09);
		$lat_lng->setLng(-100);

		$this->assertEquals(new LatLng([
			LatLngFields::LAT => -50.09,
			LatLngFields::LNG => -100,
		]), $lat_lng);

		$this->assertEquals(-50.09, $lat_lng->getLat());
		$this->assertEquals(-100, $lat_lng->getLng());

	}
}
