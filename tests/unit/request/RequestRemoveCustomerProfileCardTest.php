<?php
require_once __DIR__."/../../TestHelper.php";

use Paynova\request\RequestRemoveCustomerProfileCard;

class RequestRemoveCustomerProfileCardTest extends PHPUnit_Framework_TestCase {
	
	public function test_construct() {
		$request = new RequestRemoveCustomerProfileCard();
		$this->assertInstanceOf("Paynova\\request\\RequestRemoveCustomerProfileCard", $request);
		return $request;
	}
	
	/**
	 * @depends test_construct
	 * @param RequestRemoveCustomerProfileCard $request
	 */
	public function test_profileId(RequestRemoveCustomerProfileCard $request) {
		$request->profileId("foo");
		$this->assertEquals($request->profileId(),"foo");
	}
	
	/**
	 * @depends test_construct
	 * @param RequestRemoveCustomerProfileCard $request
	 */
	public function test_cardId(RequestRemoveCustomerProfileCard $request) {
		$request->cardId("foo");
		$this->assertEquals($request->profileId(),"foo");
	}
	
	
	
	public function test_factory() {
		$request1 = RequestRemoveCustomerProfileCard::factory(array(
				"profileId"=>"foo",
				"cardId"=>"foo"
		));
		$request1->validateRequired();
	
		$request2 = new RequestRemoveCustomerProfileCard();
		$request2->profileId("foo")->cardId("foo");
		$request2->validateRequired();
	
		$this->assertEquals($request1,$request2);
	}
	
	/**
	 * @expectedException Paynova\exception\PaynovaExceptionRequiredPropertyMissing
	 */
	public function test_requestWithInsufficentParametersSet() {
		$request = RequestRemoveCustomerProfileCard::factory(array(
				
		));
		$request->request();
	}
	
}