<?php

/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - GeometryTest.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace BiscolabBiscolab\GoogleMaps\Tests\Object;

use Biscolab\GoogleMaps\Fields\LatLngFields;
use Biscolab\GoogleMaps\Object\Geometry;
use Biscolab\GoogleMaps\Object\Location;
use Biscolab\GoogleMaps\Values\GeometryLocationTypeValues;
use Biscolab\GoogleMaps\Tests\TestCase;

/**
 * Class GeometryTest
 * @package Biscolab\geocode\Tests
 */
class GeometryTest extends TestCase
{

	/**
	 * @var Geometry
	 */
	protected $geometry;

	public function setUp(): void/* The :void return type declaration that should be here would cause a BC issue */
	{

		parent::setUp(); // TODO: Change the autogenerated stub

		$this->geometry = new Geometry();
	}

	/**
	 * @test
	 */
	public function testLocationSetterGetter()
	{

		$geometry = $this->geometry;

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

	/**
	 * @test
	 */
	public function testLocationSetterGetterViaArray()
	{

		$geometry = $this->geometry;

		$geometry->setLocation([
			LatLngFields::LAT => 20,
			LatLngFields::LNG => 33,
		]);

		$this->assertEquals(new Location([
			LatLngFields::LAT => 20,
			LatLngFields::LNG => 33,
		]), $geometry->getLocation());

		$this->assertEquals(20, $geometry->getLocation()->getLat());
		$this->assertEquals(33, $geometry->getLocation()->getLng());
	}

	/**
	 * @tets
	 */
	public function testLocationTypeSetterGetter()
	{

		$geometry = $this->geometry;

		$geometry->setLocationType(GeometryLocationTypeValues::ROOFTOP);

		$this->assertEquals(GeometryLocationTypeValues::ROOFTOP, $geometry->getLocationType());
	}
}
