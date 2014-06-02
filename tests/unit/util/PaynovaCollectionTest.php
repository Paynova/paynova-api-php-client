<?php
require_once __DIR__."/../../TestHelper.php";

class Foo {
	public $var1;
	public $var2;
	
	public function __construct($v1 = "var1", $v2 = "var2") {
		$this->var1 = $v1;
		$this->var2 = $v2;
	}
}

class Fii {
	
}
class PaynovaCollectionTest extends PHPUnit_Framework_TestCase {
	
	/**
	 *  @expectedException InvalidArgumentException
	 */
	public function testWrongTypeOfObjects() {
		$coll = new PaynovaCollection($typeOfObjects = "Foo");
		
		$coll->push(new Fii());
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testOffsetSet() {
		$coll = new PaynovaCollection("");
		$foo = new Foo();
		$coll->offsetSet(100,$foo);
		$coll[] = new Foo();
		$coll->offsetSet(1,"foo");
	}
	
	/**
	 * 
	 */
	public function testOffsetExists() {
		$coll = new PaynovaCollection();
		$this->assertFalse($coll->offsetExists(100));
		$foo = new Foo();
		$coll->offsetSet(100, $foo);
		$this->assertTrue($coll->offsetExists(100));
		
		return $coll;
	}
	/**
	 * @depends testOffsetExists
	 */
	public function testOffsetUnset(PaynovaCollection $coll) {
		$this->assertTrue($coll->offsetExists(100));
		$coll->offsetUnset(100);
		$this->assertFalse($coll->offsetExists(100));
	}
	
	/**
	 * 
	 */
	public function testOffsetGet() {
		$coll = new PaynovaCollection();
		$foo = new Foo();
		$coll->offsetSet(100, $foo);
		$f = $coll->offsetGet(100);
		$this->assertTrue($foo === $f);
	}
	
	/**
	 * 
	 */
	public function testContains() {
		$coll = new PaynovaCollection();
		$foo = new Foo();
		$coll->offsetSet(100, $foo);
		$this->assertTrue($coll->contains($foo));
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testPut() {
		$coll = new PaynovaCollection();
		$foo = new Foo();
		$coll->put(100,$foo);
		$this->assertTrue($coll->contains($foo));
		$this->assertTrue($coll->offsetGet(100)===$foo);
		
		$coll->put(200,"Foo");
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testPush() {
		$coll = new PaynovaCollection();
		$foo1 = new Foo();
		$foo1->var1 = "foo";
		$coll->push($foo1);
		
		$foo2 = new Foo();
		$coll->push($foo2);
		$this->assertTrue($coll->contains($foo2));
		$offset = $coll->size()-1;
		$this->assertTrue($coll->offsetGet($offset)==$foo2);
		
		$coll->push(new Foo())->push(new Foo());
		$coll->push("Foo");
	}
	
	/**
	 * 
	 */
	public function testGetObjectsAsArray() {
		$coll = new PaynovaCollection();
		$this->assertTrue(count($coll->getObjectsAsArray())==0);
		$coll->push(new Foo("f1v1","f1v2"))->push(new Foo("f2v1","f2v2"));
		$this->assertTrue(count($coll->getObjectsAsArray())==2);
		
		$arr = $coll->getObjectsAsArray();
		$this->assertTrue(is_array($arr));
		
		foreach($arr as $object) {
			$this->assertTrue(is_object($object));
		}
	} 
	
	public function testGetIterator(){
		$coll = new PaynovaCollection();
		$this->assertTrue($coll->getIterator()->size()==0);
		$foo = new Foo();
		$coll->push(new Foo("1","2"))->push($foo);
		$this->assertTrue($coll->getIterator()->size()==2);
		
		foreach($coll->getIterator() as $object) {
			$this->assertTrue(is_object($object));
		}
	}
}

