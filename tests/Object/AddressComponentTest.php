<?php

/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - AddressComponentTest.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace BiscolabBiscolab\GoogleMaps\Tests\Object;

use Biscolab\GoogleMaps\Fields\AddressComponentFields;
use Biscolab\GoogleMaps\Object\Address;
use Biscolab\GoogleMaps\Object\AddressComponent;
use Biscolab\GoogleMaps\Tests\TestCase;

/**
 * Class AddressComponentTest
 * @package Biscolab\geocode\Tests
 */
class AddressComponentTest extends TestCase
{

	/**
	 * @var AddressComponent
	 */
	private $address_component_1;

	/**
	 * @var AddressComponent
	 */
	private $address_component_2;

	public function setUp(): void/* The :void return type declaration that should be here would cause a BC issue */
	{

		parent::setUp(); // TODO: Change the autogenerated stub

		$this->address_component_1 = new AddressComponent([
			AddressComponentFields::LONG_NAME  => 'Location Long name',
			AddressComponentFields::SHORT_NAME => 'Location Short name',
			AddressComponentFields::TYPES      => [
				'type 1',
				'type 2',
			]
		]);

		$this->address_component_2 = new AddressComponent([
			AddressComponentFields::LONG_NAME  => 'Location Long name (second)',
			AddressComponentFields::SHORT_NAME => 'Location Short name (second)',
			AddressComponentFields::TYPES      => [
				'type 3',
				'type 4',
			]
		]);
	}

	/**
	 * @test
	 */
	public function testAddressComponentInit()
	{

		$address_component = $this->address_component_1;

		$this->assertEquals('Location Long name', $address_component->getLongName());
		$this->assertEquals('Location Short name', $address_component->getShortName());
		$this->assertEquals([
			'type 1',
			'type 2',
		], $address_component->getTypes());

		$this->assertEquals(2, count($address_component->getTypes()));
		$this->assertArrayNotHasKey(3, $address_component->getTypes());
	}

	/**
	 * @test
	 */
	public function testAddressItems()
	{

		$address = new Address();

		$address->addItem($this->address_component_1);
		$address->addItem($this->address_component_2);

		$this->assertEquals(2, $address->count());
		$this->assertEquals($this->address_component_1, $address->first());
		$this->assertEquals($this->address_component_2, $address->last());
		$this->assertEquals(1, $address->getLastIndex());
	}

	/**
	 * @test
	 */
	public function testAddressIndex()
	{

		$address = new Address();

		$address->addItem($this->address_component_1);
		$address->addItem($this->address_component_2);

		$this->assertEquals($this->address_component_1, $address->current());

		$address->seek(1);
		$this->assertEquals($this->address_component_2, $address->current());
	}
}
