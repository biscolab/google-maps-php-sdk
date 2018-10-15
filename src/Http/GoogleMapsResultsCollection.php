<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - GoogleMapsResultsCollection.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Http;

use Biscolab\GoogleMaps\Abstracts\AbstractCollection;

/**
 * Class GoogleMapsResultsCollection
 * @package Biscolab\GoogleMaps\Http
 */
class GoogleMapsResultsCollection extends AbstractCollection {

	/**
	 * @var string
	 */
	protected $item_class = GoogleMapsResult::class;

	/**
	 * @param $item
	 *
	 * @return GoogleMapsResult
	 */
	protected function parseItem($item): GoogleMapsResult {

		$item_class = $this->item_class;

		return new $item_class($item);
	}
}