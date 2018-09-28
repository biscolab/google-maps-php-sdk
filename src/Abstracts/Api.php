<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - Api.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
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
	public function createRequest(array $params): GoogleMapsRequest {

		return new GoogleMapsRequest($params);
	}

	/**
	 * @param GoogleMapsRequest $request
	 *
	 * @return GoogleMapsResultsCollection
	 */
	public function getResultsCollections(GoogleMapsRequest $request): GoogleMapsResultsCollection {

		$results = $this->getGoogleMapsApi()->get($request)->getResults();

		$result_collection_class = $this->result_collection;

		return new $result_collection_class($results);
	}
}