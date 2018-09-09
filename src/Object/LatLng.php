<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - LatLng.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Object;

use Biscolab\GoogleMaps\Abstracts\AbstractObject;
use Biscolab\GoogleMaps\Fields\LatLngFields;

/**
 * Class LatLng
 * @method LatLng setLat($args)
 * @method LatLng setLng($args)
 * @package Biscolab\GoogleMaps\Object
 */
class LatLng extends AbstractObject {

	/**
	 * @var float
	 */
	protected $lat = 0;

	/**
	 * @var float
	 */
	protected $lng = 0;

	/**
	 * @var array
	 */
	protected $typeCheck = [
		LatLngFields::LAT => 'float',
		LatLngFields::LNG => 'float',
	];

	/**
	 * Return the latitude, 0 if null
	 *
	 * @return string
	 */
	public function getLat(): string {

		return $this->lat ?? 0;
	}

	/**
	 * Return the longitude, 0 if null
	 *
	 * @return string
	 */
	public function getLng(): string {

		return $this->lng ?? 0;
	}

	/**
	 * @return string
	 */
	public function __toString(): string {

		return implode(',', [
			$this->getLat(),
			$this->getLng()
		]);
	}

}