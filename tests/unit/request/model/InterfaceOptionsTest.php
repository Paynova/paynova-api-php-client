<?php
require_once __DIR__."/../../../TestHelper.php";

use Paynova\request\model\InterfaceOptions;

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
		
		$this->assertInstanceOf("Paynova\\request\\model\\InterfaceOptions",$obj);
	}
	
	public function test_propertiesAgainstSignature(){
		$object = new InterfaceOptions();
		TestHelper::assert_modelSignature($this,$object);
	}
	
}