<?php
require_once __DIR__."/../../../TestHelper.php";

use Paynova\request\model\Customer;
use Paynova\model\Name;

class CustomerTest extends PHPUnit_Framework_TestCase {
	
	
	
	public function test_factory(){
		$obj1 = Customer::factory(array(
			"customerId"=>"123",
			"emailAddress"=>"foo@foo.com", 
			"name"=> array(
				"title"=>"Mr",
				"firstName"=>"Foo"
					
			),
			"homeTelephone"=>"+468123456",
			"workTelephone"=>"+468123456",
			"mobileTelephone"=>"+468123456" 
		
		));
		$obj2 = new Customer();
		$obj2->customerId("123")
			->emailAddress("foo@foo.com")
			->name(new Name())->title("Mr")
			->firstName("Foo");
		$obj2->homeTelephone("+468123456")
			->workTelephone("+468123456")
			->mobileTelephone("+468123456");
		$this->assertEquals($obj1,$obj2);
	}
	/**
	 * Asserts that all property-method(and working) are declared. Check this against the signature
	 */
	public function test_propertiesAgainstSignature(){
		$object = new Customer();
		TestHelper::assert_modelSignature($this,$object);
	}
}