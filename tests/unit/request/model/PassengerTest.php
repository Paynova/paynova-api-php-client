<?php
require_once __DIR__."/../../../TestHelper.php";

use Paynova\request\model\Passenger;

class PassengerTest extends PHPUnit_Framework_TestCase {
	
	public function test_propertiesAgainstSignature(){
		$object = new Passenger();
		TestHelper::assert_modelSignature($this,$object);
	}
	
	public function test_factory(){
		$o1 = Passenger::factory(array(
				"name"=>array(
					"firstName"=>"foo",
					"lastName"=>"foo"
				),
				"telephone"=>"1234567",
				"emailAddress"=>"foo@foo.com"
				
			
		));
		$o2 = new Passenger();
		$o2->name()->firstName("foo")->lastName("foo");
		$o2->telephone("1234567")->emailAddress("foo@foo.com");
		$this->assertEquals($o1,$o2);
	}
}