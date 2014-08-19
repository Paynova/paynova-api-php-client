<?php
namespace Paynova\model;
/**
 * interface PropertyInterface
 * 
 *
 * @package Paynova/model
 * @copyright Paynova 2014
 */
interface ItemCollectionFactoryInterface {
	
	/**
	 *
	 * @throw InvalidArgumentException if values in $initArray !is_array OR if the the type of object to add to the
	 * collection does not implements PropertyInterface. Note that $initArray has to be an array of arrays,
	 * since it trying to create an collection of objects.
	 * @param $initArray has to be empty array or an array of arrays
	 * @return PropertyItemCollection object
	 * @see PropertyInterface::factory($initArray)
	 */
	public static function factory($initArray);
	
	/**
	 * Trying to factory from classes in $classes array
	 * @param string $classname
	 * @param array $initArray
	 * @return Object or null
	 */
	public static function factoryFromFirstBestClass($classes,$initArray);
	
	/**
	 * This method has to return what kind of type of object the collection stores
	 * @return string classname of object to store
	 */
	public static function getClassnameOfTypeToStore();
}