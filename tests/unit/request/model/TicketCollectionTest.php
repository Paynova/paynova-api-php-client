<?php
require_once __DIR__."/../../../TestHelper.php";

use Paynova\request\model\TicketCollection;


class TicketCollectionTest extends PHPUnit_Framework_TestCase {

	public function test_construct(){
		$this->assertInstanceOf("Paynova\\request\\model\\TicketCollection",new TicketCollection());
		
	}
	
	
	public function test_typeObjectsToStore() {
		$this->assertEquals(TicketCollection::getClassnameOfTypeToStore(),"Paynova\\request\\model\\Ticket");
	}
}