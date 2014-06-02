<?php
require_once __DIR__."/../../../TestHelper.php";
class TicketCollectionTest extends PHPUnit_Framework_TestCase {

	public function test_construct(){
		$this->assertInstanceOf("TicketCollection",new TicketCollection());
		
	}
	
	
	public function test_typeObjectsToStore() {
		$this->assertEquals(TicketCollection::getClassnameOfTypeToStore(),"Ticket");
	}
}