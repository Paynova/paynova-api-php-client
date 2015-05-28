<?php
require_once __DIR__."/../../../TestHelper.php";

use Paynova\request\model\Ticket;

class TicketTest extends PHPUnit_Framework_TestCase {
	
	public function test_propertiesAgainstSignature(){
		$object = new Ticket();
		TestHelper::assert_modelSignature($this,$object);
	}
	
	public function test_factory(){
		$o1 = Ticket::factory(array(
				"serviceId"=>"foo",
				"ticketNumber"=>"foo",
				"isRefundable"=>true,
				"isRebookable"=>true,
				"passenger"=>array(
					"name"=>array(
						"firstName"=>"foo",
						"lastName"=>"foo"
					),
					"telephone"=>"1234567",
					"emailAddress"=>"foo@foo.com"
				)
		));
		$o2 = new Ticket();
		$o2->serviceId("foo")->ticketNumber("foo")->isRefundable(true)->isRebookable(true);
		$o2->passenger()->name()->firstName("foo")->lastName("foo");
		$o2->passenger()->telephone("1234567")->emailAddress("foo@foo.com");
		$this->assertEquals($o1,$o2);
	}
}