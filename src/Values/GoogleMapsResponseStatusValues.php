<?php
/**
 * Copyright (c) 2018 - present
 * GoogleMapsApi - GoogleMapsResponseStatusValues.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 31/8/2018
 * MIT license: https://github.com/biscolab/google-maps-php-sdk/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Values;

/**
 * Class GoogleMapsResponseStatusValues
 * @package Biscolab\GoogleMaps\Enum
 *
 * @see     https://developers.google.com/maps/documentation/geocoding/intro#StatusCodes
 */
class GoogleMapsResponseStatusValues {

	/**
	 * string: OK
	 */
	const OK = 'OK';

	/**
	 * string: REQUEST_DENIED
	 */
	const REQUEST_DENIED = 'REQUEST_DENIED';

	/**
	 * string: ZERO_RESULTS
	 */
	const ZERO_RESULTS = 'ZERO_RESULTS';

	/**
	 * string: OVER_DAILY_LIMIT
	 */
	const OVER_DAILY_LIMIT = 'OVER_DAILY_LIMIT';

	/**
	 * string: OVER_QUERY_LIMIT
	 */
	const OVER_QUERY_LIMIT = 'OVER_QUERY_LIMIT';

	/**
	 * string: INVALID_REQUEST
	 */
	const INVALID_REQUEST = 'INVALID_REQUEST';

	/**
	 * string: UNKNOWN_ERROR
	 */
	const UNKNOWN_ERROR = 'UNKNOWN_ERROR';

}