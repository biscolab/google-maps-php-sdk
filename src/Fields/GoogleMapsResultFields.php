<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - GoogleMapsResultFields.php
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
class GoogleMapsResultFields
{

	/**
	 * @var string address_components
	 */
	const ADDRESS_COMPONENTS = 'address_components';

	/**
	 * @var string formatted_address
	 */
	const FORMATTED_ADDRESS = 'formatted_address';

	/**
	 * @var string geometry
	 */
	const GEOMETRY = 'geometry';

	/**
	 * @var string viewport
	 */
	const VIEWPORT = 'viewport';

	/**
	 * @var string place_id
	 */
	const PLACE_ID = 'place_id';

	/**
	 * @var string location_type
	 */
	const LOCATION_TYPE = 'location_type';

	/**
	 * @var string types
	 */
	const TYPES = 'types';

	/**
	 * @var string location
	 */
	const LOCATION = 'location';

	/**
	 * @var string elevation
	 */
	const ELEVATION = 'elevation';

	/**
	 * @var string resolution
	 */
	const RESOLUTION = 'resolution';

	/**
	 * @var string icon
	 * @since 0.5.0
	 */
	const ICON = 'icon';

	/**
	 * @var string id
	 * @since 0.5.0
	 */
	const ID = 'id';

	/**
	 * @var string name
	 * @since 0.5.0
	 */
	const NAME = 'name';

	/**
	 * @var string photos
	 * @since 0.5.0
	 */
	const PHOTOS = 'photos';

	/**
	 * @var string reference
	 * @since 0.5.0
	 */
	const REFERENCE = 'reference';

	/**
	 * @var string vicinity
	 * @since 0.5.0
	 */
	const VICINITY = 'vicinity';

	/**
	 * @var string opening_hours
	 * @since 0.5.0
	 */
	const OPENING_HOURS = 'opening_hours';

	/**
	 * @var string price_level
	 * @since 0.5.0
	 */
	const PRICE_LEVEL = 'price_level';

	/**
	 * @var string rating
	 * @since 0.5.0
	 */
	const RATING = 'rating';

	/**
	 * @var string permanently_closed
	 * @since 0.5.0
	 */
	const PERMANENTLY_CLOSED = 'permanently_closed';

	/**
	 * @var string plus_code
	 * @since 0.5.0
	 */
	const PLUS_CODE = 'plus_code';

	/**
	 * @var string next_page_token
	 * @since 0.5.0
	 */
	const NEXT_PAGE_TOKEN = 'next_page_token';

	/**
	 * @var string reviews
	 * @since 0.6.0
	 */
	const REVIEWS = 'reviews';

	/**
	 * @var string utc_offset
	 * @since 0.6.0
	 */
	const UTC_OFFSET = 'utc_offset';

	/**
	 * @var string website
	 * @since 0.6.0
	 */
	const WEBSITE = 'website';

	/**
	 * @var string international_phone_number
	 * @since 0.6.0
	 */
	const INTERNATIONAL_PHONE_NUMBER = 'international_phone_number';

	/**
	 * @var string formatted_phone_number
	 * @since 0.6.0
	 */
	const FORMATTED_PHONE_NUMBER = 'formatted_phone_number';

	/**
	 * @var string adr_address
	 * @since 0.6.0
	 */
	const ADR_ADDRESS = 'adr_address';

	/**
	 * @var string dstOffset
	 * @since 0.7.0
	 */
	const DST_OFFSET = 'dstOffset';

	/**
	 * @var string rawOffset
	 * @since 0.7.0
	 */
	const RAW_OFFSET = 'rawOffset';

	/**
	 * @var string timeZoneId
	 * @since 0.7.0
	 */
	const TIMEZONE_ID = 'timeZoneId';

	/**
	 * @var string timeZoneName
	 * @since 0.7.0
	 */
	const TIMEZONE_NAME = 'timeZoneName';

}