<?php
require_once __DIR__."/../../TestHelper.php";

use Paynova\request\model\Name;
use Paynova\request\model\Customer;

use Paynova\request\RequestCreateOrder;

class RequestCreateOrderTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @expectedException \InvalidArgumentException
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
		$this->assertInstanceOf("Paynova\\request\\model\Customer",$customer);
	}
	
	
}