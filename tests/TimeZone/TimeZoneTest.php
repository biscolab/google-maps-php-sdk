<?php

/**
 * Copyright (c) 2019 - present
 * Google Maps PHP - TimeZoneTest.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 9/10/2019
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Tests\Place;

use Biscolab\GoogleMaps\Api\TimeZone;
use Biscolab\GoogleMaps\Enum\GoogleMapsApiConfigFields;
use Biscolab\GoogleMaps\Fields\LatLngFields;
use Biscolab\GoogleMaps\Http\GoogleMapsResponse;
use Biscolab\GoogleMaps\Http\Result\TimeZoneResult;
use Biscolab\GoogleMaps\Object\Location;
use Biscolab\GoogleMaps\Tests\TestCase;
use GuzzleHttp\Psr7\Response;

class TimeZoneTest extends TestCase
{

	/**
	 * @var TimeZone
	 */
	protected $time_zone_no_key;

	/**
	 * @var TimeZone
	 */
	protected $time_zone_with_key;

	/**
	 * @var Response
	 */
	protected $mock_time_zone_response_ok;

	/**
	 * @var Response
	 */
	protected $mock_time_zone_response_ko;

	public function setUp(): void
	{

		$this->time_zone_with_key = new TimeZone([
			GoogleMapsApiConfigFields::KEY => getenv("API_KEY")
		]);

		$this->time_zone_no_key = new TimeZone();

		$timezone_response_ok = '{
		   "dstOffset" : 0,
		   "rawOffset" : -28800,
		   "status" : "OK",
		   "timeZoneId" : "America/Los_Angeles",
		   "timeZoneName" : "Pacific Standard Time"
		}';

		$timezone_response_ko = '{
		   "status" : "INVALID_REQUEST",
		}';

		$this->mock_time_zone_response_ok = new Response(200, [], $timezone_response_ok);
		$this->mock_time_zone_response_ko = new Response(200, [], $timezone_response_ko);
	}

	/**
	 * @test
	 */
	public function testCheckTimeZoneConfig()
	{

		$this->assertEquals(
			TimeZone::SERVICE_ENDPOINT,
			$this->time_zone_with_key->getGoogleMapsApi()->getServiceEndpoint()
		);
		$this->assertEquals(
			getenv("API_KEY"),
			$this->time_zone_with_key->getGoogleMapsApi()->getKey()
		);
		$this->assertEquals('', $this->time_zone_no_key->getGoogleMapsApi()->getKey());
	}

	/**
	 * @test
	 */
	public function testTimeZoneResponseParsing()
	{

		$response = new GoogleMapsResponse($this->mock_time_zone_response_ok);

		/** @var TimeZoneResult $result */
		$result = new TimeZoneResult($response->getResult());

		$this->assertNotNull($result);

		$array_result = $result->toArray();

		// Response array keys
		$this->assertArrayHasKey('dstOffset', $array_result);
		$this->assertArrayHasKey('rawOffset', $array_result);
		$this->assertArrayHasKey('timeZoneId', $array_result);
		$this->assertArrayHasKey('timeZoneName', $array_result);

		$this->assertEquals(0, $result->getDstOffset());
		$this->assertEquals(-28800, $result->getRawOffset());
		$this->assertEquals("America/Los_Angeles", $result->getTimeZoneId());
		$this->assertEquals("Pacific Standard Time", $result->getTimeZoneName());

		$this->assertEquals(200, $response->getHttpStatusCode());
	}

	/**
	 * @test 
	 */
	public function testTimeZoneResult()
	{
		$result = new TimeZoneResult;

		$result->setDstOffset(3600);
		$result->setRawOffset(-28800);
		$result->setTimeZoneId("America/Los_Angeles");
		$result->setTimeZoneName("Pacific Standard Time");

		$this->assertEquals(3600, $result->getDstOffset());
		$this->assertEquals(-28800, $result->getRawOffset());
		$this->assertEquals("America/Los_Angeles", $result->getTimeZoneId());
		$this->assertEquals("Pacific Standard Time", $result->getTimeZoneName());
	}

	/**
	 * @test
	 * @group http
	 * @see   https://developers.google.com/places/web-service/search#find-place-examples
	 */
	public function testGetTimezoneData()
	{

		/** @var TimeZoneResult $result */
		$result = $this->time_zone_with_key->get(
			new Location([LatLngFields::LAT => 39.6034810, LatLngFields::LNG => -119.6822510]),
			1331161200
		);

		$this->assertInstanceOf(TimeZoneResult::class, $result);
		$this->assertEquals(0, $result->getDstOffset());
		$this->assertEquals(-28800, $result->getRawOffset());
		$this->assertEquals("America/Los_Angeles", $result->getTimeZoneId());
		$this->assertEquals("Pacific Standard Time", $result->getTimeZoneName());
	}

	/**
	 * @test
	 * @group http
	 * @see   https://developers.google.com/places/web-service/search#find-place-examples
	 */
	public function testGetTimezoneDataWithDayligntSavingTime()
	{

		/** @var TimeZoneResult $result */
		$result = $this->time_zone_with_key->get(
			new Location([LatLngFields::LAT => 39.6034810, LatLngFields::LNG => -119.6822510]),
			1331766000
		);

		$this->assertInstanceOf(TimeZoneResult::class, $result);
		$this->assertEquals(3600, $result->getDstOffset());
		$this->assertEquals(-28800, $result->getRawOffset());
		$this->assertEquals("America/Los_Angeles", $result->getTimeZoneId());
		$this->assertEquals("Pacific Daylight Time", $result->getTimeZoneName());
	}
}
