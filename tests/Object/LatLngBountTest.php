<?php

/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - LatLngBountTest.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace BiscolabBiscolab\GoogleMaps\Tests\Object;

use Biscolab\GoogleMaps\Fields\LatLngBoundsFields;
use Biscolab\GoogleMaps\Fields\LatLngFields;
use Biscolab\GoogleMaps\Object\LatLng;
use Biscolab\GoogleMaps\Object\LatLngBounds;
use Biscolab\GoogleMaps\Tests\TestCase;

/**
 * Class LatLngBountTest
 * @package Biscolab\geocode\Tests
 */
class LatLngBountTest extends TestCase
{

	/**
	 * @var LatLngBounds
	 */
	private $lat_lng_bounds;

	public function setUp(): void/* The :void return type declaration that should be here would cause a BC issue */
	{

		parent::setUp(); // TODO: Change the autogenerated stub

		$this->lat_lng_bounds = new LatLngBounds();
	}

	/**
	 * @test
	 */
	public function testLatLngBoundSetterGetter()
	{

		$lat_lng_bounds = $this->lat_lng_bounds;

		$southwest = new LatLng([
			LatLngFields::LAT => 20.89,
			LatLngFields::LNG => -40.82,
		]);

		$northeast = new LatLng([
			LatLngFields::LAT => 22.73,
			LatLngFields::LNG => 3.6370,
		]);

		$lat_lng_bounds->setSouthwest($southwest);
		$lat_lng_bounds->setNortheast($northeast);

		$this->assertEquals(new LatLngBounds([
			LatLngBoundsFields::SOUTHWEST => [
				LatLngFields::LAT => 20.89,
				LatLngFields::LNG => -40.82,
			],
			LatLngBoundsFields::NORTHEAST => [
				LatLngFields::LAT => 22.73,
				LatLngFields::LNG => 3.6370,
			],
		]), $lat_lng_bounds);
	}
}
