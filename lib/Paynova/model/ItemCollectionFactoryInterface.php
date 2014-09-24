<?php
namespace Paynova\model;
/**
 * interface PropertyInterface
 * 
 *
 * @package Paynova/model
 * @copyright Paynova 2014
 */
interface ItemCollectionInterface {
	
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