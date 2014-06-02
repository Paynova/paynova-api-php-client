<?php
require_once __DIR__."/../../TestHelper.php";

class RequestGetCustomerProfileTest extends PHPUnit_Framework_TestCase {
	
	public function test_construct() {
		$request = new RequestGetCustomerProfile();
		$this->assertInstanceOf("RequestGetCustomerProfile", $request);
		return $request;
	}
	
	/**
	 * @depends test_construct
	 * @param RequestGetCustomerProfile $request
	 */
	public function test_profileId(RequestGetCustomerProfile $request) {
		$request->profileId("foo");
		$this->assertEquals($request->profileId(),"foo");
	}
	
	
	
	public function test_factory() {
		$request1 = RequestGetCustomerProfile::factory(array(
				"profileId"=>"foo"
		));
		$request1->validateRequired();
	
		$request2 = new RequestGetCustomerProfile();
		$request2->profileId("foo");
		$request2->validateRequired();
	
		$this->assertEquals($request1,$request2);
	}
	
	/**
	 * @expectedException PaynovaExceptionRequiredPropertyMissing
	 */
	public function test_requestWithInsufficentParametersSet() {
		$request = RequestGetCustomerProfile::factory(array(
				
		));
		$request->request();
	}
	
}