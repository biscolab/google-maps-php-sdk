<?php
/**
 * Copyright (c) 2018 - present
 * GoogleMapsApi - Api.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 31/8/2018
 * MIT license: https://github.com/biscolab/google-maps-php-sdk/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Abstracts;

use Biscolab\GoogleMaps\Enum\GoogleMapsApiConfigFields;
use Biscolab\GoogleMaps\GoogleMapsApi;
use Biscolab\GoogleMaps\Http\GoogleMapsRequest;
use Biscolab\GoogleMaps\Http\GoogleMapsResultsCollection;

/**
 * Class Api
 * @package Biscolab\GoogleMaps\Abstracts
 */
abstract class Api {

	/**
	 * @var GoogleMapsApi
	 */
	protected $googleMapsApi = null;

	/**
	 * @var string
	 */
	const SERVICE_ENDPOINT = null;

	/**
	 * Api constructor.
	 *
	 * @param array $config
	 */
	public function __construct(array $config = []) {

		$service_config = $this->getServiceConfig($config);
		$this->setGoogleMapsApi(new GoogleMapsApi($service_config));
	}

	/**
	 * @return GoogleMapsApi
	 */
	public function getGoogleMapsApi(): GoogleMapsApi {

		return $this->googleMapsApi;
	}

	/**
	 * @param GoogleMapsApi $googleMapsApi
	 *
	 * @return Api
	 */
	public function setGoogleMapsApi(GoogleMapsApi $googleMapsApi): Api {

		$this->googleMapsApi = $googleMapsApi;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getServiceEndpoint(): string {

		return static::SERVICE_ENDPOINT;
	}

	/**
	 * @param array $config
	 *
	 * @return array
	 */
	protected function getServiceConfig(array $config = []): array {

		return array_merge($config, [
			GoogleMapsApiConfigFields::SERVICE_ENDPOINT => $this->getServiceEndpoint()
		]);
	}

	/**
	 * @param array $params
	 *
	 * @return mixed
	 */
	abstract public function createRequest(array $params): GoogleMapsRequest;

	/**
	 * @param GoogleMapsRequest $request
	 *
	 * @return GoogleMapsResultsCollection
	 */
	abstract public function getResultsCollections(GoogleMapsRequest $request): GoogleMapsResultsCollection;
}