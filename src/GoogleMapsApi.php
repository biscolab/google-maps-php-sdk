<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - GoogleMapsApi.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps;

use Biscolab\GoogleMaps\Enum\GoogleMapsApiConfigFields;
use Biscolab\GoogleMaps\Enum\GoogleMapsResponseFormat;
use Biscolab\GoogleMaps\Exception\RequestException;
use Biscolab\GoogleMaps\Fields\GoogleMapsRequestFields;
use Biscolab\GoogleMaps\Http\GoogleMapsClient;
use Biscolab\GoogleMaps\Http\GoogleMapsRequest;
use Biscolab\GoogleMaps\Values\SensorValues;

/**
 * Class GoogleMapsApi
 * @package Biscolab\GoogleMaps
 */
class GoogleMapsApi
{

	/**
	 * @var GoogleMapsApi
	 */
	protected static $instance = null;

	/**
	 * @var GoogleMapsRequest
	 */
	protected $request = null;

	/**
	 * Google Maps Geocode Service API url
	 * @var string
	 */
	private $api_url = "https://maps.googleapis.com/maps/api/";

	/**
	 * your own Google Maps API key
	 * @var string
	 * @see https://developers.google.com/maps/documentation/javascript/get-api-key
	 */
	private $key = '';

	/**
	 * Google Maps API sensor
	 * @var string - true|false
	 */
	private $sensor = 'false';

	/**
	 * Google Maps API service name
	 * @var string
	 */
	private $service_endpoint = '';

	/**
	 * @var string
	 */
	private $response = null;

	/**
	 * @var GoogleMapsClient
	 */
	private $client = null;

	/**
	 * @var string
	 */
	private $type = null;

	/**
	 * GoogleMapsApi constructor.
	 *
	 * @param array $config
	 */
	public function __construct(array $config = [])
	{

		// Set "API key"
		$key = (empty($config[GoogleMapsApiConfigFields::KEY])) ? '' : $config[GoogleMapsApiConfigFields::KEY];
		$this->setKey($key);

		// Set "sensor"
		$sensor = (empty($config[GoogleMapsApiConfigFields::SENSOR])) ? SensorValues::FALSE : $config[GoogleMapsApiConfigFields::SENSOR];
		$this->setSensor($sensor);

		// Set the endpoint
		$service_endpoint = (empty($config[GoogleMapsApiConfigFields::SERVICE_ENDPOINT])) ? '' : $config[GoogleMapsApiConfigFields::SERVICE_ENDPOINT];
		$this->setServiceEndpoint($service_endpoint);

		// Set Client
		$this->setClient();
	}

	/**
	 * @return string
	 */
	public function getApiUrl(): string
	{

		return $this->api_url;
	}

	/**
	 * Perform the Google Maps API call
	 *
	 * @param GoogleMapsRequest $request
	 *
	 * @return Http\GoogleMapsResponse|string
	 */
	public function get(GoogleMapsRequest $request)
	{

		$this->setRequest($request);

		$url = $this->getUrl();

		$query = $this->getQuery();

		$this->response = $this->getClient()->get($url, $query);

		return $this->response;
	}

	/**
	 * @return string
	 * @throws RequestException
	 */
	public function getUrl(): string
	{

		$url_chunks = [];
		$service_endpoint = $this->getServiceEndpoint();
		if (!$service_endpoint) {
			throw new RequestException('Service name missing!');
		}

		$request_endpoint = $this->request->getEndpoint();
		array_push($url_chunks, $this->api_url . $service_endpoint);

		if($request_endpoint) {
			array_push($url_chunks, $request_endpoint);
		}

		array_push($url_chunks, GoogleMapsResponseFormat::JSON);
		return implode("/", $url_chunks);
	}

	/**
	 * @return string
	 */
	public function getServiceEndpoint(): string
	{

		return $this->service_endpoint;
	}

	/**
	 * @param string $service_endpoint
	 *
	 * @return GoogleMapsApi
	 */
	public function setServiceEndpoint(string $service_endpoint): GoogleMapsApi
	{

		$this->service_endpoint = $service_endpoint;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getQuery(): string
	{

		$api_query = http_build_query([
			GoogleMapsRequestFields::KEY    => $this->getKey(),
			GoogleMapsRequestFields::SENSOR => $this->getSensor(),
		]);

		$request_query = $this->getRequest()->getQuery();

		return implode('&', [
			$api_query,
			$request_query
		]);
	}

	/**
	 * @return string
	 */
	public function getKey(): string
	{

		return $this->key;
	}

	/**
	 * @param string $key
	 *
	 * @return GoogleMapsApi
	 */
	public function setKey(string $key): GoogleMapsApi
	{

		$this->key = $key;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getSensor(): string
	{

		return $this->sensor ? 'true' : 'false';
	}

	/**
	 * Set sensor parameter
	 *
	 * @param bool|string $sensor
	 *
	 * @return GoogleMapsApi
	 */
	public function setSensor($sensor): GoogleMapsApi
	{

		if ($sensor !== SensorValues::FALSE) {
			$sensor = SensorValues::TRUE;
		}
		$this->sensor = $sensor;

		return $this;
	}

	/**
	 * @return GoogleMapsRequest
	 */
	public function getRequest(): GoogleMapsRequest
	{

		return $this->request;
	}

	/**
	 * @param GoogleMapsRequest $request
	 *
	 * @return GoogleMapsApi
	 */
	public function setRequest(GoogleMapsRequest $request)
	{

		$this->request = $request;

		return $this;
	}

	/**
	 * @return GoogleMapsClient
	 */
	public function getClient()
	{

		return $this->client;
	}

	/**
	 * @param GoogleMapsClient|null $client
	 *
	 * @return GoogleMapsApi
	 */
	public function setClient(?GoogleMapsClient $client = null): GoogleMapsApi
	{

		$this->client = $client ?? new GoogleMapsClient();

		return $this;
	}

	/**
	 * @param string $type
	 *
	 * @return GoogleMapsApi
	 */
	protected function setType(string $type): GoogleMapsApi
	{

		$this->type = $type;

		return $this;
	}

}
