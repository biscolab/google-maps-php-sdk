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
 * @method Location getLocation
 * @method Viewport getViewport
 * @method string getLocationType
 * @method Geometry setLocation($args)
 * @method Geometry setViewport($args)
 * @method Geometry setLocationType($args)
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
}