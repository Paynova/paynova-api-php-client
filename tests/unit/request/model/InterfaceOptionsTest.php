<?php
require_once __DIR__."/../../../TestHelper.php";
class InterfaceOptionsTest extends PHPUnit_Framework_TestCase {
	
	
	
	public function test_factory() {
		$obj = InterfaceOptions::factory(array(
				"interfaceId"=>"5",
				"displayLineItems"=>true,
				"themeName"=>"foo",
				"layoutName"=>"Paynova_FullPage_1",
				"customerLanguageCode"=>"swe",
				"urlRedirectSuccess"=>"http://www.foo.com",
				"urlRedirectCancel"=>"http://www.foo.com",
				"urlRedirectPending"=>"http://www.foo.com",
				"urlCallback"=>"http://www.foo.com",
		));
		
		$this->assertInstanceOf("InterfaceOptions",$obj);
	}
	
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
	
}