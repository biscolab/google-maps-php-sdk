<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - GoogleMapsRequest.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Http;

use Biscolab\GoogleMaps\Object\AbstractObject;

/**
 * Class GoogleMapsRequest
 * @package Biscolab\GoogleMaps\Http
 */
class GoogleMapsRequest
{

	/**
	 * @var array
	 */
	private $params = [];

	/**
	 * GoogleMapsRequest constructor.
	 *
	 * @param array $params
	 */
	public function __construct(array $params = [])
	{

		if ($params) {
			foreach ($params as $param_name => $param_value) {
				$this->addParam($param_name, $param_value);
			}
		}
	}

	/**
	 * @param string         $param_name
	 * @param AbstractObject $param_value
	 *
	 * @return GoogleMapsRequest
	 */
	public function addParam(string $param_name, $param_value): GoogleMapsRequest
	{

		$this->params[$param_name] = $param_value;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getQuery(): string
	{

		$params = [];

		foreach ($this->params as $param_name => $param_value) {
			$params[$param_name] = (string)$param_value;
		}

		return http_build_query($params);
	}

}