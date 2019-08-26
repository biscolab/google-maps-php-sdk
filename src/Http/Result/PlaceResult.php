<?php
/**
 * Copyright (c) 2019 - present
 * Google Maps PHP - PlaceResult.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 1/8/2019
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Http\Result;

use Biscolab\GoogleMaps\Fields\GoogleMapsResultFields;
use Biscolab\GoogleMaps\Http\GoogleMapsResult;
use Biscolab\GoogleMaps\Object\Geometry;

/**
 * Class PlaceResult
 *
 * @since   0.5.0
 */
class PlaceResult extends GoogleMapsResult
{

	/**
	 * @var null|string
	 */
	protected $geometry = null;

	/**
	 * @var null|string
	 */
	protected $icon = null;

	/**
	 * @var null|string
	 */
	protected $id = null;

	/**
	 * @var null|array
	 */
	protected $photos = null;

	/**
	 * @var null|string
	 */
	protected $place_id = null;

	/**
	 * @var null|string
	 */
	protected $reference = null;

	/**
	 * @var null|string
	 */
	protected $vicinity = null;

	/**
	 * @var null|array
	 */
	protected $types = null;

	/**
	 * @var null|string
	 */
	protected $opening_hours = null;

	/**
	 * @var array
	 */
	protected $typeCheck = [
		GoogleMapsResultFields::GEOMETRY           => Geometry::class,
		GoogleMapsResultFields::ICON               => 'string',
		GoogleMapsResultFields::ID                 => 'string',
		GoogleMapsResultFields::PHOTOS             => 'array',
		GoogleMapsResultFields::PLACE_ID           => 'string',
		GoogleMapsResultFields::REFERENCE          => 'string',
		GoogleMapsResultFields::VICINITY           => 'string',
		GoogleMapsResultFields::TYPES              => 'array',
		GoogleMapsResultFields::OPENING_HOURS      => 'json',
		GoogleMapsResultFields::PRICE_LEVEL        => 'int',
		GoogleMapsResultFields::RATING             => 'float',
		GoogleMapsResultFields::PERMANENTLY_CLOSED => 'bool',
		GoogleMapsResultFields::PLUS_CODE          => 'array',
	];

}