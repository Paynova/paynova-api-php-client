<?php
require_once __DIR__."/../../TestHelper.php";

class ResponseAnnulAuthorizationTest extends PHPUnit_Framework_TestCase {
	
	public function test_factoryByHttpEvent() {
		
		$httpEvent = TestHelper::factoryHttpEventWithSuccess("SUCCESS");
		
		$obj = ResponseAnnulAuthorization::factoryByHttpEvent($httpEvent);
		
		$this->assertEquals($obj->status->isSuccess(), true);
	} 
}