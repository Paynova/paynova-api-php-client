<?php
require_once __DIR__."/../../TestHelper.php";

use Paynova\request\RequestRemoveCustomerProfile;

class RequestRemoveCustomerProfileTest extends PHPUnit_Framework_TestCase {
	
	public function test_construct() {
		$request = new RequestRemoveCustomerProfile();
		$this->assertInstanceOf("Paynova\\request\\RequestRemoveCustomerProfile", $request);
		return $request;
	}
	
	/**
	 * @depends test_construct
	 * @param RequestRemoveCustomerProfile $request
	 */
	public function test_profileId(RequestRemoveCustomerProfile $request) {
		$request->profileId("foo");
		$this->assertEquals($request->profileId(),"foo");
	}
	
	
	
	public function test_factory() {
		$request1 = RequestRemoveCustomerProfile::factory(array(
				"profileId"=>"foo"
		));
		$request1->validateRequired();
	
		$request2 = new RequestRemoveCustomerProfile();
		$request2->profileId("foo");
		$request2->validateRequired();
	
		$this->assertEquals($request1,$request2);
	}
	
	/**
	 * @expectedException Paynova\exception\PaynovaExceptionRequiredPropertyMissing
	 */
	public function test_requestWithInsufficentParametersSet() {
		$request = RequestRemoveCustomerProfile::factory(array(
				
		));
		$request->request();
	}
	
}