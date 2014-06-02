<?php
require_once __DIR__."/../../../TestHelper.php";
class ProfileCardTest extends PHPUnit_Framework_TestCase {
	
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
		$obj = ProfileCard::factory(array(
				"cardId"=>"1234567890",
				"cvc"=>"123"
		));
		
		$this->assertInstanceOf("ProfileCard",$obj);
		$this->assertEquals($obj->cardId(),"1234567890");
		$this->assertEquals($obj->cvc(),"123");
	}
}