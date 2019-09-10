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

/**
 * Class GoogleMapsRequest
 * @package Biscolab\GoogleMaps\Http
 */
class GoogleMapsRequest
{

	/**
	 * @var string
	 * @since 0.5.0
	 */
	protected $endpoint = null;

	/**
	 * @var array
	 */
	private $params = [];

	/**
	 * GoogleMapsRequest constructor.
	 *
	 * @param array       $params
	 * @param null|string $endpoint
	 */
	public function __construct(array $params = [], ?string $endpoint = null)
	{

		if ($params) {
			foreach ($params as $param_name => $param_value) {
				$this->setParam($param_name, $param_value);
			}
		}

		$this->endpoint = $endpoint;
	}

	/**
	 * @param string $param_name
	 * @param mixed  $param_value
	 *
	 * @return GoogleMapsRequest
	 */
	public function setParam(string $param_name, $param_value): GoogleMapsRequest
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

	/**
	 * @return array
	 */
	public function getParams(): array
	{

		return $this->params;
	}

	/**
	 * @return null|string
	 */
	public function getEndpoint(): ?string
	{

		return $this->endpoint;
	}

}