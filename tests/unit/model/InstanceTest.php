<?php
require_once __DIR__."/../../TestHelper.php";
use Paynova\model\Instance;
class FooInstance extends Instance {
	
	public function __construct($signature) {
		parent::__construct($signature);
	}
}
class InstanceTest extends PHPUnit_Framework_TestCase {
	
	public function testGetPropertiesAsArray() {
		$foo = new FooInstance(array("property1","property2"));
		$this->assertTrue(count($foo->getPropertiesAsArray($omitEmpty = false))==2);
		$this->assertTrue(count($foo->getPropertiesAsArray($omitEmpty = true))==0);
	}
}