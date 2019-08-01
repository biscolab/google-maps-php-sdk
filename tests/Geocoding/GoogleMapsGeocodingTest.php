<?php
/**
 * Copyright (c) 2018 - present
 * Google Maps PHP - GoogleMapsGeocodingTest.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 5/9/2018
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\geocode\Tests;

use Biscolab\GoogleMaps\Api\Geocoding;
use Biscolab\GoogleMaps\Enum\GoogleMapsApiConfigFields;
use Biscolab\GoogleMaps\Exception\RequestException;
use Biscolab\GoogleMaps\Http\GoogleMapsResponse;
use Biscolab\GoogleMaps\Http\Result\GeocodingResultsCollection;
use Biscolab\GoogleMaps\Values\GoogleMapsResponseStatusValues;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use function Biscolab\GoogleMaps\camel2Snake;
use function Biscolab\GoogleMaps\snake2Camel;

class GoogleMapsGeocodingTest extends TestCase
{

	/**
	 * @var Geocoding
	 */
	protected $geocoding_no_key;

	/**
	 * @var Geocoding
	 */
	protected $geocoding_with_key;

	/**
	 * @var Geocoding
	 */
	protected $geocoding_with_sensor;

	/**
	 * @var Response
	 */
	protected $mock_response_ok;

	/**
	 * @var Response
	 */
	protected $mock_response_ko;

	public function setUp()
	{

		// This is the sample value from Google Maps official documentation
		$default_response_OK = [
			'results' => [
				0 => [
					'address_components' => [
						0 => [
							'long_name'  => '277',
							'short_name' => '277',
							'types'      => [
								0 => 'street_number',
							],
						],
						1 => [
							'long_name'  => 'Bedford Avenue',
							'short_name' => 'Bedford Ave',
							'types'      => [
								0 => 'route',
							],
						],
						2 => [
							'long_name'  => 'Williamsburg',
							'short_name' => 'Williamsburg',
							'types'      => [
								0 => 'neighborhood',
								1 => 'political',
							],
						],
						3 => [
							'long_name'  => 'Brooklyn',
							'short_name' => 'Brooklyn',
							'types'      => [
								0 => 'political',
								1 => 'sublocality',
								2 => 'sublocality_level_1',
							],
						],
						4 => [
							'long_name'  => 'Kings County',
							'short_name' => 'Kings County',
							'types'      => [
								0 => 'administrative_area_level_2',
								1 => 'political',
							],
						],
						5 => [
							'long_name'  => 'New York',
							'short_name' => 'NY',
							'types'      => [
								0 => 'administrative_area_level_1',
								1 => 'political',
							],
						],
						6 => [
							'long_name'  => 'United States',
							'short_name' => 'US',
							'types'      => [
								0 => 'country',
								1 => 'political',
							],
						],
						7 => [
							'long_name'  => '11211',
							'short_name' => '11211',
							'types'      => [
								0 => 'postal_code',
							],
						],
					],
					'formatted_address'  => '277 Bedford Ave, Brooklyn, NY 11211, USA',
					'geometry'           => [
						'location'      => [
							'lat' => 40.71422050000000325553628499619662761688232421875,
							'lng' => -73.961290300000001707303454168140888214111328125,
						],
						'location_type' => 'ROOFTOP',
						'viewport'      => [
							'northeast' => [
								'lat' => 40.7155694802914922547643072903156280517578125,
								'lng' => -73.9599413197084913917933590710163116455078125,
							],
							'southwest' => [
								'lat' => 40.712871519708500045453547500073909759521484375,
								'lng' => -73.9626392802914978119588340632617473602294921875,
							],
						],
					],
					'place_id'           => 'ChIJd8BlQ2BZwokRAFUEcm_qrcA',
					'types'              => [
						0 => 'street_address',
					],
				],
			],
			'status'  => 'OK',
		];

		$default_response_KO = array_merge($default_response_OK, [
			'status' => GoogleMapsResponseStatusValues::REQUEST_DENIED
		]);

		// geocoding with API key
		// Remember to associate a valid payment method to your project
		$this->geocoding_with_key = new Geocoding([
			GoogleMapsApiConfigFields::KEY => 'MyKey'
		]);

		// geocoding with sensor
		$this->geocoding_with_sensor = new Geocoding([
			GoogleMapsApiConfigFields::SENSOR => 'true'
		]);

		// geocoding with NO API key
		$this->geocoding_no_key = new Geocoding();

		$this->mock_response_ok = new Response(200, [], \GuzzleHttp\json_encode($default_response_OK));
		$this->mock_response_ko = new Response(200, [], \GuzzleHttp\json_encode($default_response_KO));
	}

	public function testCheckGeocodingConfig()
	{

		$this->assertEquals(Geocoding::SERVICE_ENDPOINT,
			$this->geocoding_with_key->getGoogleMapsApi()->getServiceEndpoint());
		$this->assertEquals('MyKey', $this->geocoding_with_key->getGoogleMapsApi()->getKey());
		$this->assertEquals('', $this->geocoding_no_key->getGoogleMapsApi()->getKey());
	}

	public function testCheckGeocodingConfigWithSensor()
	{

		$this->assertEquals('true', $this->geocoding_with_sensor->getGoogleMapsApi()->getSensor());
	}

	public function testCheckGeocodingResponseOk()
	{

		$response = new GoogleMapsResponse($this->mock_response_ok);

		/** @var GeocodingResultsCollection $result */
		$result = new GeocodingResultsCollection($response->getResults());

		$this->assertNotNull($result);

		$array_result = $result->first()->toArray();
		// Response array keys
		$this->assertArrayHasKey('address_components', $array_result);
		$this->assertArrayHasKey('geometry', $array_result);
		$this->assertArrayHasKey('place_id', $array_result);
		$this->assertArrayHasKey('formatted_address', $array_result);
		$this->assertArrayHasKey('types', $array_result);
		$this->assertArrayHasKey('location', $array_result['geometry']);

		$address = $result->first()->getAddress();

		$this->assertEquals(8, $address->count());

		$this->assertEquals(200, $response->getHttpStatusCode());

	}

	public function testResponseKO()
	{

		$this->expectException(RequestException::class);
		new GoogleMapsResponse($this->mock_response_ko);
	}

	public function testCamelToSnake()
	{

		$this->assertEquals('test_field_name', camel2Snake('testFieldName'));
	}

	public function testSnakeToCamel()
	{

		$this->assertEquals('testFieldName', snake2Camel('test_field_name'));
	}

}
