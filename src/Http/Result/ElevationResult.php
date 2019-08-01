<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - ElevationResult.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 28/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Http\Result;

use Biscolab\GoogleMaps\Fields\GoogleMapsResultFields;
use Biscolab\GoogleMaps\Http\GoogleMapsResult;
use Biscolab\GoogleMaps\Object\Location;

/**
 * Class ElevationResult
 *
 * @method float getElevation
 * @method Location getLocation
 * @method float getResolution
 * @method ElevationResult setElevation($args)
 * @method ElevationResult setLocation($args)
 * @method ElevationResult setResolution($args)
 * @package Biscolab\GoogleMaps\Http\Result
 *
 * @since   0.3.0
 */
class ElevationResult extends GoogleMapsResult
{

	/**
	 * @var float
	 */
	protected $elevation = null;

	/**
	 * @var Location
	 */
	protected $location = null;

	/**
	 * @var float
	 */
	protected $resolution = null;

	/**
	 * @var array
	 */
	protected $typeCheck = [
		GoogleMapsResultFields::LOCATION   => Location::class,
		GoogleMapsResultFields::ELEVATION  => 'float',
		GoogleMapsResultFields::RESOLUTION => 'float',
	];

}