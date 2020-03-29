<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - GoogleMapsRequestFields.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Fields;

/**
 * Class GoogleMapsRequestFields
 * @package Biscolab\GoogleMaps\Fields
 */
class GoogleMapsRequestFields
{

	/**
	 * @var string key
	 */
	const KEY = 'key';

	/**
	 * @var string sensor
	 */
	const SENSOR = 'sensor';

	/**
	 * @var string latlng
	 */
	const LATLNG = 'latlng';

	/**
	 * @var string address
	 */
	const ADDRESS = 'address';

	/**
	 * @var string place_id
	 */
	const PLACE_ID = 'place_id';

	/**
	 * @var string location
	 * @since 0.5.0
	 */
	const LOCATION = 'location';

	/**
	 * @var string locations
	 */
	const LOCATIONS = 'locations';

	/**
	 * @var string path
	 */
	const PATH = 'path';

	/**
	 * @var string samples
	 */
	const SAMPLES = 'samples';

	/**
	 * @var string input
	 * @since 0.5.0
	 */
	const INPUT = 'input';

	/**
	 * @var string inputtype
	 * @since 0.5.0
	 */
	const INPUTTYPE = 'inputtype';

	/**
	 * @var string language
	 * @since 0.5.0
	 */
	const LANGUAGE = 'language';

	/**
	 * @var string fields
	 * @since 0.5.0
	 */
	const FIELDS = 'fields';

	/**
	 * @var string locationbias
	 * @since 0.5.0
	 */
	const LOCATIONBIAS = 'locationbias';

	/**
	 * @var string radius
	 * @since 0.5.0
	 */
	const RADIUS = 'radius';

	/**
	 * @var string rankby
	 * @since 0.5.0
	 */
	const RANKBY = 'rankby';

	/**
	 * @var string keyword
	 * @since 0.5.0
	 */
	const KEYWORD = 'keyword';

	/**
	 * @var string minprice
	 * @since 0.5.0
	 */
	const MINPRICE = 'minprice';

	/**
	 * @var string maxprice
	 * @since 0.5.0
	 */
	const MAXPRICE = 'maxprice';

	/**
	 * @var string name
	 * @since 0.5.0
	 */
	const NAME = 'name';

	/**
	 * @var string opennow
	 * @since 0.5.0
	 */
	const OPENNOW = 'opennow';

	/**
	 * @var string pagetoken
	 * @since 0.5.0
	 */
	const PAGETOKEN = 'pagetoken';

	/**
	 * @var string type
	 * @since 0.5.0
	 */
	const TYPE = 'type';

	/**
	 * @var string query
	 * @since 0.5.0
	 */
	const QUERY = 'query';

	/**
	 * @var string next_page_token
	 * @since 0.5.0
	 */
	const NEXT_PAGE_TOKEN = 'next_page_token';

	/**
	 * @var string photoreference
	 * @since 0.6.0
	 */
	const PHOTOREFERENCE = 'photoreference';

	/**
	 * @var string maxwidth
	 * @since 0.6.0
	 */
	const MAXWIDTH = 'maxwidth';

	/**
	 * @var string maxheight
	 * @since 0.6.0
	 */
	const MAXHEIGHT = 'maxheight';

	/**
	 * @var string timestamp
	 * @since 0.7.0
	 */
	const TIMESTAMP = 'timestamp';
}