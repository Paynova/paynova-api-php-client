<?php
require_once __DIR__."/../../../TestHelper.php";

use Paynova\request\model\TravelSegmentCollection;
use Paynova\request\model\TravelSegmentRail;
use Paynova\request\model\TravelSegmentAir;
use Paynova\util\Util;

class TravelSegmentCollectionTest extends PHPUnit_Framework_TestCase {

	public function test_construct(){
		$this->assertInstanceOf("Paynova\\request\\model\\TravelSegmentCollection",new TravelSegmentCollection());
		
	}
	
	public function test_storeDifferentTravelSegmentTypes() {
		$collection = new TravelSegmentCollection();
		$collection->push(new TravelSegmentRail());
		$collection->push(new TravelSegmentAir());
		$subclasses = Util::getSubclasses("Paynova\\request\\model\\TravelSegment");
		foreach ($collection as $segment) {
			$this->assertTrue(in_array(get_class($segment),$subclasses));
		}
	}
	
	public function test_typeObjectsToStore() {
		$this->assertEquals(TravelSegmentCollection::getClassnameOfTypeToStore(),"Paynova\\request\\model\\TravelSegment");
	}
}