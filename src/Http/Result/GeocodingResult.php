<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - GeocodingResult.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Http\Result;

use Biscolab\GoogleMaps\Fields\GoogleMapsResultFields;
use Biscolab\GoogleMaps\Http\GoogleMapsResult;
use Biscolab\GoogleMaps\Object\Address;
use Biscolab\GoogleMaps\Object\Geometry;

/**
 * Class GeocodingResult
 *
 * Standard and Reverse Geocoding have the same Response/Result format
 * @package Biscolab\GoogleMaps\Http\Result
 */
class GeocodingResult extends GoogleMapsResult {

	/**
	 * @var Address
	 */
	protected $address_components = null;

	/**
	 * @var string
	 */
	protected $formatted_address = null;

	/**
	 * @var Geometry
	 */
	protected $geometry = null;

	/**
	 * @var string
	 */
	protected $place_id = null;

	/**
	 * @var array
	 */
	protected $types = null;

	/**
	 * @var array
	 */
	protected $typeCheck = [
		GoogleMapsResultFields::GEOMETRY           => Geometry::class,
		GoogleMapsResultFields::ADDRESS_COMPONENTS => Address::class,
		GoogleMapsResultFields::FORMATTED_ADDRESS  => 'string',
		GoogleMapsResultFields::PLACE_ID           => 'string',
		GoogleMapsResultFields::TYPES              => 'array'
	];

	/**
	 * @return Address
	 */
	public function getAddressComponents(): Address {

		return $this->address_components;
	}

	/**
	 * @return Address
	 */
	public function getAddress(): Address {

		return $this->getAddressComponents();
	}

	/**
	 * @return string
	 */
	public function getFormattedAddress(): string {

		return $this->formatted_address;
	}

	/**
	 * @param string $formatted_address
	 *
	 * @return GeocodingResult
	 */
	public function setFormattedAddress(string $formatted_address): GeocodingResult {

		$this->formatted_address = $formatted_address;

		return $this;
	}

	/**
	 * @return Geometry
	 */
	public function getGeometry(): Geometry {

		return $this->geometry;
	}

	/**
	 * @param Geometry $geometry
	 *
	 * @return GeocodingResult
	 */
	public function setGeometry(Geometry $geometry): GeocodingResult {

		$this->geometry = $geometry;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getPlaceId(): string {

		return $this->place_id;
	}

	/**
	 * @param string $place_id
	 *
	 * @return GeocodingResult
	 */
	public function setPlaceId(string $place_id): GeocodingResult {

		$this->place_id = $place_id;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getTypes(): array {

		return $this->types;
	}

	/**
	 * @param array $types
	 *
	 * @return GeocodingResult
	 */
	public function setTypes(array $types): GeocodingResult {

		$this->types = $types;

		return $this;
	}

}