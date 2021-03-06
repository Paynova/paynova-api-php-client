<?php
require_once __DIR__."/../../../TestHelper.php";

use Paynova\response\model\ProfileCardDetails;

class ProfileCardDetailsTest extends PHPUnit_Framework_TestCase {
	
	
	public function test_factory(){
		$profile = ProfileCardDetails::factory(array(
			"cardId"=>"123", 
			"expirationYear"=>2015, 
			"expirationMonth"=>"01",
			"firstSix"=>1123456,
			"lastFour"=>7890
				
		));
		$this->assertInstanceOf("Paynova\\response\\model\\ProfileCardDetails",$profile);
		
	}
}