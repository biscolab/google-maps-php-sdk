<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - GeometryTest.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\geocode\Tests;

use Biscolab\GoogleMaps\Fields\LatLngFields;
use Biscolab\GoogleMaps\Object\Geometry;
use Biscolab\GoogleMaps\Object\Location;
use PHPUnit\Framework\TestCase;

class GeometryTest extends TestCase {


	public function testGeometrySetterGetter() {

		$geometry = new Geometry();

		$geometry->setLocation(new Location([
			LatLngFields::LAT => 20,
			LatLngFields::LNG => 33,
		]));

		$this->assertEquals(new Location([
			LatLngFields::LAT => 20,
			LatLngFields::LNG => 33,
		]), $geometry->getLocation());

		$this->assertEquals(20, $geometry->getLocation()->getLat());
		$this->assertEquals(33, $geometry->getLocation()->getLng());

	}
}
