<?php
require_once __DIR__."/../../../TestHelper.php";

use Paynova\request\model\TravelSegmentAir;
use Paynova\request\model\TravelSegment;

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
		$specialArgumentFunction = create_function('$method,$param','return $method=="segmentType"?Paynova\\request\\model\\TravelSegmentAir::SEGMENT_TYPE_AIR:$param;');
		TestHelper::assert_modelSignature($this,$object, $specialArgumentFunction);
	}
}