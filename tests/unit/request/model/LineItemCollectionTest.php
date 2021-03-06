<?php
require_once __DIR__."/../../../TestHelper.php";

use Paynova\request\model\LineItemCollection;
use Paynova\request\model\LineItem;

class LineItemCollectionTest extends PHPUnit_Framework_TestCase {

	public function test_Construct(){
		new LineItemCollection();		
	}
	
	public function test_typeObjectsToStore() {
		$this->assertEquals(LineItemCollection::getClassnameOfTypeToStore(),"Paynova\\request\\model\\LineItem");
	}
	
	public function test_getPropertiesAsArray() {
		$items = new LineItemCollection();
		$item1 = new LineItem();
		$item1->id("1334");
		
		$items->push($item1)->push(new LineItem());
		$arr = $items->getPropertiesAsArray($omitEmpty = true);
		
	}
	
	
}