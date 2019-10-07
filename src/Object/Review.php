<?php
/**
 * Copyright (c) 2019 - present
 * Google Maps PHP - Review.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 12/9/2019
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Object;

use Biscolab\GoogleMaps\Abstracts\AbstractObject;
use Biscolab\GoogleMaps\Fields\ReviewFields;

/**
 * Class Review
 * @package Biscolab\GoogleMaps\Object
 * @since v0.6.0
 */
class Review extends AbstractObject
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
		ReviewFields::AUTHOR_NAME               => 'string',
		ReviewFields::AUTHOR_URL                => 'string',
		ReviewFields::LANGUAGE                  => 'string',
		ReviewFields::PROFILE_PHOTO_URL         => 'string',
		ReviewFields::RATING                    => 'int',
		ReviewFields::RELATIVE_TIME_DESCRIPTION => 'string',
		ReviewFields::TEXT                      => 'string',
		ReviewFields::TIME                      => 'int',
	];
}