<?php
require_once __DIR__."/../../../TestHelper.php";
class ProfilePaymentOptionsTest extends PHPUnit_Framework_TestCase {
	
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