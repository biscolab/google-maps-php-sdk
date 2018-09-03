<?php
/**
 * Copyright (c) 2018 - present
 * GoogleMapsApi - GoogleMapsClient.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 31/8/2018
 * MIT license: https://github.com/biscolab/google-maps-php-sdk/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Http;

use Biscolab\GoogleMaps\Enum\GoogleMapsRequestMethodValues;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class GoogleMapsClient {

	/**
	 * @var Client
	 */
	protected $client = null;

	/**
	 * GeocoderClient constructor.
	 */
	public function __construct() {

		$this->setClient(new Client());
	}

	/**
	 * @param null $client
	 *
	 * @return GoogleMapsClient
	 */
	public function setClient($client) {

		$this->client = $client;

		return $this;
	}

	/**
	 * @param string      $url
	 * @param null|string $query
	 *
	 * @return \Biscolab\GoogleMaps\Http\GoogleMapsResponse
	 */
	public function get(string $url, ?string $query = null): GoogleMapsResponse {

		$client_params = $query ? [
			'query' => $query
		] : null;

		/** @var Response $res */
		$res = $this->client->request(GoogleMapsRequestMethodValues::GET, $url, $client_params);

		return new GoogleMapsResponse($res);
	}
}