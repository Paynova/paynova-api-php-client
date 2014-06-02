<?php
require_once __DIR__."/../../../TestHelper.php";
class CustomDataTest extends PHPUnit_Framework_TestCase {
	
	public function test_constructor() {
		return new CustomData();
	}
	
	
	
	public function test_propertiesAgainstSignature(){
		$object = new CustomData();
		$properties = $object->getPropertiesAsArray(false);
		foreach($properties as $key=>$value) {
			$fooValue = $key;
			call_user_func_array(array($object,$key),array($fooValue));
			$this->assertEquals(call_user_func_array(array($object,$key),array()),$fooValue);
		}
	}
	
	public function test_factory() {
		$obj = CustomData::factory(array(
			"key"=>"foo", "value"=>"fii"
		));
		$this->assertEquals($obj->key(),"foo");
		$this->assertEquals($obj->value(),"fii");
	}
}