<?php
require_once __DIR__."/../../TestHelper.php";

use Paynova\model\Name;

class NameTest extends PHPUnit_Framework_TestCase {
	
	public function test_propertiesAgainstSignature(){
		$object = new Name();
		TestHelper::assert_modelSignature($this,$object);
	}
	
	public function test_factory(){
		$n1 = Name::factory(array(
				"firstName"=>"foo",
				"lastName"=>"foo"
				
			
		));
		$n2 = new Name();
		$n2->firstName("foo")->lastName("foo");
		$this->assertEquals($n1,$n2);
	}
}