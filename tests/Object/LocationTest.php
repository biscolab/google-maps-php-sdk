<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - LocationTest.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace BiscolabBiscolab\GoogleMaps\Tests\Object;

use Biscolab\GoogleMaps\Fields\LatLngFields;
use Biscolab\GoogleMaps\Object\Location;
use Biscolab\GoogleMaps\Tests\TestCase;

/**
 * Class LocationTest
 * @package Biscolab\geocode\Tests
 */
class LocationTest extends TestCase
{

	/**
	 * @test
	 */
	public function testLocationSetterGetter()
	{

		$lat_lng = new Location();

		$lat_lng->setLat(-50.09);
		$lat_lng->setLng(-100);

		$this->assertEquals(new Location([
			LatLngFields::LAT => -50.09,
			LatLngFields::LNG => -100,
		]), $lat_lng);

		$this->assertEquals(-50.09, $lat_lng->getLat());
		$this->assertEquals(-100, $lat_lng->getLng());

	}
}
