<?php
require_once __DIR__."/../../TestHelper.php";

use Paynova\response\ResponseFinalizeAuthorization;

class ResponseFinalizeAuthorizationTest extends PHPUnit_Framework_TestCase {
	
	public function test_factoryByHttpEvent() {
		
		$httpEvent =TestHelper::factoryHttpEventWithSuccess("SUCCESS_FINALIZE_AUTHORIZATION",100.00,TestHelper::getRandomTransactionId());
		
		$response = ResponseFinalizeAuthorization::factoryByHttpEvent($httpEvent);
		
		return $response;
	}

	/**
	 * @depends test_factoryByHttpEvent
	 */
	public function test_status(ResponseFinalizeAuthorization $response) {
		$this->assertInstanceOf("Paynova\\response\\model\\Status",$response->status());
	}
	
	
}