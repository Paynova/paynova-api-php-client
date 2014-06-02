<?php
require_once __DIR__."/../../../TestHelper.php";

class TravelSegmentRailTest extends PHPUnit_Framework_TestCase {
	
	public function test_factory(){
		$obj1 = TravelSegmentRail::factory(
				array(
						"departureStationCode"=>"foo",
						"arrivalStationCode"=>"foo",
						
				)
		
		);
		$this->assertInstanceOf("TravelSegmentRail",$obj1);
		
		$obj2 = new TravelSegmentRail();
		$obj2->departureStationCode("foo")
			->arrivalStationCode("foo");
		$this->assertEquals($obj1,$obj2);
	}
	/**
	 * Asserts that all property-method(and working) are declared. Check this against the signature
	 */
	public function test_propertiesAgainstSignature(){
		$object = new TravelSegmentRail();
		$signature = $object->getSignature();
		foreach($signature as $key=>$value) {
			$method = $value;
			$param = "";
		
			if(!is_int($key) && class_exists($value)) {
				$method=$key;
				$param = new $value();
			}else {
				if($value=="segmentType")$param ="RAIL";
				else $param = "foo";
			}
			call_user_func_array(array($object,$method),array($param));
			$this->assertEquals(call_user_func_array(array($object,$method),array()),$param);
		}
	}
}