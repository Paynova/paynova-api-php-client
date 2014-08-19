<?php
ini_set('display_errors',1);
/*
 * Set the credentials for calling the API server
 * in examples/examples_config.php
 * 
*/
include "examples_config.php";

use Paynova\request\RequestCreateOrder;

$obj = RequestCreateOrder::factory(
	array(
		"orderNumber"=>rand(999,99999)."-".rand(999,99999),
		"currencyCode" =>"SEK",
		"totalAmount" => "125",
		"lineItems" => array(
				array(
						"id" => rand(999,99999)."-".rand(999,99999),
						"articleNumber" => rand(999,99999),
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
						"id" => rand(999,99999),
						"articleNumber" => rand(999,99999),
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
													"isRefundable"=>false,
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


//The status object
try{
	$response = $obj->request();
	if($response->status()->isSuccess==1) {
		echo $response->status();
	}else {
		//Use the error collection
		//$initResponse->status()->errors();
	}	
}
catch(Paynova\exception\PaynovaExceptionHttp $e){
	echo $e->getMessage();
}

//The httpevent - inspect what was sent and received
//echo $response->getHttpEvent();
		







