<?php
require_once __DIR__."/../../TestHelper.php";

class RequestInitializePaymentTest extends PHPUnit_Framework_TestCase {
	public function test_construct() {
		$request = new RequestInitializePayment();
		$this->assertInstanceOf("RequestInitializePayment", $request);
		return $request;
	}
	
	/**
	 * @depends test_construct
	 * @param RequestInitializePayment $request
	 */
	public function test_orderId(RequestInitializePayment $request) {
		$request->orderId("foo");
		$this->assertEquals($request->orderId(),"foo");
	}
	
	/**
	 * @depends test_construct
	 * @param RequestInitializePayment $request
	 */
	public function test_totalAmount(RequestInitializePayment $request) {
		$request->totalAmount(100);
		$this->assertEquals($request->totalAmount(),100);
	}
	
	/**
	 * @depends test_construct
	 * @param RequestInitializePayment $request
	 */
	public function test_paymentMethods(RequestInitializePayment $request) {
		$request->paymentMethods(new PaymentMethodCollection());
		$this->assertInstanceOf("PaymentMethodCollection",$request->paymentMethods());
	}
	
	/**
	 * @depends test_construct
	 * @param RequestInitializePayment $request
	 */
	public function test_customData(RequestInitializePayment $request) {
		$request->customData(new CustomDataCollection());
		$this->assertInstanceOf("CustomDataCollection",$request->customData());
	}
	
	/**
	 * @depends test_construct
	 * @param RequestInitializePayment $request
	 */
	public function test_sessionTimeout(RequestInitializePayment $request) {
		$request->sessionTimeout("foo");
		$this->assertEquals($request->sessionTimeout(),"foo");
	}
	
	/**
	 * @depends test_construct
	 * @param RequestInitializePayment $request
	 */
	public function test_routingIndicator(RequestInitializePayment $request) {
		$request->routingIndicator("foo");
		$this->assertEquals($request->routingIndicator(),"foo");
	}
	
	
	/**
	 * @depends test_construct
	 * @param RequestInitializePayment $request
	 */
	public function test_fraudScreeningProfile(RequestInitializePayment $request) {
		$request->fraudScreeningProfile("foo");
		$this->assertEquals($request->fraudScreeningProfile(),"foo");
	}
	
	/**
	 * @depends test_construct
	 * @param RequestInitializePayment $request
	 */
	public function test_interfaceOptions(RequestInitializePayment $request) {
		$request->interfaceOptions(new InterfaceOptions());
		$this->assertInstanceOf("InterfaceOptions",$request->interfaceOptions());
	}
	
	/**
	 * @depends test_construct
	 * @param RequestInitializePayment $request
	 */
	public function test_profilePaymentOptions(RequestInitializePayment $request) {
		$request->profilePaymentOptions(new ProfilePaymentOptions());
		$this->assertInstanceOf("ProfilePaymentOptions",$request->profilePaymentOptions());
	}
	
	/**
	 * @depends test_construct
	 * @param RequestInitializePayment $request
	 */
	public function test_lineItems(RequestInitializePayment $request) {
		$request->lineItems(new LineItemCollection());
		$this->assertInstanceOf("LineItemCollection",$request->lineItems());
	}
	
	
}