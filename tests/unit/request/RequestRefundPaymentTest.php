<?php
require_once __DIR__."/../../TestHelper.php";

class RequestRefundPaymentTest extends PHPUnit_Framework_TestCase {
	
	public function test_construct() {
		$request = new RequestRefundPayment();
		$this->assertInstanceOf("RequestRefundPayment", $request);
		return $request;
	}
	
	/**
	 * @depends test_construct
	 * @param RequestRefundPayment $request
	 */
	public function test_orderId(RequestRefundPayment $request) {
		$request->orderId("foo");
		$this->assertEquals($request->orderId(),"foo");
	}
	
	/**
	 * @depends test_construct
	 * @param RequestRefundPayment $request
	 */
	public function test_transactionId(RequestRefundPayment $request) {
		$request->transactionId("foo");
		$this->assertEquals($request->transactionId(),"foo");
	}
	
	/**
	 * @depends test_construct
	 * @param RequestRefundPayment $request
	 */
	public function test_totalAmount(RequestRefundPayment $request) {
		$request->totalAmount(100);
		$this->assertEquals($request->totalAmount(),100);
	}
	
	/**
	 * @depends test_construct
	 * @param RequestRefundPayment $request
	 */
	public function test_lineItems(RequestRefundPayment $request) {
		$request->lineItems(new LineItemCollection());
		$this->assertInstanceOf("LineItemCollection",$request->lineItems());
	}
	
	/**
	 * @depends test_construct
	 * @param RequestRefundPayment $request
	 */
	public function test_invoiceId(RequestRefundPayment $request) {
		$request->invoiceId(100);
		$this->assertEquals($request->invoiceId(),100);
	}
	
	public function test_factory() {
		$request1 = RequestRefundPayment::factory(array(
				"orderId"=>"foo",
				"transactionId"=>"foo",
				"totalAmount"=>100
		));
		$request1->validateRequired();
	
		$request2 = new RequestRefundPayment();
		$request2->orderId("foo")->transactionId("foo")->totalAmount(100);
		$request2->validateRequired();
	
		$this->assertEquals($request1,$request2);
	}
	
	/**
	 * @expectedException PaynovaExceptionRequiredPropertyMissing
	 */
	public function test_requestWithInsufficentParametersSet() {
		$request = RequestRefundPayment::factory(array(
				"transactionId"=>"foo"
		));
		$request->request();
	}
	
}