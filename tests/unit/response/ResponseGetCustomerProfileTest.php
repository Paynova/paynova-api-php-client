<?php
require_once __DIR__."/../../TestHelper.php";

use Paynova\response\ResponseGetCustomerProfile;

class ResponseGetCustomerProfileTest extends PHPUnit_Framework_TestCase {
	
	public function test_factoryByHttpEvent() {
		$httpEvent = TestHelper::factoryHttpEventWithSuccess("SUCCESS_GET_CUSTOMER_PROFILE","mock1234");
		
		$response = ResponseGetCustomerProfile::factoryByHttpEvent($httpEvent);
		$this->assertInstanceOf("Paynova\\response\\ResponseGetCustomerProfile",$response);
		return $response;
	}
	
	
}