<?php
require_once __DIR__."/../../../TestHelper.php";

use Paynova\request\model\ProfilePaymentOptions;

class ProfilePaymentOptionsTest extends PHPUnit_Framework_TestCase {
	
	public function test_propertiesAgainstSignature(){
		$object = new ProfilePaymentOptions();
		TestHelper::assert_modelSignature($this,$object);
	}
	
	
	public function test_factory() {
		$obj = ProfilePaymentOptions::factory(array(
				"profileId"=>"foo",
				"profileCard"=>array(
						"cardId"=>"123456789",
						"cvc"=>"123"
				),
				"displaySaveProfileCardOption"=>true
		));
	}
}