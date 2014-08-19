<?php
require_once __DIR__."/../../../TestHelper.php";

use Paynova\request\model\CustomDataCollection;

class CustomDataCollectionTest extends PHPUnit_Framework_TestCase {

	public function test_construct(){
		$this->assertInstanceOf("Paynova\\request\\model\\CustomDataCollection",new CustomDataCollection());
		
	}
	
	
	public function test_typeObjectsToStore() {
		$this->assertEquals(CustomDataCollection::getClassnameOfTypeToStore(),"Paynova\\request\\model\\CustomData");
	}
}