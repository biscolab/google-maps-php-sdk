<?php
/**
 * Copyright (c) 2019 - present
 * Google Maps PHP - ReviewCollection.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 12/9/2019
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Object;

use Biscolab\GoogleMaps\Abstracts\AbstractCollection;

/**
 * Class ReviewCollection
 * @package Biscolab\GoogleMaps\Object
 * @since v0.6.0
 */
class ReviewCollection extends AbstractCollection
{

	/**
	 * @var string
	 */
	protected $item_class = Review::class;

	/**
	 * @param $item
	 *
	 * @return Review
	 */
	protected function parseItem($item): Review
	{

		return ($item instanceof $this->item_class) ? $item : new $this->item_class($item);
	}
}