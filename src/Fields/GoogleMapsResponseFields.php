<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - GoogleMapsResponseFields.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Fields;

/**
 * Class GoogleMapsResponseFields
 * @package Biscolab\GoogleMaps\Enum
 */
class GoogleMapsResponseFields
{

	/**
	 * @var string results
	 */
	const RESULTS = 'results';

	/**
	 * @var string result
	 * @since v0.6.0
	 */
	const RESULT = 'result';

	/**
	 * @var string status
	 */
	const STATUS = 'status';

	/**
	 * @var string error_message
	 */
	const ERROR_MESSAGE = 'error_message';

	/**
	 * @var string candidates
	 * @since 0.5.0
	 */
	const CANDIDATES = 'candidates';

	/**
	 * @var string html_attributions
	 * @since 0.5.0
	 */
	const HTML_ATTRIBUTIONS = 'html_attributions';

	/**
	 * @var string next_page_token
	 * @since 0.5.0
	 */
	const NEXT_PAGE_TOKEN = 'next_page_token';

}