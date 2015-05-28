<?php
require_once __DIR__."/../../TestHelper.php";

use Paynova\model\Address;

class AddressTest extends PHPUnit_Framework_TestCase {
	
	
	public function test_propertiesAgainstSignature(){
		$object = new Address();
		TestHelper::assert_modelSignature($this,$object);
	}
	
	public function test_factory(){
		$address1 = Address::factory(array(
			"street1"=>"The street 1",
			"street2"=>"The street 2",
			"street3"=>"The street 3"
		));
		$address2 = new Address();
		$address2->street1("The street 1")->street2("The street 2")->street3("The street 3");
		$this->assertEquals($address1,$address2);
	}
}