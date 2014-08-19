<?php
namespace Paynova\util;

use \ArrayAccess;

/**
 * class PaynovaCollection
 * Act as an Collection of objects of a certain type. It uses Util::validateObject()
 * to ensure that objects added to this collection is of the correct class(or subclass)
 * 
 * 
 * @package Paynova/util
 * @copyright Paynova 2014
 *
 */
class PaynovaCollection implements ArrayAccess {
	/**
	 * The internal array of object
	 * @var array $object
	 */
	private $_objects = array();
	
	/**
	 * Name of class that object in this Collection has to be object of
	 * @var string
	 */
	private $_typeOfObjects = "";
	
	/**
	 * If $typeOfObjects is not empty, it sets the type of objects this collection holds
	 * @param string $typeOfObjects
	 */
	public function __construct($typeOfObjects = "") {
		$this->_typeOfObjects = $typeOfObjects;
	}
	
	/**
	 * @see ArrayAccess::offsetSet()
	 */
	public function offsetSet($offset, $value) {
		$this->put($offset, $value);
	}
	
	/**
	 * @see ArrayAccess::offsetExists()
	 */
	public function offsetExists($offset) {
		return isset($this->_objects[$offset]);
	}
	
	/**
	 * @see ArrayAccess::offsetUnset()
	 */
	public function offsetUnset($offset) {
		unset($this->_objects[$offset]);
	}
	
	/**
	 * @see ArrayAccess::offsetGet()
	 */
	public function offsetGet($offset) {
		return isset($this->_objects[$offset]) ? $this->_objects[$offset] : null;
	}
	
	/**
	 * Puts an object onto this collection
	 * @param int $offset
	 * @param object $object
	 */
	public function put($offset, $object) {
		$this->validateObject($object);
		
		if (is_null($offset)) {
			$this->_objects[] = $object;
		} else {
			$this->_objects[$offset] = $object;
		}
	}
	
	/**
	 * Pushes $object onto the collection
	 * @param object $object
	 * @return PaynovaCollection
	 */
	public function push($object) {
		$this->validateObject($object); 
		$this->_objects[] = $object;
		return $this;
	}
	
	/**
	 * Chec if $object is in the collection
	 * @param object $object
	 * @return boolean
	 */
	public function contains($object) {
		$this->validateObject($object);
		foreach($this->_objects as $obj) {
			if($obj == $object) return true;
		}
		return false;
	}
	
	/**
	 * Remove the last(first in) object from the collection
	 */
	public function pop() {
		$cnt = count($this->_objects);
		if($cnt>0)$this->offsetUnset($cnt-1);
	}
	
	/**
	 * Remove the object $object if it exists in the collection
	 * @param object $object
	 */
	public function remove($object) {
		$this->validateObject($object);
		$offset = -1;
		for($i = 0; $i<count($this->_objects);$i++) {
			if($this->_objects[$i] == $object) {
				$offset = $i;
				break;
			}
		}
		if($ofset>=0)$this->offsetUnset($offset);
	}
	
	/**
	 * Returns an PaynovaIterator of the objects in this PaynovaCollection
	 * @return PaynovaIterator
	 */
	public function getIterator() {
		return new PaynovaIterator($this->_objects);
	}
	
	/**
	* Returns an array of all the objects in this collection
	* @return array
	*/
	public function getObjectsAsArray() {
		return $this->_objects;
	}
	public function size() {
		return count($this->_objects);
	}
	
	/**
	 * Validates that $object is of the some class as $this->_typeOfObjects
	 * @param unknown $object
	 */
	private function validateObject($object) {
		Util::validateObject($object,$this->_typeOfObjects);
	}
}