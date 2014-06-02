<?php
require_once __DIR__."/../../TestHelper.php";

class ResponseRemoveCustomerProfileCardTest extends PHPUnit_Framework_TestCase {
	
	public function test_factoryByHttpEvent() {
		$httpEvent = TestHelper::factoryHttpEventWithSuccess("SUCCESS");
		
		$response = ResponseRemoveCustomerProfileCard::factoryByHttpEvent($httpEvent);
		
		$this->assertInstanceOf("ResponseRemoveCustomerProfileCard",$response);
		return $response;
	}
	
	/**
	 * @depends test_factoryByHttpEvent
	 */
	public function test_status(ResponseRemoveCustomerProfileCard $response) {
		$this->assertInstanceOf("Status",$response->status());
	}
}