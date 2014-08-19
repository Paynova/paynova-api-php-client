<?php
require_once __DIR__."/../../TestHelper.php";

use Paynova\response\ResponseRemoveCustomerProfile;

class ResponseRemoveCustomerProfileTest extends PHPUnit_Framework_TestCase {
	
	public function test_factoryByHttpEvent() {
		$httpEvent = TestHelper::factoryHttpEventWithSuccess("SUCCESS");
		$response = ResponseRemoveCustomerProfile::factoryByHttpEvent($httpEvent);
		
		$this->assertInstanceOf("Paynova\\response\\ResponseRemoveCustomerProfile",$response);
		return $response;
	}
	
	/**
	 * @depends test_factoryByHttpEvent
	 */
	public function test_status(ResponseRemoveCustomerProfile $response) {
		$this->assertInstanceOf("Paynova\\response\\model\\Status",$response->status());
	}
}