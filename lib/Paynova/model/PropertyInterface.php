<?php
/**
 * interface PropertyInterface
 * 
 * Known implementing classes model/Instance, model/PropertyItemCollection
 *
 * @package Paynova/http
 * @copyright Paynova 2014
 */
interface PropertyInterface {
	
	/**
	 * Returns an array with all the properties.
	 * If a property is an object (implements PropertyInterface) then the object properties
	 * will be returned as well.
	 * @param boolean $omitEmpty if true then only non-empty properties/object-properties will
	 * be included in the json-string. If false the all the properties(and objects-properties) will be returned
	 * @return array
	 */
	public function getPropertiesAsArray($omitEmpty = true);
	
	/**
	 * Returns a string containing the JSON representation of the properties in this instance
	 * If a property is an object (and implementes PropertyInterface) then the object properties
	 * will be returned as well.
	 *
	 * @param boolean $omitEmpty if true then only non-empty properties/object-properties will
	 * be included in the json-string. If false the all the properties(and objects-properties) will be returned
	 * @return string
	 */
	public function getPropertiesAsJson($omitEmpty = true);
	
	/**
	 * Returns true if all properties and property-object-properties are empty
	 * false otherwise
	 * @return boolean
	 */
	public function isEmpty();
	
	/**
	 * A validation function for validating if the required properties exists in the current instance
	 * @throws PaynovaExceptionRequiredPropertyMissing
	 */
	public function validateRequired();
	
	/**
	 * Return a string representation of the properties in this instance
	 * @return string
	 */
	public function __toString();
	
	/**
	 * Factory method that returns an object that inherits Instance
	 * $initArray will initialize the properties of the current object
	 * Can throw InvalidArgumentException if $initArray contains
	 * unknown/erroneous key/value
	 * @param array $initArray initialize the properties of the current class
	 * @return PropertyInterface
	 */
	public static function factory($initArray);
	
	/**
	 * Checks if $initArray can be used to factory
	 * @param $initArray
	 * return boolean
	 */
	public static function canFactory($initArray);
}