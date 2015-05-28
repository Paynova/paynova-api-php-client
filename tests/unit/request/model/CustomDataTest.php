<?php
require_once __DIR__."/../../../TestHelper.php";

use Paynova\request\model\CustomData;

class CustomDataTest extends PHPUnit_Framework_TestCase {
	
	public function test_constructor() {
		return new CustomData();
	}
	
	
	
	public function test_propertiesAgainstSignature(){
		$object = new CustomData();
		TestHelper::assert_modelSignature($this,$object);
	}
	
	public function test_factory() {
		$obj = CustomData::factory(array(
			"key"=>"foo", "value"=>"fii"
		));
		$this->assertEquals($obj->key(),"foo");
		$this->assertEquals($obj->value(),"fii");
	}
}