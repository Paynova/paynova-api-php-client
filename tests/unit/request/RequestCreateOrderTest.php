<?php
require_once __DIR__."/../../TestHelper.php";

class RequestCreateOrderTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @expectedException InvalidArgumentException
     */
	public function testSetCustomerWrongType() {
		$request = new RequestCreateOrder();
		$request->customer(new Name());
	}
	
	/**
	 * 
	 */
	public function testSetCustomer() {
		$request = new RequestCreateOrder();
		$request->customer(new Customer());
		$customer = $request->customer();
		$this->assertTrue(get_class($customer) == "Customer");
	}
	
	
}