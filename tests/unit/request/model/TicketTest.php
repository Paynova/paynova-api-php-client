<?php
require_once __DIR__."/../../../TestHelper.php";

use Paynova\request\model\Ticket;
use Paynova\request\model\Address;

class TicketTest extends PHPUnit_Framework_TestCase {
	
	public function test_propertiesAgainstSignature(){
		$object = new Address();
		$signature = $object->getSignature();
		foreach($signature as $key=>$value) {
			$method = $value;
			$param = "";
		
			if(!is_int($key) && class_exists($value)) {
				$method=$key;
				$param = new $value();
			}else {
				$param = "foo";
			}
			call_user_func_array(array($object,$method),array($param));
			$this->assertEquals(call_user_func_array(array($object,$method),array()),$param);
		}
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