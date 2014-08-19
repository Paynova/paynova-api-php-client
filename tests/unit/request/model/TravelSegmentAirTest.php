<?php
require_once __DIR__."/../../../TestHelper.php";

use Paynova\request\model\TravelSegmentAir;

class TravelSegmentAirTest extends PHPUnit_Framework_TestCase {
	
	public function test_factory(){
		$obj1 = TravelSegmentAir::factory(
				array(
						"departureAirportCode"=>"foo",
						"arrivalAirportCode"=>"foo",
						
				)
		
		);
		$this->assertInstanceOf("Paynova\\request\\model\\TravelSegmentAir",$obj1);
		
		$obj2 = new TravelSegmentAir();
		$obj2->departureAirportCode("foo")
			->arrivalAirportCode("foo");
		$this->assertEquals($obj1,$obj2);
	}
	/**
	 * Asserts that all property-method(and working) are declared. Check this against the signature
	 */
	public function test_propertiesAgainstSignature(){
		$object = new TravelSegmentAir();
		$signature = $object->getSignature();
		foreach($signature as $key=>$value) {
			$method = $value;
			$param = "";
		
			if(!is_int($key) && class_exists($value)) {
				$method=$key;
				$param = new $value();
			}else {
				if($value=="segmentType")$param ="AIR";
				else $param = "foo";
			}
			call_user_func_array(array($object,$method),array($param));
			$this->assertEquals(call_user_func_array(array($object,$method),array()),$param);
		}
	}
}