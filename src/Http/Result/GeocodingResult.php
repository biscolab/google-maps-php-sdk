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
 *
 * @method Address getAddressComponents()
 * @method string getFormattedAddress()
 * @method Geometry getGeometry()
 * @method string getPlaceId()
 * @method array getTypes()
 * @method GeocodingResult setAddressComponents($args)
 * @method GeocodingResult setFormattedAddress($args)
 * @method GeocodingResult setGeometry($args)
 * @method GeocodingResult setPlaceId($args)
 * @method GeocodingResult setTypes($args)
 * @package Biscolab\GoogleMaps\Http\Result
 */
class GeocodingResult extends GoogleMapsResult
{

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
	public function getAddress(): Address
	{

		return $this->getAddressComponents();
	}

}