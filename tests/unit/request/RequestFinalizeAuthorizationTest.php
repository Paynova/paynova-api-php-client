<?php
require_once __DIR__."/../../TestHelper.php";

use Paynova\request\model\LineItemCollection;
use Paynova\request\RequestFinalizeAuthorization;

class RequestFinalizeAuthorizationTest extends PHPUnit_Framework_TestCase {
	
	public function test_construct() {
		$request = new RequestFinalizeAuthorization();
		$this->assertInstanceOf("Paynova\\request\\RequestFinalizeAuthorization", $request);
		return $request;
	}
	
	/**
	 * @depends test_construct
	 * @param RequestFinalizeAuthorization $request
	 */
	public function test_orderId(RequestFinalizeAuthorization $request) {
		$request->orderId("foo");
		$this->assertEquals($request->orderId(),"foo");
	}
	
	/**
	 * @depends test_construct
	 * @param RequestFinalizeAuthorization $request
	 */
	public function test_transactionId(RequestFinalizeAuthorization $request) {
		$request->transactionId("foo");
		$this->assertEquals($request->transactionId(),"foo");
	}
	
	/**
	 * @depends test_construct
	 * @param RequestFinalizeAuthorization $request
	 */
	public function test_totalAmount(RequestFinalizeAuthorization $request) {
		$request->totalAmount(100);
		$this->assertEquals($request->totalAmount(),100);
	}
	
	/**
	 * @depends test_construct
	 * @param RequestFinalizeAuthorization $request
	 */
	public function test_lineItems(RequestFinalizeAuthorization $request) {
		$request->lineItems(new LineItemCollection());
		$this->assertInstanceOf("Paynova\\request\\model\\LineItemCollection",$request->lineItems());
	}
	
	/**
	 * @depends test_construct
	 * @param RequestFinalizeAuthorization $request
	 */
	public function test_invoiceId(RequestFinalizeAuthorization $request) {
		$request->invoiceId("foo");
		$this->assertEquals($request->invoiceId(),"foo");
	}
	
	public function test_factory() {
		$request1 = RequestFinalizeAuthorization::factory(array(
				"orderId"=>"foo",
				"transactionId"=>"foo",
				"totalAmount"=>100
		));
		$request1->validateRequired();
		
		$request2 = new RequestFinalizeAuthorization();
		$request2->orderId("foo")->transactionId("foo")->totalAmount(100);
		$request2->validateRequired();
		
		$this->assertEquals($request1,$request2);
	}
	
	/**
	 * @expectedException Paynova\exception\PaynovaExceptionRequiredPropertyMissing
	 */
	public function test_requestWithInsufficentParametersSet() {
		$request = RequestFinalizeAuthorization::factory(array(
				"orderId"=>"foo",
				"transactionId"=>"foo"
		));
		$request->request();
	}
}