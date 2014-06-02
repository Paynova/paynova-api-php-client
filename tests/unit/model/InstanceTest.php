<?php
require_once __DIR__."/../../TestHelper.php";
class FooInstance extends Instance {
	
	public function __construct($signature) {
		parent::__construct($signature);
	}
}
class InstanceTest extends PHPUnit_Framework_TestCase {
	
	/*
	 * public function getPropertiesAsArray($omitEmpty = true);
	
	public function getPropertiesAsJson();
	
	public function isEmpty();
	
	public function __toString();
	 */
	
	public function testConstructor() {
		new FooInstance(array("property1","property2"));
	}
	
	public function testGetPropertiesAsArray() {
		$foo = new FooInstance(array("property1","property2"));
		$this->assertTrue(count($foo->getPropertiesAsArray($omitEmpty = false))==2);
		$this->assertTrue(count($foo->getPropertiesAsArray($omitEmpty = true))==0);
	}
}