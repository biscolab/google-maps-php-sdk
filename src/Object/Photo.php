<?php
/**
 * Copyright (c) 2019 - present
 * Google Maps PHP - Photo.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 2/8/2019
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Object;

use Biscolab\GoogleMaps\Abstracts\AbstractObject;
use Biscolab\GoogleMaps\Fields\PhotoFields;

class Photo extends AbstractObject
{

	/**
	 * @var null|int
	 */
	protected $height = null;

	/**
	 * @var null|int
	 */
	protected $width = null;

	/**
	 * @var null|string
	 */
	protected $photo_reference = null;

	/**
	 * @var null|string
	 */
	protected $html_attributions = null;

	/**
	 * @var array
	 */
	protected $typeCheck = [
		PhotoFields::HEIGHT            => 'int',
		PhotoFields::WIDTH             => 'int',
		PhotoFields::PHOTO_REFERENCE   => 'string',
		PhotoFields::HTML_ATTRIBUTIONS => 'array',
	];
}