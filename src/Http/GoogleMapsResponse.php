<?php
/**
 * Copyright (c) 2018 - present
 * GoogleMapsApi - GoogleMapsResponse.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 31/8/2018
 * MIT license: https://github.com/biscolab/google-maps-php-sdk/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Http;

use Biscolab\GoogleMaps\Exception\RequestException;
use Biscolab\GoogleMaps\Exception\ResponseException;
use Biscolab\GoogleMaps\Fields\GoogleMapsResponseFields;
use Biscolab\GoogleMaps\Values\GoogleMapsResponseStatusValues;
use GuzzleHttp\Psr7\Response;

/**
 * Class GoogleMapsResponse
 * @package Biscolab\GoogleMaps\Http
 */
class GoogleMapsResponse {

	/**
	 * @var Response
	 */
	protected $response = null;

	/**
	 * @var array
	 */
	protected $results = null;

	/**
	 * @var string
	 */
	protected $status = null;

	/**
	 * @var string
	 */
	protected $error_message = null;

	/**
	 * @var array
	 */
	protected $array_response = null;

	/**
	 * @var int
	 */
	protected $http_status_code = null;

	/**
	 * GoogleMapsResponse constructor.
	 *
	 * @param Response $response
	 */
	public function __construct(Response $response) {

		$this->setResponse($response);

		$this->parseResponse();

		$this->checkHttpStatusCode();
	}

	/**
	 * @param Response $response
	 *
	 * @return GoogleMapsResponse
	 */
	public function setResponse(Response $response): GoogleMapsResponse {

		$this->response = $response;

		return $this;
	}

	/**
	 * @return GoogleMapsResponse
	 *
	 * @throws RequestException
	 * @throws ResponseException
	 */
	protected function parseResponse(): GoogleMapsResponse {

		$json_response = $this->response->getBody()->getContents();
		$array_response = $this->toArray($json_response);

		if (is_null($array_response[GoogleMapsResponseFields::RESULTS])) {
			throw new ResponseException('Missing "results" in GoogleMapsApi Response');
		}
		$this->setResults($array_response[GoogleMapsResponseFields::RESULTS]);

		if (empty($array_response[GoogleMapsResponseFields::STATUS])) {
			throw new ResponseException('Missing "status" in GoogleMapsApi Response');
		}
		$this->setStatus($array_response[GoogleMapsResponseFields::STATUS]);

		if ($this->getStatus() != GoogleMapsResponseStatusValues::OK) {
			$error_message = 'Something went wrong';
			if (!empty($array_response[GoogleMapsResponseFields::ERROR_MESSAGE])) {
				$error_message = $array_response[GoogleMapsResponseFields::ERROR_MESSAGE];
				$this->setErrorMessage($error_message);
			}
			throw new RequestException($error_message);

		}

		return $this;
	}

	/**
	 * Check HTTP status code (silent/No exceptions!)
	 * @return int
	 */
	protected function checkHttpStatusCode(): int {

		$this->http_status_code = $this->response->getStatusCode();

		return $this->http_status_code;
	}

	/**
	 * @param string $json_response
	 *
	 * @return array
	 */
	public function toArray(string $json_response): array {

		$this->array_response = json_decode($json_response, true);

		return $this->array_response;
	}

	/**
	 * @return array
	 */
	public function getResults() {

		return $this->results;
	}

	/**
	 * @param array $results
	 *
	 * @return $this
	 */
	public function setResults(array $results) {

		$this->results = $results;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getStatus(): string {

		return $this->status;
	}

	/**
	 * @param string $status
	 *
	 * @return GoogleMapsResponse
	 */
	public function setStatus(string $status) {

		$this->status = $status;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getArrayResponse(): array {

		return $this->array_response;
	}

	/**
	 * @param array $array_response
	 *
	 * @return GoogleMapsResponse
	 */
	public function setArrayResponse(array $array_response): GoogleMapsResponse {

		$this->array_response = $array_response;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getErrorMessage() {

		return $this->error_message;
	}

	/**
	 * @param $error_message
	 *
	 * @return GoogleMapsResponse
	 */
	public function setErrorMessage($error_message): GoogleMapsResponse {

		$this->error_message = $error_message;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getHttpStatusCode(): int {

		return intval($this->http_status_code);
	}

}