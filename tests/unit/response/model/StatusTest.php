<?php
require_once __DIR__."/../../../TestHelper.php";

use Paynova\response\model\Status;

class StatusTest extends PHPUnit_Framework_TestCase {
	
	
	public function test_factory(){
		$arr = array(
			"isSuccess"=>1,
			"errorNumber"=>-1,
			"statusKey"=>"SUCCESS",
			"statusMessage"=>"The operation was successful.",
			"errors"=>array(),
			"exceptionDetails"=>""
				
		);
		$status = Status::factory($arr);
		$this->assertInstanceOf("Paynova\\response\\model\\Status",$status);
		
	}
}