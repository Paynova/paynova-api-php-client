<?php
require_once __DIR__."/../../../TestHelper.php";

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
		$signature = $object->getSignature();
		foreach($signature as $key=>$value) {
			$method = $value;
			$param = "";
		
			if(!is_int($key) && class_exists($value)) {
				$method=$key;
				$param = new $value();
			}else {
				$param = "foo";
			}
			call_user_func_array(array($object,$method),array($param));
			$this->assertEquals(call_user_func_array(array($object,$method),array()),$param);
		}
	}
}