<?php
require_once __DIR__."/../TestHelper.php";

class CreateOrderTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * 
	 */
	public function test_createSimpleOrderAndGetResponse() {
		//TestHelper::setSandboxCredentials();
		$mockOrderId = TestHelper::getRandomOrderId();
		$mockHttp = new HttpMock(create_function('','return TestHelper::factoryHttpEventWithSuccess("SUCCESS_CREATE_ORDER","'.$mockOrderId.'");'));
		
		$request = new RequestCreateOrder($mockHttp);
		$request->orderNumber(TestHelper::getRandomOrderNumber())->currencyCode("SEK")->totalAmount(100);
		
		$response = $request->request();
		
		$this->assertInstanceOf("ResponseCreateOrder", $response);
			
		$this->assertInstanceOf("Status", $response->status());
		
		$this->assertTrue($response->status()->isSuccess() == true);
		
		$this->assertTrue($response->status()->statusKey() == "SUCCESS");
	}
	
	public function test_createOrderThatWillFailDueBadCurrencyCodeAssert_INVALID_CURRENCY() {
		$mockHttp = new HttpMock(create_function('','return TestHelper::factoryHttpEventWithError("VALIDATION_ERROR");'));
		
		$obj = new RequestCreateOrder($mockHttp);
		$obj->orderNumber(TestHelper::getRandomOrderNumber())->currencyCode("seka")->totalAmount(100);
		$response = $obj->request();
		
		$this->assertEquals($response->status()->statusKey(),"VALIDATION_ERROR");
	}
	
	
	
	public function test_assertSuccessOnCreateOrderWithTwoLineItems() {
		//TestHelper::setSandboxCredentials();
		
		$obj = RequestCreateOrder::factory(
			array(
				"orderNumber"=>TestHelper::getRandomOrderNumber(),
				"currencyCode" =>"SEK",
				"totalAmount" => 125,
				"lineItems" => array(
						array(
								"id" => TestHelper::getRandomOrderNumber(),
								"articleNumber" => TestHelper::getRandomNumber(),
								"name" => "Foo",
								"quantity" => 1,
								"unitMeasure" =>"st.",
								"unitAmountExcludingTax" => 50,
								"taxPercent" => 25,
								"totalLineTaxAmount" =>round(1*50*(25/100),2),
								"totalLineAmount" => 62.50,
								"travelData" =>array(
										"bookingReference"=>"foo",
										"travelSegments"=>array(
												array(
														"departureDate"=>"2014-06-01",
														"departureTime"=>"21:00",
														"departureCountryCode"=>"SWE",
														"departureAirportCode"=>"IATA:ARN",
														"arrivalDate"=>"2014-08-01",
														"arrivalTime"=>"21:00",
														"arrivalCountryCode"=>"SWE",
														"arrivalAirportCode"=>"IATA:ARN",
														"carrierDesignator"=>"IATA:SK",
														"tickets"=>array(
																array(
																		"isRefundable"=>false,
																		"isRebookable"=>false,
																		"passenger"=>array(
																				"name"=>array(
																						"firstName"=>"FooAir",
																						"lastName"=>"FiiAir"
																				)
																		)
																)
																	
														)
												)
										)
								)
						),array(
								"id" => TestHelper::getRandomOrderNumber(),
								"articleNumber" => TestHelper::getRandomNumber(),
								"name" => "Foo2",
								"quantity" => 1,
								"unitMeasure" =>"st.",
								"unitAmountExcludingTax" => 50,
								"taxPercent" => 25,
								"totalLineTaxAmount" =>round(1*50*(25/100),2),
								"totalLineAmount" => 62.50,
								"travelData" =>array(
									"bookingReference"=>"foo",
									"travelSegments"=>array(
											array(
													"departureDate"=>"2014-06-01",
													"departureTime"=>"21:00",
													"departureCountryCode"=>"SWE",
													"departureStationCode"=>"foo",
													"arrivalDate"=>"2014-08-01",
													"arrivalTime"=>"21:00",
													"arrivalCountryCode"=>"SWE",
													"arrivalStationCode"=>"foo",
													"carrierDesignator"=>"UIC:1174",
													"tickets"=>array(
														array(
															"isRefundable"=>true,
															"isRebookable"=>false,
															"passenger"=>array(
																"name"=>array(
																	"firstName"=>"Foo",
																	"lastName"=>"Fii"
																)
															)
														)
													
													)	
											)
									)
								)
						)
				)		
			)
		);
		$mockOrderId = TestHelper::getRandomOrderId();
		
		$mockHttp = new HttpMock(create_function('','return TestHelper::factoryHttpEventWithSuccess(\'SUCCESS_CREATE_ORDER\',\''.$mockOrderId.'\');'));
		//$mockHttp = new HttpImpl();
		$obj->setHttp($mockHttp);
		$response = $obj->request();
		
		$this->assertEquals( $response->status()->isSuccess, 1);
		$this->assertTrue( $response->status()->errors()->size()==0 );
		$this->assertNotEmpty($response->orderId());
	}
	
	
}