<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - Geometry.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Object;

use Biscolab\GoogleMaps\Abstracts\AbstractObject;
use Biscolab\GoogleMaps\Fields\GeometryFields;

/**
 * Class Geometry
 * @package Biscolab\GoogleMaps\Object
 */
class Geometry extends AbstractObject {

	/**
	 * @var Location
	 */
	protected $location = null;

	/**
	 * @var Viewport
	 */
	protected $viewport = null;

	/**
	 * @var string
	 */
	protected $location_type = null;

	/**
	 * @var array
	 */
	protected $typeCheck = [
		GeometryFields::LOCATION      => Location::class,
		GeometryFields::VIEWPORT      => Viewport::class,
		GeometryFields::LOCATION_TYPE => 'string'
	];

	/**
	 * @return Location
	 */
	public function getLocation(): Location {

		return $this->location;
	}

	/**
	 * @return Viewport
	 */
	public function getViewport(): Viewport {

		return $this->viewport;
	}

	/**
	 * @return string
	 */
	public function getLocationType(): string {

		return $this->location_type;
	}

	/**
	 * @param Location $location
	 *
	 * @return Geometry
	 */
	public function setLocation(Location $location): Geometry {

		$this->location = $location;

		return $this;
	}

	/**
	 * @param Viewport $viewport
	 *
	 * @return Geometry
	 */
	public function setViewport(Viewport $viewport): Geometry {

		$this->viewport = $viewport;

		return $this;
	}

	/**
	 * @param string $location_type
	 *
	 * @return Geometry
	 */
	public function setLocationType(string $location_type): Geometry {

		$this->location_type = $location_type;

		return $this;
	}

}