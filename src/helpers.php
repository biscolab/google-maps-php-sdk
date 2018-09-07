<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - functions.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 7/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps;

/**
 * @param string $camel
 *
 * @return string
 */
function camel2Snake(string $camel): string {

	return strtolower(implode('_', preg_split('/(?=[A-Z])/', $camel)));
}

/**
 * @param string $snake
 *
 * @return string
 */
function snake2Camel(string $snake): string {

	return ucwords($snake, '_');
}