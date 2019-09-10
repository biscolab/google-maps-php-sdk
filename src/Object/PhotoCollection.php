<?php
/**
 * Copyright (c) 2019 - present
 * Google Maps PHP - PhotoCollection.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 28/8/2019
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Object;

use Biscolab\GoogleMaps\Abstracts\AbstractCollection;

/**
 * Class PhotoCollection
 * @package Biscolab\GoogleMaps\PhotoCollection
 */
class PhotoCollection extends AbstractCollection
{

	/**
	 * @var string
	 */
	protected $item_class = Photo::class;

	/**
	 * @param $item
	 *
	 * @return Photo
	 */
	protected function parseItem($item): Photo
	{

		return ($item instanceof $this->item_class) ? $item : new $this->item_class($item);
	}
}