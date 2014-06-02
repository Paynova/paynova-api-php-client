<?php
require_once __DIR__."/../../../TestHelper.php";
class CustomDataCollectionTest extends PHPUnit_Framework_TestCase {

	public function test_construct(){
		$this->assertInstanceOf("CustomDataCollection",new CustomDataCollection());
		
	}
	
	
	public function test_typeObjectsToStore() {
		$this->assertEquals(CustomDataCollection::getClassnameOfTypeToStore(),"CustomData");
	}
}