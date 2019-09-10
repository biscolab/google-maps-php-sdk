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
 * @method LatLng setLat($args)
 * @method LatLng setLng($args)
 * @package Biscolab\GoogleMaps\Object
 */
class LatLngBounds extends AbstractObject
{

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

}