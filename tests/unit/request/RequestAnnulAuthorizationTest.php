<?php
require_once __DIR__."/../../TestHelper.php";

class RequestAnnulAuthorizationTest extends PHPUnit_Framework_TestCase {
	
	public function test_construct() {
		$request = new RequestAnnulAuthorization();
		$this->assertInstanceOf("RequestAnnulAuthorization", $request);
		return $request;
	}
	
	/**
	 * @depends test_construct
	 * @param RequestAnnulAuthorization $request
	 */
	public function test_orderId(RequestAnnulAuthorization $request) {
		$request->orderId("123foo");
		$this->assertEquals($request->orderId(),"123foo");
	}
	
	/**
	 * @depends test_construct
	 * @param RequestAnnulAuthorization $request
	 */
	public function test_transactionId(RequestAnnulAuthorization $request) {
		$request->transactionId("foo");
		$this->assertEquals($request->transactionId(),"foo");
	}
	
	/**
	 * @depends test_construct
	 * @param RequestAnnulAuthorization $request
	 */
	public function test_totalAmount(RequestAnnulAuthorization $request) {
		$request->totalAmount(100);
		$this->assertEquals($request->totalAmount(),100);
	}
	
	/**
	 * @depends test_construct
	 * @param RequestAnnulAuthorization $request
	 */
	public function test_lineItems(RequestAnnulAuthorization $request) {
		$request->lineItems(new LineItemCollection());
		$this->assertInstanceOf("LineItemCollection",$request->lineItems());
	}
	
	/**
	 * @depends test_construct
	 * @param RequestAnnulAuthorization $request
	 */
	public function test_customData(RequestAnnulAuthorization $request) {
		$request->customData(new CustomDataCollection());
		$this->assertInstanceOf("CustomDataCollection",$request->customData());
	}
	
	
	
	public function test_factory() {
		$request1 = RequestAnnulAuthorization::factory(array(
				"transactionId"=>"foo"
		));
		$request1->validateRequired();
		
		$request2 = new RequestAnnulAuthorization();
		$request2->transactionId("foo");
		$request2->validateRequired();
		
		$this->assertEquals($request1,$request2);
	}
	
	/**
	 * @expectedException PaynovaExceptionRequiredPropertyMissing
	 */
	public function test_requestWithInsufficentParametersSet() {
		$request = RequestAnnulAuthorization::factory(array(
				
		));
		$request->request();
	}
}