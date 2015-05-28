<?php
require_once __DIR__."/../../TestHelper.php";

use Paynova\model\NameAddress;

class NameAddressTest extends PHPUnit_Framework_TestCase {
	
	public function test_propertiesAgainstSignature(){
		$object = new NameAddress();
		TestHelper::assert_modelSignature($this,$object);
	}
	
	public function test_factory(){
		$na1 = NameAddress::factory(array(
				"name"=>array(
						"firstName"=>"foo",
						"lastName"=>"foo"
				),
				"address"=>array(
					"street1"=>"The street 1",
					"street2"=>"The street 2",
					"street3"=>"The street 3"
			)
		));
		$na2 = new NameAddress();
		$na2->name()->firstName("foo")->lastName("foo");
		$na2->address()->street1("The street 1")->street2("The street 2")->street3("The street 3");
		$this->assertEquals($na1,$na2);
	}
}