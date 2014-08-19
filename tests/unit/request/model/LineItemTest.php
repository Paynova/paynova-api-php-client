<?php
require_once __DIR__."/../../../TestHelper.php";

use Paynova\request\model\LineItem;
use Paynova\request\model\Address;

class LineItemTest extends PHPUnit_Framework_TestCase {
	
	public function test_constants() {
		$this->assertEquals(LineItem::GROUP_KEY_DISCOUNT_,	"_DISCOUNT_");
		$this->assertEquals(LineItem::GROUP_KEY_EXTRA_,		"_EXTRA_");
		$this->assertEquals(LineItem::GROUP_KEY_ITEM_,		"_ITEM_");
		$this->assertEquals(LineItem::GROUP_KEY_SHIPPING_,	"_SHIPPING_");
		$this->assertEquals(LineItem::GROUP_KEY_TAX_,		"_TAX_");
	}
	
	/**
	 * Asserts that all property-method are declared (and working). Check this against the signature
	 */
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
		$obj = LineItem::factory(array(
				"id"=>"foo",
				"articleNumber"=>"foo",
				"name"=>"foo",
				"description"=>"Foo"
		));
		$this->assertEquals($obj->id(),"foo");
		$this->assertEquals($obj->articleNumber(),"foo");
		$this->assertEquals($obj->name(),"foo");
		$this->assertEquals($obj->description(),"Foo");
	}
}