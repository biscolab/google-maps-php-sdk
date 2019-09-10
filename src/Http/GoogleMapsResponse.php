<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - GoogleMapsResponse.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
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
class GoogleMapsResponse
{

	/**
	 * @var Response
	 */
	protected $response = null;

	/**
	 * contains an array of places, with information about each.
	 * The Places API returns up to 20 establishment results per query.
	 * Additionally, political results may be returned which serve to identify the area of the request.
	 *
	 * @var array
	 * @see https://developers.google.com/places/web-service/search#PlaceSearchResults
	 */
	protected $results = null;

	/**
	 * contains metadata on the request.
	 *
	 * @var string
	 * @see https://developers.google.com/places/web-service/search#PlaceSearchStatusCodes
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
	 * @var null|array
	 */
	protected $http_status_code = null;

	/**
	 * may contain a set of attributions about this listing which must be displayed to the user (some listings may not have attribution).
	 *
	 * @var null|array
	 * @since 0.5.0
	 */
	protected $html_attributions = null;

	/**
	 * @var null|string
	 * @since 0.5.0
	 */
	protected $next_page_token = null;

	/**
	 * GoogleMapsResponse constructor.
	 *
	 * @param Response $response
	 */
	public function __construct(Response $response)
	{

		$this->setResponse($response);

		$this->parseResponse();

		$this->checkHttpStatusCode();
	}

	/**
	 * @param Response $response
	 *
	 * @return GoogleMapsResponse
	 */
	public function setResponse(Response $response): GoogleMapsResponse
	{

		$this->response = $response;

		return $this;
	}

	/**
	 * @return GoogleMapsResponse
	 *
	 * @throws RequestException
	 * @throws ResponseException
	 */
	protected function parseResponse(): GoogleMapsResponse
	{

		$json_response = $this->response->getBody()->getContents();
		$array_response = $this->toArray($json_response);
		$results = null;

		if (empty($array_response[GoogleMapsResponseFields::STATUS])) {
			throw new ResponseException('Missing "status" in GoogleMapsApi Response');
		}
		$this->setStatus($array_response[GoogleMapsResponseFields::STATUS]);

		if ($this->getStatus() != GoogleMapsResponseStatusValues::OK) {
			$error_message = 'Something went wrong';
			if (!empty($array_response[GoogleMapsResponseFields::ERROR_MESSAGE])) {
				$error_message = $array_response[GoogleMapsResponseFields::ERROR_MESSAGE];
				$this->setErrorMessage($error_message);
			} elseif (!empty($array_response[GoogleMapsResponseFields::STATUS])) {
				$error_message .= ': ' . $array_response[GoogleMapsResponseFields::STATUS];
				$this->setErrorMessage($error_message);
			}
			throw new RequestException($error_message);

		}

		if (!empty($array_response[GoogleMapsResponseFields::RESULTS])) {
			$results = $array_response[GoogleMapsResponseFields::RESULTS];

		} elseif (!empty($array_response[GoogleMapsResponseFields::CANDIDATES])) {
			$results = $array_response[GoogleMapsResponseFields::CANDIDATES];

		} else {
			throw new ResponseException('Missing "results" in GoogleMapsApi Response');
		}
		$this->setResults($results);

		if (!empty($array_response[GoogleMapsResponseFields::HTML_ATTRIBUTIONS])) {
			$this->setHtmlAttributions($array_response[GoogleMapsResponseFields::HTML_ATTRIBUTIONS]);
		}

		if (!empty($array_response[GoogleMapsResponseFields::NEXT_PAGE_TOKEN])) {
			$this->setNextPageToken($array_response[GoogleMapsResponseFields::NEXT_PAGE_TOKEN]);
		}

		return $this;
	}

	/**
	 * @param string $json_response
	 *
	 * @return array
	 */
	public function toArray(string $json_response): array
	{

		$this->array_response = json_decode($json_response, true);

		return $this->array_response;
	}

	/**
	 * @return string
	 */
	public function getStatus(): string
	{

		return $this->status;
	}

	/**
	 * @param string $status
	 *
	 * @return GoogleMapsResponse
	 */
	public function setStatus(string $status)
	{

		$this->status = $status;

		return $this;
	}

	/**
	 * Check HTTP status code (silent/No exceptions!)
	 * @return int
	 */
	protected function checkHttpStatusCode(): int
	{

		$this->http_status_code = $this->response->getStatusCode();

		return $this->http_status_code;
	}

	/**
	 * @return array
	 */
	public function getResults()
	{

		return $this->results;
	}

	/**
	 * @param array $results
	 *
	 * @return $this
	 */
	public function setResults(array $results)
	{

		$this->results = $results;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getArrayResponse(): array
	{

		return $this->array_response;
	}

	/**
	 * @param array $array_response
	 *
	 * @return GoogleMapsResponse
	 */
	public function setArrayResponse(array $array_response): GoogleMapsResponse
	{

		$this->array_response = $array_response;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getErrorMessage()
	{

		return $this->error_message;
	}

	/**
	 * @param $error_message
	 *
	 * @return GoogleMapsResponse
	 */
	public function setErrorMessage($error_message): GoogleMapsResponse
	{

		$this->error_message = $error_message;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getHttpStatusCode(): int
	{

		return intval($this->http_status_code);
	}

	/**
	 * @return array|null
	 */
	public function getHtmlAttributions(): ?array
	{

		return $this->html_attributions;
	}

	/**
	 * @param array|null $html_attributions
	 *
	 * @return GoogleMapsResponse
	 */
	public function setHtmlAttributions(?array $html_attributions): GoogleMapsResponse
	{

		$this->html_attributions = $html_attributions;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getNextPageToken(): string
	{

		return $this->next_page_token ?? '';
	}

	/**
	 * @param $next_page_token
	 *
	 * @return GoogleMapsResponse
	 */
	public function setNextPageToken($next_page_token): GoogleMapsResponse
	{

		$this->next_page_token = $next_page_token;

		return $this;
	}

}