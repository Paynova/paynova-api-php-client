<?php
require_once __DIR__."/../../../TestHelper.php";

use Paynova\response\model\Error;

class ErrorTest extends PHPUnit_Framework_TestCase {
	
	
	public function test_factory(){
		$error = Error::factory(array(
			"errorCode"=>"Length",
            "fieldName"=>"CurrencyCode",
            "message"=>"'Currency Code' must be 3 characters in length. You entered 4 characters."
				
		));
		$this->assertInstanceOf("Paynova\\response\\model\\Error",$error);
		
	}
}