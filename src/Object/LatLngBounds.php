<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - LatLngBounds.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Object;

use Biscolab\GoogleMaps\Abstracts\AbstractObject;
use Biscolab\GoogleMaps\Fields\LatLngBoundsFields;

/**
 * Class LatLngBounds
 * @package Biscolab\GoogleMaps\Object
 */
class LatLngBounds extends AbstractObject {

	/**
	 * @var LatLng
	 */
	protected $northeast = null;

	/**
	 * @var LatLng
	 */
	protected $southwest = null;

	/**
	 * @var array
	 */
	protected $typeCheck = [
		LatLngBoundsFields::NORTHEAST => LatLng::class,
		LatLngBoundsFields::SOUTHWEST => LatLng::class
	];

	/**
	 * @param LatLng $northeast
	 *
	 * @return LatLngBounds
	 */
	public function setNortheast(LatLng $northeast): LatLngBounds {

		$this->northeast = $northeast;

		return $this;
	}

	/**
	 * @return LatLng
	 */
	public function getNortheast(): LatLng {

		return $this->northeast;
	}

	/**
	 * @param LatLng $southwest
	 *
	 * @return LatLngBounds
	 */
	public function setSouthwest(LatLng $southwest): LatLngBounds {

		$this->southwest = $southwest;

		return $this;
	}

	/**
	 * @return LatLng
	 */
	public function getSouthwest(): LatLng {

		return $this->southwest;
	}

}