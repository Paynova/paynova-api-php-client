<?php
require_once __DIR__."/../../../TestHelper.php";

use Paynova\request\model\TravelData;
use Paynova\util\PaynovaCollection;

class TravelDataTest extends PHPUnit_Framework_TestCase {
	
	public function test_propertiesAgainstSignature(){
		$object = new TravelData();
		TestHelper::assert_modelSignature($this,$object);
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