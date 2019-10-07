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
use Biscolab\GoogleMaps\Fields\GoogleMapsRequestFields;
use Biscolab\GoogleMaps\GoogleMapsApi;
use Biscolab\GoogleMaps\Http\GoogleMapsRequest;
use Biscolab\GoogleMaps\Http\GoogleMapsResponse;
use Biscolab\GoogleMaps\Http\GoogleMapsResult;
use Biscolab\GoogleMaps\Http\GoogleMapsResultsCollection;

/**
 * Class Api
 * @package Biscolab\GoogleMaps\Abstracts
 */
abstract class Api
{

	/**
	 * @var string
	 */
	const SERVICE_ENDPOINT = null;

	/**
	 * @var GoogleMapsApi
	 */
	protected $google_maps_api = null;

	/**
	 * @var string
	 */
	protected $result_type = '';

	/**
	 * @var string
	 */
	protected $result_collection_type = '';

	/**
	 * @var GoogleMapsResponse
	 */
	protected $response;

	/**
	 * @var GoogleMapsRequest
	 */
	protected $request;

	/**
	 * Api constructor.
	 *
	 * @param array $config
	 */
	public function __construct(array $config = [])
	{

		$service_config = $this->getServiceConfig($config);
		$this->setGoogleMapsApi(new GoogleMapsApi($service_config));
	}

	/**
	 * @param array $config
	 *
	 * @return array
	 */
	protected function getServiceConfig(array $config = []): array
	{

		return array_merge($config, [
			GoogleMapsApiConfigFields::SERVICE_ENDPOINT => $this->getServiceEndpoint()
		]);
	}

	/**
	 * @return string
	 */
	public function getServiceEndpoint(): string
	{

		return static::SERVICE_ENDPOINT ?? '';
	}

	/**
	 * @param array       $params
	 * @param null|string $endpoint
	 *
	 * @return GoogleMapsResult|GoogleMapsResultsCollection
	 */
	public function callApi(array $params, ?string $endpoint = null)
	{

		$this->createRequest($params, $endpoint);

		return $this->getResponseResult();
	}

	/**
	 * @param array       $params
	 * @param null|string $endpoint since 0.5.0
	 *
	 * @return GoogleMapsRequest
	 */
	public function createRequest(array $params, ?string $endpoint = null): GoogleMapsRequest
	{

		$this->request = new GoogleMapsRequest($params, $endpoint);;

		return $this->request;
	}

	/**
	 * @return GoogleMapsResult|GoogleMapsResultsCollection
	 */
	public function getResponseResult()
	{

		$result = $this->getResponse()->getResult();
		if ($result) {
			$result_type = $this->result_type;

			return new $result_type($result);
		}
		$results = $this->getResponse()->getResults();

		$result_collection_type_class = $this->result_collection_type;

		return new $result_collection_type_class($results);
	}

	/**
	 * @return GoogleMapsResponse
	 */
	public function getResponse(): GoogleMapsResponse
	{

		$this->response = $this->getGoogleMapsApi()->get($this->request);

		return $this->response;
	}

	/**
	 * @return GoogleMapsApi
	 */
	public function getGoogleMapsApi(): GoogleMapsApi
	{

		return $this->google_maps_api;
	}

	/**
	 * @param GoogleMapsApi $google_maps_api
	 *
	 * @return Api
	 */
	public function setGoogleMapsApi(GoogleMapsApi $google_maps_api): Api
	{

		$this->google_maps_api = $google_maps_api;

		return $this;
	}

	/**
	 * @return GoogleMapsResultsCollection
	 */
	public function getSingleResult(): GoogleMapsResultsCollection
	{

		$results = $this->getResponse()->getResults();

		$result_collection_type_class = $this->result_collection_type;

		return new $result_collection_type_class($results);
	}

	/**
	 * @return GoogleMapsResultsCollection
	 */
	public function getNextPage(): GoogleMapsResultsCollection
	{

		if ($this->responseHasNewPage()) {
			$this->request->setParam(GoogleMapsRequestFields::NEXT_PAGE_TOKEN, $this->response->getNextPageToken());
		}

		return $this->getResponseResult();
	}

	/**
	 * @return bool
	 */
	public function responseHasNewPage(): bool
	{

		return ($this->response instanceof GoogleMapsResponse) ? $this->response->getNextPageToken() : false;
	}
}