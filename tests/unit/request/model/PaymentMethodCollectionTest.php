<?php
require_once __DIR__."/../../../TestHelper.php";

use Paynova\request\model\PaymentMethodCollection;
use Paynova\request\model\PaymentMethod;
use Paynova\model\Name;

class PaymentMethodCollectionTest extends PHPUnit_Framework_TestCase {

	public function test_construct(){
		$this->assertInstanceOf("Paynova\\request\\model\\PaymentMethodCollection",new PaymentMethodCollection());
		
	}
	
	
	public function test_factoryVsPush() {
		$coll1 = new PaymentMethodCollection();
		$method = new PaymentMethod();
		$method->id(PaymentMethod::CARD_VISA);
		$coll1->push($method);
		
		$coll2 = PaymentMethodCollection::factory(array(
			array("id"=>PaymentMethod::CARD_VISA)
				
		));
		$this->assertTrue($coll1 == $coll2);
		$this->assertEquals($coll1->getPropertiesAsArray(),$coll2->getPropertiesAsArray());
		
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_failWhenInsertBadTypeInCollection() {
		$coll1 = new PaymentMethodCollection();
		$coll1->push(new Name());
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_failWhenFactoryInputIsBad() {
		$coll1 = new PaymentMethodCollection();
		$coll1->push(array(
			"foo"=>"fii"	
		));
	}
	
	public function test_typeObjectsToStore() {
		$this->assertEquals(PaymentMethodCollection::getClassnameOfTypeToStore(),"Paynova\\request\\model\\PaymentMethod");
	}
}