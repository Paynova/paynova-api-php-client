<?php
require_once __DIR__."/../../../TestHelper.php";
class TravelSegmentCollectionTest extends PHPUnit_Framework_TestCase {

	public function test_construct(){
		$this->assertInstanceOf("TravelSegmentCollection",new TravelSegmentCollection());
		
	}
	
	public function test_storeDifferentTravelSegmentTypes() {
		$collection = new TravelSegmentCollection();
		$collection->push(new TravelSegmentRail());
		$collection->push(new TravelSegmentAir());
		$subclasses = Util::getSubclasses("TravelSegment");
		foreach ($collection as $segment) {
			$this->assertTrue(in_array(get_class($segment),$subclasses));
		}
	}
	
	public function test_typeObjectsToStore() {
		$this->assertEquals(TravelSegmentCollection::getClassnameOfTypeToStore(),"TravelSegment");
	}
}