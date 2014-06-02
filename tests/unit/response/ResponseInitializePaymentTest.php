<?php
require_once __DIR__."/../../TestHelper.php";

class ResponseInitializePaymentTest extends PHPUnit_Framework_TestCase {
	
	public function test_factoryByHttpEvent() {
		$mockUrl = "http://www.foo.com";
		$httpEvent = TestHelper::factoryHttpEventWithSuccess("SUCCESS_INITALIZE_PAYMENT","'.$mockUrl.'");
		$obj = ResponseInitializePayment::factoryByHttpEvent($httpEvent);
		$this->assertInstanceOf("ResponseInitializePayment", $obj);
		
	} 
}