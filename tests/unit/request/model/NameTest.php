<?php
require_once __DIR__."/../../../TestHelper.php";

class NameTest extends PHPUnit_Framework_TestCase {
	
	public function test_propertiesAgainstSignature(){
		$object = new Address();
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