<?php
require_once __DIR__."/../../TestHelper.php";

class ResponseRemoveCustomerProfileTest extends PHPUnit_Framework_TestCase {
	
	public function test_factoryByHttpEvent() {
		$httpEvent = TestHelper::factoryHttpEventWithSuccess("SUCCESS");
		$response = ResponseRemoveCustomerProfile::factoryByHttpEvent($httpEvent);
		
		$this->assertInstanceOf("ResponseRemoveCustomerProfile",$response);
		return $response;
	}
	
	/**
	 * @depends test_factoryByHttpEvent
	 */
	public function test_status(ResponseRemoveCustomerProfile $response) {
		$this->assertInstanceOf("Status",$response->status());
	}
}