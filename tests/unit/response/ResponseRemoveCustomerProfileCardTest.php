<?php
require_once __DIR__."/../../TestHelper.php";

use Paynova\response\ResponseRemoveCustomerProfileCard;

class ResponseRemoveCustomerProfileCardTest extends PHPUnit_Framework_TestCase {
	
	public function test_factoryByHttpEvent() {
		$httpEvent = TestHelper::factoryHttpEventWithSuccess("SUCCESS");
		
		$response = ResponseRemoveCustomerProfileCard::factoryByHttpEvent($httpEvent);
		
		$this->assertInstanceOf("Paynova\\response\\ResponseRemoveCustomerProfileCard",$response);
		return $response;
	}
	
	/**
	 * @depends test_factoryByHttpEvent
	 */
	public function test_status(ResponseRemoveCustomerProfileCard $response) {
		$this->assertInstanceOf("Paynova\\response\\model\\Status",$response->status());
	}
}