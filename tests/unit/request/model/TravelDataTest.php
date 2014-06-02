<?php
require_once __DIR__."/../../../TestHelper.php";

class TravelDataTest extends PHPUnit_Framework_TestCase {
	
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
		$o1 = TravelData::factory(array(
				"bookingReference"=>"foo",
				"travelSegments"=>array(),
		));
		$o2 = new TravelData();
		$o2->bookingReference("foo");
		$this->assertEquals($o1,$o2);
	}
}