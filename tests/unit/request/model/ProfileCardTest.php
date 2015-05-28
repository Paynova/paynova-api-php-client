<?php
require_once __DIR__."/../../../TestHelper.php";

use Paynova\request\model\ProfileCard;

class ProfileCardTest extends PHPUnit_Framework_TestCase {
	
	public function test_propertiesAgainstSignature(){
		$object = new ProfileCard();
		TestHelper::assert_modelSignature($this,$object);
	}
	
	
	public function test_factory() {
		$obj = ProfileCard::factory(array(
				"cardId"=>"1234567890",
				"cvc"=>"123"
		));
		
		$this->assertInstanceOf("Paynova\\request\\model\\ProfileCard",$obj);
		$this->assertEquals($obj->cardId(),"1234567890");
		$this->assertEquals($obj->cvc(),"123");
	}
}