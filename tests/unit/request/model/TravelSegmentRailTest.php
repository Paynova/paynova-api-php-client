<?php
require_once __DIR__."/../../../TestHelper.php";

use Paynova\request\model\TravelSegmentRail;

class TravelSegmentRailTest extends PHPUnit_Framework_TestCase {
	
	public function test_factory(){
		$obj1 = TravelSegmentRail::factory(
				array(
						"departureStationCode"=>"foo",
						"arrivalStationCode"=>"foo",
						
				)
		
		);
		
		$this->assertInstanceOf("Paynova\\request\\model\\TravelSegmentRail",$obj1);
		
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
		$specialArgumentFunction = create_function('$method,$param','return $method=="segmentType"?Paynova\\request\\model\\TravelSegmentAir::SEGMENT_TYPE_RAIL:$param;');
		TestHelper::assert_modelSignature($this,$object, $specialArgumentFunction);
	}
}