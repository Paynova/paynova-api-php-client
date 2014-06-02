<?php
/**
 * class PaynovaIterator
 * Is an Iterator object that contains functionality to loop over an array of objects
 *
 *
 * @package Paynova/util
 * @copyright Paynova 2014
 *
 */
class PaynovaIterator implements Iterator
{
	/*
	 * @var array
	 */
	private $_objects;
	
	/**
	 * Sets the internal array of objects an sets the type of objects that the $objects contains
	 * @param array $objects
	 * @param string $typeOfObjects
	 */
	public function __construct($objects, $typeOfObjects = "") {
		Util::validateArrayOfObjects($objects,$typeOfObjects,__FUNCTION__,get_class($this));
		$this->_objects = $objects;
		$this->position = 0;
	}
	
	/**
	 * @see Iterator::rewind()
	 */
	function rewind() {
		$this->position = 0;
	}
	
	/**
	 * @see Iterator::current()
	 */
	function current() {
		return $this->_objects[$this->position];
	}
	
	/**
	 * @see Iterator::key()
	 */
	function key() {
		return $this->position;
	}
	
	/**
	 * @see Iterator::next()
	 */
	function next() {
		++$this->position;
	}
	
	/**
	 * @see Iterator::valid()
	 */
	function valid() {
		return isset($this->_objects[$this->position]);
	}
	
	/**
	 * Returns the amount of objects
	 * @return int
	 */
	public function size() {
		if(!is_array($this->_objects)) return 0;
		
		return count($this->_objects);
	}
}