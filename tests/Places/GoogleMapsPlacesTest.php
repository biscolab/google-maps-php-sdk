<?php

/**
 * Copyright (c) 2019 - present
 * Google Maps PHP - GoogleMapsPlacesTest.phpp
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 28/8/2019
 * MIT license: https://github.com/biscolab/google-maps-php/blob/master/LICENSE
 */

namespace Biscolab\GoogleMaps\Tests\Place;

use Biscolab\GoogleMaps\Api\Places;
use Biscolab\GoogleMaps\Enum\GoogleMapsApiConfigFields;
use Biscolab\GoogleMaps\Exception\InvalidArgumentException;
use Biscolab\GoogleMaps\Fields\GoogleMapsRequestFields;
use Biscolab\GoogleMaps\Fields\LatLngFields;
use Biscolab\GoogleMaps\Http\GoogleMapsResponse;
use Biscolab\GoogleMaps\Http\Result\PlaceResultsCollection;
use Biscolab\GoogleMaps\Http\Result\PlacesResult;
use Biscolab\GoogleMaps\Object\Geometry;
use Biscolab\GoogleMaps\Object\Location;
use Biscolab\GoogleMaps\Object\Photo;
use Biscolab\GoogleMaps\Object\PhotoCollection;
use Biscolab\GoogleMaps\Tests\TestCase;
use Biscolab\GoogleMaps\Values\PlaceTypeValues;
use Biscolab\GoogleMaps\Values\RankByValues;
use GuzzleHttp\Psr7\Response;

class GoogleMapsPlacesTest extends TestCase
{

	/**
	 * @var Places
	 */
	protected $place_no_key;

	/**
	 * @var Places
	 */
	protected $place_with_key;

	/**
	 * @var Response
	 */
	protected $mock_find_place_response_ok;

	/**
	 * @var
	 */
	protected $mock_nearby_search_response_ok;

	public function setUp(): void
	{

		$this->place_with_key = new Places([
			GoogleMapsApiConfigFields::KEY => getenv("API_KEY")
		]);

		$this->place_no_key = new Places();

		$find_place_response = '{
		   "candidates" : [
			  {
				 "formatted_address" : "140 George St, The Rocks NSW 2000, Australia",
				 "geometry" : {
					"location" : {
					   "lat" : -33.8599358,
					   "lng" : 151.2090295
					},
					"viewport" : {
					   "northeast" : {
						  "lat" : -33.85824767010727,
						  "lng" : 151.2102470798928
					   },
					   "southwest" : {
						  "lat" : -33.86094732989272,
						  "lng" : 151.2075474201073
					   }
					}
				 },
				 "name" : "Museum of Contemporary Art Australia",
				 "opening_hours" : {
					"open_now" : false,
					"weekday_text" : []
				 },
				 "photos" : [
					{
					   "height" : 2268,
					   "html_attributions" : [
						  "\u003ca href=\"https://maps.google.com/maps/contrib/113202928073475129698/photos\"\u003eEmily Zimny\u003c/a\u003e"
					   ],
					   "photo_reference" : "CmRaAAAAfxSORBfVmhZcERd-9eC5X1x1pKQgbmunjoYdGp4dYADIqC0AXVBCyeDNTHSL6NaG7-UiaqZ8b3BI4qZkFQKpNWTMdxIoRbpHzy-W_fntVxalx1MFNd3xO27KF3pkjYvCEhCd--QtZ-S087Sw5Ja_2O3MGhTr2mPMgeY8M3aP1z4gKPjmyfxolg",
					   "width" : 4032
					}
				 ],
				 "rating" : 4.3
			  }
		   ],
		   "debug_log" : {
			  "line" : []
		   },
		   "status" : "OK"
		}';

		$nearby_search_response_ok = '{
		   "html_attributions" : [],
		   "results" : [
			  {
				 "geometry" : {
					"location" : {
					   "lat" : -33.870775,
					   "lng" : 151.199025
					}
				 },
				 "icon" : "http://maps.gstatic.com/mapfiles/place_api/icons/travel_agent-71.png",
				 "id" : "21a0b251c9b8392186142c798263e289fe45b4aa",
				 "name" : "Rhythmboat Cruises",
				 "opening_hours" : {
					"open_now" : true
				 },
				 "photos" : [
					{
					   "height" : 270,
					   "html_attributions" : [],
					   "photo_reference" : "CnRnAAAAF-LjFR1ZV93eawe1cU_3QNMCNmaGkowY7CnOf-kcNmPhNnPEG9W979jOuJJ1sGr75rhD5hqKzjD8vbMbSsRnq_Ni3ZIGfY6hKWmsOf3qHKJInkm4h55lzvLAXJVc-Rr4kI9O1tmIblblUpg2oqoq8RIQRMQJhFsTr5s9haxQ07EQHxoUO0ICubVFGYfJiMUPor1GnIWb5i8",
					   "width" : 519
					}
				 ],
				 "place_id" : "ChIJyWEHuEmuEmsRm9hTkapTCrk",
				 "reference" : "CoQBdQAAAFSiijw5-cAV68xdf2O18pKIZ0seJh03u9h9wk_lEdG-cP1dWvp_QGS4SNCBMk_fB06YRsfMrNkINtPez22p5lRIlj5ty_HmcNwcl6GZXbD2RdXsVfLYlQwnZQcnu7ihkjZp_2gk1-fWXql3GQ8-1BEGwgCxG-eaSnIJIBPuIpihEhAY1WYdxPvOWsPnb2-nGb6QGhTipN0lgaLpQTnkcMeAIEvCsSa0Ww",
				 "types" : [ "travel_agency", "restaurant", "food", "establishment" ],
				 "vicinity" : "Pyrmont Bay Wharf Darling Dr, Sydney"
			  },
			  {
				 "geometry" : {
					"location" : {
					   "lat" : -33.866891,
					   "lng" : 151.200814
					}
				 },
				 "icon" : "http://maps.gstatic.com/mapfiles/place_api/icons/restaurant-71.png",
				 "id" : "45a27fd8d56c56dc62afc9b49e1d850440d5c403",
				 "name" : "Private Charter Sydney Habour Cruise",
				 "photos" : [
					{
					   "height" : 426,
					   "html_attributions" : [],
					   "photo_reference" : "CnRnAAAAL3n0Zu3U6fseyPl8URGKD49aGB2Wka7CKDZfamoGX2ZTLMBYgTUshjr-MXc0_O2BbvlUAZWtQTBHUVZ-5Sxb1-P-VX2Fx0sZF87q-9vUt19VDwQQmAX_mjQe7UWmU5lJGCOXSgxp2fu1b5VR_PF31RIQTKZLfqm8TA1eynnN4M1XShoU8adzJCcOWK0er14h8SqOIDZctvU",
					   "width" : 640
					}
				 ],
				 "place_id" : "ChIJqwS6fjiuEmsRJAMiOY9MSms",
				 "reference" : "CpQBhgAAAFN27qR_t5oSDKPUzjQIeQa3lrRpFTm5alW3ZYbMFm8k10ETbISfK9S1nwcJVfrP-bjra7NSPuhaRulxoonSPQklDyB-xGvcJncq6qDXIUQ3hlI-bx4AxYckAOX74LkupHq7bcaREgrSBE-U6GbA1C3U7I-HnweO4IPtztSEcgW09y03v1hgHzL8xSDElmkQtRIQzLbyBfj3e0FhJzABXjM2QBoUE2EnL-DzWrzpgmMEulUBLGrtu2Y",
				 "types" : [ "restaurant", "food", "establishment" ],
				 "vicinity" : "Australia"
			  },
			  {
				 "geometry" : {
					"location" : {
					   "lat" : -33.870943,
					   "lng" : 151.190311
					}
				 },
				 "icon" : "http://maps.gstatic.com/mapfiles/place_api/icons/restaurant-71.png",
				 "id" : "30bee58f819b6c47bd24151802f25ecf11df8943",
				 "name" : "Bucks Party Cruise",
				 "opening_hours" : {
					"open_now" : true
				 },
				 "photos" : [
					{
					   "height" : 600,
					   "html_attributions" : [],
					   "photo_reference" : "CnRnAAAA48AX5MsHIMiuipON_Lgh97hPiYDFkxx_vnaZQMOcvcQwYN92o33t5RwjRpOue5R47AjfMltntoz71hto40zqo7vFyxhDuuqhAChKGRQ5mdO5jv5CKWlzi182PICiOb37PiBtiFt7lSLe1SedoyrD-xIQD8xqSOaejWejYHCN4Ye2XBoUT3q2IXJQpMkmffJiBNftv8QSwF4",
					   "width" : 800
					}
				 ],
				 "place_id" : "ChIJLfySpTOuEmsRsc_JfJtljdc",
				 "reference" : "CoQBdQAAANQSThnTekt-UokiTiX3oUFT6YDfdQJIG0ljlQnkLfWefcKmjxax0xmUpWjmpWdOsScl9zSyBNImmrTO9AE9DnWTdQ2hY7n-OOU4UgCfX7U0TE1Vf7jyODRISbK-u86TBJij0b2i7oUWq2bGr0cQSj8CV97U5q8SJR3AFDYi3ogqEhCMXjNLR1k8fiXTkG2BxGJmGhTqwE8C4grdjvJ0w5UsAVoOH7v8HQ",
				 "types" : [ "restaurant", "food", "establishment" ],
				 "vicinity" : "37 Bank St, Pyrmont"
			  },
			  {
				 "geometry" : {
					"location" : {
					   "lat" : -33.867591,
					   "lng" : 151.201196
					}
				 },
				 "icon" : "http://maps.gstatic.com/mapfiles/place_api/icons/travel_agent-71.png",
				 "id" : "a97f9fb468bcd26b68a23072a55af82d4b325e0d",
				 "name" : "Australian Cruise Group",
				 "opening_hours" : {
					"open_now" : true
				 },
				 "photos" : [
					{
					   "height" : 242,
					   "html_attributions" : [],
					   "photo_reference" : "CnRnAAAABjeoPQ7NUU3pDitV4Vs0BgP1FLhf_iCgStUZUr4ZuNqQnc5k43jbvjKC2hTGM8SrmdJYyOyxRO3D2yutoJwVC4Vp_dzckkjG35L6LfMm5sjrOr6uyOtr2PNCp1xQylx6vhdcpW8yZjBZCvVsjNajLBIQ-z4ttAMIc8EjEZV7LsoFgRoU6OrqxvKCnkJGb9F16W57iIV4LuM",
					   "width" : 200
					}
				 ],
				 "place_id" : "ChIJrTLr-GyuEmsRBfy61i59si0",
				 "reference" : "CoQBeQAAAFvf12y8veSQMdIMmAXQmus1zqkgKQ-O2KEX0Kr47rIRTy6HNsyosVl0CjvEBulIu_cujrSOgICdcxNioFDHtAxXBhqeR-8xXtm52Bp0lVwnO3LzLFY3jeo8WrsyIwNE1kQlGuWA4xklpOknHJuRXSQJVheRlYijOHSgsBQ35mOcEhC5IpbpqCMe82yR136087wZGhSziPEbooYkHLn9e5njOTuBprcfVw",
				 "types" : [ "travel_agency", "restaurant", "food", "establishment" ],
				 "vicinity" : "32 The Promenade, King Street Wharf 5, Sydney"
			  }
		   ],
		   "status" : "OK"
		}';

		$this->mock_find_place_response_ok = new Response(200, [], $find_place_response);
		$this->mock_nearby_search_response_ok = new Response(200, [], $nearby_search_response_ok);
	}

	/**
	 * @test
	 */
	public function testCheckPlaceConfig()
	{

		$this->assertEquals(
			Places::SERVICE_ENDPOINT,
			$this->place_with_key->getGoogleMapsApi()->getServiceEndpoint()
		);
		$this->assertEquals(
			getenv("API_KEY"),
			$this->place_with_key->getGoogleMapsApi()->getKey()
		);
		$this->assertEquals('', $this->place_no_key->getGoogleMapsApi()->getKey());
	}

	/**
	 * @test
	 */
	public function testFindPlaceResponseParsing()
	{

		$response = new GoogleMapsResponse($this->mock_find_place_response_ok);

		/** @var PlaceResultsCollection $result */
		$result = new PlaceResultsCollection($response->getResults());

		$this->assertNotNull($result);

		$first_result = $result->first();

		$array_result = $first_result->toArray();

		$this->assertEquals(1, $result->count());

		// Response array keys
		$this->assertArrayHasKey('formatted_address', $array_result);
		$this->assertArrayHasKey('geometry', $array_result);
		$this->assertArrayHasKey('name', $array_result);
		$this->assertArrayHasKey('opening_hours', $array_result);
		$this->assertArrayHasKey('photos', $array_result);
		$this->assertArrayHasKey('rating', $array_result);

		$this->assertInstanceOf(PhotoCollection::class, $first_result->getPhotos());

		$first_photo = $first_result->getPhotos()->first();
		$this->assertInstanceOf(Photo::class, $first_photo);

		$this->assertEquals(2268, $first_photo->getHeight());
		$this->assertEquals(4032, $first_photo->getWidth());

		$this->assertEquals(1, $first_result->getPhotos()->count());

		$this->assertEquals(200, $response->getHttpStatusCode());
	}

	/**
	 * @test
	 */
	public function testNearbySearchResponseParsing()
	{

		$response = new GoogleMapsResponse($this->mock_nearby_search_response_ok);

		/** @var PlaceResultsCollection $result */
		$result = new PlaceResultsCollection($response->getResults());

		$this->assertNotNull($result);

		$array_result = $result->first()->toArray();

		$this->assertEquals(4, $result->count());

		// Response array keys
		$this->assertArrayHasKey('formatted_address', $array_result);
		$this->assertArrayHasKey('geometry', $array_result);
		$this->assertArrayHasKey('name', $array_result);
		$this->assertArrayHasKey('opening_hours', $array_result);
		$this->assertArrayHasKey('photos', $array_result);

		$this->assertEquals(200, $response->getHttpStatusCode());
	}

	/**
	 * @test
	 * @group http
	 * @see   https://developers.google.com/places/web-service/search#find-place-examples
	 */
	public function testPlaceFindPlace()
	{

		/** @var PlaceResultsCollection $result */
		$result = $this->place_with_key->findPlace([
			GoogleMapsRequestFields::INPUT => "Museum of Contemporary Art Australia"
		]);

		$this->assertInstanceOf(PlaceResultsCollection::class, $result);
		$this->assertEquals(1, $result->count());
		$this->assertEquals("ChIJ68aBlEKuEmsRHUA9oME5Zh0", $result->current()->getPlaceId());
	}

	/**
	 * @test
	 * @group http
	 * @see   https://developers.google.com/places/web-service/search#find-place-examples
	 */
	public function testPlaceFindPlaceByText()
	{

		/** @var PlaceResultsCollection $result */
		$result = $this->place_with_key->findPlaceByText("Museum of Contemporary Art Australia");

		$this->assertInstanceOf(PlaceResultsCollection::class, $result);
		$this->assertEquals(1, $result->count());
		$this->assertEquals("ChIJ68aBlEKuEmsRHUA9oME5Zh0", $result->current()->getPlaceId());
	}

	/**
	 * @test
	 * @group http
	 * @see   https://developers.google.com/places/web-service/search#find-place-examples
	 */
	public function testPlaceFindPlaceByPhoneNumber()
	{

		/** @var PlaceResultsCollection $result */
		$result = $this->place_with_key->findPlaceByPhoneNumber("+61293744000");

		$this->assertInstanceOf(PlaceResultsCollection::class, $result);
		$this->assertEquals(3, $result->count());
		$this->assertEquals("ChIJN1t_tDeuEmsRUsoyG83frY4", $result->current()->getPlaceId());
	}

	/**
	 * @test
	 * @group http
	 * @see   https://developers.google.com/places/web-service/search#PlaceSearchRequests
	 */
	public function testFindNearbyPlace()
	{

		/** @var PlaceResultsCollection $result */
		$result = $this->place_with_key->findNearbyPlace([
			GoogleMapsRequestFields::LOCATION => new Location([
				LatLngFields::LAT => -33.8670522,
				LatLngFields::LNG => 151.1957362,
			]),
			GoogleMapsRequestFields::RADIUS   => 1000
		]);

		$this->assertEquals(20, $result->count());
		$this->assertEquals("ChIJP3Sa8ziYEmsRUKgyFmh9AQM", $result->current()->getPlaceId());
		$this->assertTrue($this->place_with_key->responseHasNewPage());
	}

	/**
	 * @test
	 * @group http
	 */
	public function testFindNearbyPlaceByRadius()
	{

		$location = new Location([
			LatLngFields::LAT => -33.8670522,
			LatLngFields::LNG => 151.1957362,
		]);
		$result = $this->place_with_key->findNearbyPlaceByRadius($location, 10000);
		$this->assertEquals(20, $result->count());
		$this->assertEquals("ChIJP3Sa8ziYEmsRUKgyFmh9AQM", $result->current()->getPlaceId());
		$this->assertTrue($this->place_with_key->responseHasNewPage());

		$result_second_page = $this->place_with_key->getNextPage();
		$this->assertEquals(20, $result_second_page->count());
	}

	/**
	 * @test
	 * @group http
	 */
	public function testFindNearbyPlaceByDistance()
	{

		$location = new Location([
			LatLngFields::LAT => -33.8670522,
			LatLngFields::LNG => 151.1957362,
		]);
		$result = $this->place_with_key->findNearbyPlaceByDistance($location, [
			GoogleMapsRequestFields::TYPE => PlaceTypeValues::FOOD
		]);
		$this->assertEquals(20, $result->count());
		$this->assertTrue($this->place_with_key->responseHasNewPage());
	}

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 */
	public function testFindNearbyPlacExpectExceptionsIfLocationIsNull()
	{

		$this->expectException(InvalidArgumentException::class);
		$this->place_with_key->findNearbyPlace([
			GoogleMapsRequestFields::RADIUS => 1000
		]);
	}

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 */
	public function testFindNearbyPlacExpectExceptionsIfLocationIsNotInstanceOfLocationClass()
	{

		$this->expectException(InvalidArgumentException::class);
		$this->place_with_key->findNearbyPlace([
			GoogleMapsRequestFields::LOCATION => 1000
		]);
	}

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 */
	public function testFindNearbyPlacExpectExceptionsIfRadiusIsNull()
	{

		$this->expectException(InvalidArgumentException::class);
		$this->place_with_key->findNearbyPlace([
			GoogleMapsRequestFields::LOCATION => new Location([
				LatLngFields::LAT => -33.8670522,
				LatLngFields::LNG => 151.1957362,
			])
		]);
	}

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 */
	public function testFindNearbyPlacExpectExceptionsIfRankByIsDistanceAndKeywordNameTypeAreNull()
	{

		$this->expectException(InvalidArgumentException::class);
		$this->place_with_key->findNearbyPlace([
			GoogleMapsRequestFields::LOCATION => new Location([
				LatLngFields::LAT => -33.8670522,
				LatLngFields::LNG => 151.1957362,
			]),
			GoogleMapsRequestFields::RANKBY   => RankByValues::DISTANCE
		]);
	}

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 */
	public function testFindNearbyPlacExpectExceptionsIfRadiusIsGreaterThan50K()
	{

		$this->expectException(InvalidArgumentException::class);
		$this->place_with_key->findNearbyPlace([
			GoogleMapsRequestFields::LOCATION => new Location([
				LatLngFields::LAT => -33.8670522,
				LatLngFields::LNG => 151.1957362,
			]),
			GoogleMapsRequestFields::RADIUS   => 50001
		]);
	}

	/**
	 * @test
	 * @group http
	 * @see   https://developers.google.com/places/web-service/search#TextSearchRequests
	 */
	public function testTextSearch()
	{

		/** @var PlaceResultsCollection $result */
		$result = $this->place_with_key->textSearch("restaurants in Sydney");
		$this->assertInstanceOf(PlaceResultsCollection::class, $result);
		$this->assertEquals(20, $result->count());
		$this->assertEquals("ChIJPcvaZCwujEcREkNMSMORhZE", $result->first()->getPlaceId());
		$this->assertTrue($this->place_with_key->responseHasNewPage());
	}

	/**
	 * @test
	 * @group http
	 */
	public function testPlaceDetails()
	{
		$result = $this->place_with_key->details("ChIJN1t_tDeuEmsRUsoyG83frY4");
		$this->assertInstanceOf(PlacesResult::class, $result);
		$this->assertEquals('ChIJN1t_tDeuEmsRUsoyG83frY4', $result->getPlaceId());
	}

	/**
	 * @test
	 * @group http
	 */
	public function testFindPlaceFromTextFields()
	{

		$result = $this->place_with_key->findPlace([
			GoogleMapsRequestFields::INPUT  => "Museum of Contemporary Art Australia",
			GoogleMapsRequestFields::FIELDS => "photos,formatted_address,name,rating,opening_hours,geometry,icon,id,place_id,types,permanently_closed,plus_code",
		]);

		$first_result = $result->first();
		$first_result_array = $first_result->toArray();

		$this->assertArrayHasKey("photos", $first_result_array);
		$this->assertArrayHasKey("geometry", $first_result_array);
		$this->assertArrayHasKey("formatted_address", $first_result_array);
		$this->assertArrayHasKey("name", $first_result_array);
		$this->assertArrayHasKey("icon", $first_result_array);
		$this->assertArrayHasKey("id", $first_result_array);
		$this->assertArrayHasKey("place_id", $first_result_array);
		$this->assertArrayHasKey("reference", $first_result_array);
		$this->assertArrayHasKey("types", $first_result_array);
		$this->assertArrayHasKey("rating", $first_result_array);
		$this->assertArrayHasKey("opening_hours", $first_result_array);
		// This means is NOT permanently_closed (permanently_closed = false)
		$this->assertArrayHasKey("permanently_closed", $first_result_array);
		$this->assertArrayHasKey("plus_code", $first_result_array);

		$this->assertInstanceOf(PhotoCollection::class, $first_result->getPhotos());
		$this->assertInstanceOf(Geometry::class, $first_result->getGeometry());

		$this->assertTrue(is_string($first_result->getFormattedAddress()));
		$this->assertTrue(is_string($first_result->getName()));
		$this->assertTrue(is_string($first_result->getIcon()));
		$this->assertTrue(is_string($first_result->getId()));
		$this->assertTrue(is_string($first_result->getPlaceId()));
		$this->assertEquals("", $first_result->getReference());
		$this->assertTrue(is_array($first_result->getTypes()));
		$this->assertTrue(is_array($first_result->getOpeningHours()));
		$this->assertEquals(0, $first_result->getPriceLevel());
		$this->assertTrue(is_numeric($first_result->getRating()));
		$this->assertTrue(is_bool($first_result->getPermanentlyClose()));
		$this->assertTrue(is_array($first_result->getPlusCode()));
	}
}
