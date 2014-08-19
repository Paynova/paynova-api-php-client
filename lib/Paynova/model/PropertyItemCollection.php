<?php
namespace Paynova\model;

use \InvalidArgumentException;

use Paynova\util\PaynovaCollection;
use Paynova\util\Util;

/**
 * class PropertyItemCollection can store objects that implements the PropertyInterface
 *
 * @package Paynova/http
 * @copyright Paynova 2014
 */
abstract class PropertyItemCollection extends PaynovaCollection implements PropertyInterface, ItemCollectionFactoryInterface {
	
	/**
	 * @see util/PaynovaCollection::__construct()
	 */
	public function __construct($typeOfObjects) {
		parent::__construct($typeOfObjects);
	}
	/**
	 * @see PropertyInterface::getPropertiesAsArray($omitEmpty = true)
	 */
	public function getPropertiesAsArray($omitEmpty = true) {
		$arr = array();
		$objects = $this->getObjectsAsArray();
		foreach($objects as $key=>$object) {
			if(!$object->isEmpty() || !$omitEmpty){
				$arr[$key] =$object->getPropertiesAsArray($omitEmpty);
			}
		}
		return $arr;
	}
	
	/**
	 * @see PropertyInterface::validateRequired()
	 */
	public function validateRequired() {
		foreach($objects as $key=>$object) {
			$object->validateRequired();
		}
	}
	
	/**
	 * @see PropertyInterface::getPropertiesAsJson()
	 */
	public function getPropertiesAsJson($omitEmpty = true) {
		return json_encode($this->getPropertiesAsArray());
	}
	
	/**
	 * @see PropertyInterface::isEmpty()
	 */
	public function isEmpty() {
		$iterator = $this->getIterator();
		foreach($iterator as $object) {
			if(!$object->isEmpty()) return false;
		}
		return true;
	}
	
	/**
	 * 
	 * @throw InvalidArgumentException if values in $initArray !is_array OR if the the type of object to add to the 
	 * collection does not implements PropertyInterface. Note that $initArray has to be an array of arrays,
	 * since it trying to create an collection of objects.
	 * @param $initArray has to be empty array or an array of arrays
	 * @return PropertyItemCollection object
	 * @see PropertyInterface::factory($initArray)
	 */
	public static function factory($initArray) {
		$class = get_called_class();
		if(Util::classIsAbstract($class)) {
			throw new InvalidArgumentException("Can't instantiate abstract class '$class'");
		}
		$object = new $class();
		foreach($initArray as $item) {
			$classToStore = $class::getClassnameOfTypeToStore();
			if(!is_array($item)) {
				throw new InvalidArgumentException("Trying to create a ".$class." and adding ".$item." but it's not an array");
			}else if(!in_array("Paynova\\model\\PropertyInterface",class_implements($classToStore))) {
				throw new InvalidArgumentException(
						"'".$classToStore."' does not implement the interface PropertyInterface and ".
						"therefore not be added to '".$class."'"
				);
			}
			
			$cls = array_merge(array($classToStore),Util::getSubclasses($classToStore));
			$obj = self::factoryFromFirstBestClass($cls, $item);
			if($obj == null) {
				throw new InvalidArgumentException(
						"Trying to factory to ".implode(", ",$cls)." but signature didn't matched supplied array"
				);
			}
			
			$object->push($obj);
			
			
			//$item = $classToStore::factory($item);
			//$object->push($item);
		}
		return $object;
	}
	
	/**
	* Trying to factory from classes in $classes array
	 * @param string $classname
	 * @param array $initArray
	 * @return Object or null  
	 */
	public static function factoryFromFirstBestClass($classes,$initArray) {
	foreach($classes as $c) {
			if($c::canFactory($initArray)) {
				return $c::factory($initArray);
			}
		}
		return null;
	}
	/**
	 * @see PropertyInterface::canFactory($initArray)
	 */
	public static function canFactory($initArray) {
		try{
			self::factory($initArray);
		}catch (InvalidArgumentException $e){
			return false;
		}
		return true;
	}
	
	/**
	 * @see PropertyInterface::__toString()
	 */
	public function __toString() {
		if($this->isEmpty())return "";
		$str = "\n	";
		$arr = array();
		
		$objects = $this->getObjectsAsArray();
		foreach($objects as $key=>$object) {
			$arr[]=$key."=".$object;
		}
		
		return get_called_class()."[\n".implode(",", $arr)."\n]";
	}
}