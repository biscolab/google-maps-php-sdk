<?php
/**
 * Copyright (c) 2019 - present
 * Google Maps PHP - TimeZoneResult.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 8/10/2019
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Http\Result;

use Biscolab\GoogleMaps\Fields\GoogleMapsResultFields;
use Biscolab\GoogleMaps\Http\GoogleMapsResult;

/**
 * Class TimeZoneResult
 *
 * @method setDstOffset(int $dstOffset)
 * @method setRawOffset(int $rawOffset)
 * @method setTimeZoneId(string $timeZoneId)
 * @method setTimeZoneName(string $timeZoneName)
 *
 * @method int getDstOffset()
 * @method int getRawOffset()
 * @method string getTimeZoneId()
 * @method string getTimeZoneName()
 * @since   0.7.0
 */
class TimeZoneResult extends GoogleMapsResult
{

	/**
	 * @var int
	 */
	protected $dstOffset = 0;

	/**
	 * @var int
	 */
	protected $rawOffset = 0;

	/**
	 * @var string
	 */
	protected $timeZoneId = '';

	/**
	 * @var string
	 */
	protected $timeZoneName = '';

	/**
	 * @var array
	 */
	protected $typeCheck = [
		GoogleMapsResultFields::DST_OFFSET    => 'int',
		GoogleMapsResultFields::RAW_OFFSET    => 'int',
		GoogleMapsResultFields::TIMEZONE_ID   => 'string',
		GoogleMapsResultFields::TIMEZONE_NAME => 'string',
	];

	/**
	 * @param string $initial_field_name
	 *
	 * @return string
	 */
	protected function getFieldName(string $initial_field_name): string
	{

		return lcfirst($initial_field_name);
	}

}