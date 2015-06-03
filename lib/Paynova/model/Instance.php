<?php
namespace Paynova\model;

use Paynova\exception\PaynovaException;
use Paynova\exception\PaynovaExceptionRequiredPropertyMissing;
use Paynova\util\Util;

use \InvalidArgumentException;
/**
 * class Intance acts as a baseclass for a majority of the model classes.
 * The subclasses will either be a part of the a request or response to the API SERVER
 * 
 *
 * @package Paynova/model
 * @copyright Paynova 2014
 */

abstract class Instance implements PropertyInterface{
	
	/**
	 * Will contain the actual properties key/value
	 * @access private
	 * @var array;
	 */
	private $_properties = array();
	
	/**
	 * Will contain an array of existing properties 
	 * @access private
	 * @var array;
	 */
	private $_signature = array();
	
	/**
	 * Will contain an array of required properties
	 * @access private
	 * @var array;
	 */
	private $_required = array();
	
	/**
	 * Declares the properties an object of this class holds. 
	 * Sets the required properties, required means that certain properties
	 * in $signature have to be set when used in a API request/response
	 * @param array $signature
	 * @param array $required (optional) 
	 * @param array $defaultValues has to contain keys from $signature (optional)
	 */
	protected function __construct($signature, $required = array(), $defaultValues = array()) {
		$this->_signature = $signature;
		
		$this->_required = $required;
		
		$this->_declareProperties($signature);
		
		$this->_setDefaultValues($defaultValues);
	}
	
	/**
	 * Set default values on properties
	 * @param array $defaultValues has to contain keys from $this->_signature
	 */
	private function _setDefaultValues($defaultValues){
		if(!is_array($defaultValues) || empty($defaultValues)) return;
		foreach($defaultValues as $key=>$value){
			$this->__set($key, $value);
		}
	}
	/**
	 * Sets the properties that are required
	 * @param array $required
	 * @throws PaynovaException
	 */
	protected function setRequired($required) {
		if(!is_array($this->_signature)) {
			throw new PaynovaException('Signature is not set');
		}
		if(!is_array($required)) {
			throw new PaynovaException('$required has to be an array of strings or objects');
		}
		foreach($required as $req) {
			if(!in_array($req,$this->_signature) && !array_key_exists($req, $this->_signature)) {
				throw new PaynovaException("'$req' is not found in signature");
			}
		}
		$this->_required = $required;
	}
	
	/**
	 * @see PropertyInterface::validateRequired()
	 */
	public function validateRequired() {
		$properties = $this->getPropertiesAsArray();
		
		
		foreach($this->_required as $req) {
			if(!array_key_exists($req,$properties) || empty($properties[$req])) {
				throw new PaynovaExceptionRequiredPropertyMissing(
						"Required property '".$req."' is missing or empty in ".get_called_class()
				);
			}
			if(is_object($properties[$req])) {
				$properties[$req]->validateRequired();
			}
		}
	}
	
	/**
	 * magic function
	 * Used for setting the properties and also prevent that instance variables are added dynamically
	 * @param string $key
	 * @param mixed $value
	 * @throws InvalidArgumentException
	 */
	public function __set($key, $value) {
		if(!array_key_exists($key,$this->_properties)) {
			throw new InvalidArgumentException("'".$key."' no such property in ".get_called_class());
		}else if(is_object($this->_properties[$key]) && (!is_object($value) || get_class($this->_properties[$key])!=get_class($value))) {
			throw new InvalidArgumentException("'".$key."' has to object of class ".$this->_signature[$key]);
		}
		
		$this->_properties[$key] = $value;
	}
	/**
	 * magic function
	 * Used for getting the properties and also prevent dynamically instance variable
	 * @param string $key
	 * @param mixed $value
	 * @throws InvalidArgumentException
	 * @return mixed
	 */
	public function __get($key) {
		if(!array_key_exists($key,$this->_properties)) {
			throw new InvalidArgumentException("'".$key."' no such property in ".get_called_class());
		}
		return $this->_properties[$key];
	}
	/**
	 * magic function
	 * Check if a property exists
	 * @param string $key
	 */
	public function __isset($key) {
		return isset($this->_properties[$key]);
	}
	
	/**
	 * magic function
	 * Unset a property
	 * @param string $key
	 */
	public function __unset($key) {
		unset($this->_properties[$key]);
	}
	
	
	/**
	 * A multi function for setting or getting a proprety
	 * @throws InvalidArgumentException if the property does not exist
	 * @param string $key
	 * @param mixed $value will be null if the call is for setting a property
	 * @return mixed
	 */
	public function setOrGet($key, $value) {
		if($value == null) return $this->__get($key);
		else {
			$this->__set($key,$value);
			return is_object($value)? $value: $this;
		}
	}
	
	/**
	 * Declare and initialize all the self::_properties $this with $signature.
	 * @param array $signature
	 */
	private function _declareProperties($signature) {
		foreach($signature as $key=>$value) {
			if(is_int($key)) {
				$this->_properties[$value]="";
			}else if(is_array($value)) {
				$this->_properties[$key] = array();
			}else if(class_exists($value)) {
				$this->_properties[$key] = new $value();
			}
		}
	}
	
	/**
	 * @see PropertyInterface::factory($initArray)
	 */
	public static function factory($initArray) {
		$class = get_called_class();
		if(Util::classIsAbstract($class)) {
			throw new InvalidArgumentException("Can't instantiate abstract class '$class'");
		}
		$obj = new $class();
		$signature = $obj->getSignature();
		
		foreach($initArray as $key=>$value) {
			/*
			 * Not need to initialize a property whose value is empty()
			 * - except 
			 * - - boolean (false is considered empty)
			 * - - double (0.0 is considered empty)
			 * - - integer (0 is considered empty)
			 */
			if((empty($value)) && !in_array(gettype($value),array("boolean","double","integer"))) {
				continue;
			}
			
			if(is_int($key)){
				throw new InvalidArgumentException("array sent to '".$class.":factory(array) has to be an associative'");
			}else if(
				!array_key_exists($key,$signature) && (!in_array($key,$signature) || is_array($value))
			){
				throw new InvalidArgumentException("'$key' is not a property in '$class'");
			} else if(is_array($value) && is_array($signature[$key])) {
			
			} else if(
					!(is_array($value) && is_array($signature[$key]))//If the signature is key=>array()
					&&
					(is_array($value) && class_exists($signature[$key]))
			) {
				
				$classes = array_merge(array($signature[$key]),Util::getSubclasses($signature[$key]));
				$o = self::factoryFromFirstBestClass($classes,$value);
				
				if($o == null) {
					throw new InvalidArgumentException(
							"Trying to factory ".implode(", ",$classes)." ".
							"but signature did not match supplied array"
							
					);
				}
				$value = $o;
			}
			
			call_user_func_array(array($obj,"__set"), array($key,$value));
		}
		$obj->validateRequired();
		
		return $obj;
	}
	
	/**
	 * Trying to factory from classes in $classes array
	 * @param string $classname
	 * @param array $initArray
	 * @return Object or null
	 */
	private static function factoryFromFirstBestClass($classes,$initArray) {
		foreach($classes as $c) {
			if($c::canFactory($initArray)) {
				return $c::factory($initArray);
			}
		}
		return null;
	}
	
	/**
	 * Checks if $initArray can be used to factory an object
	 * @param $initArray
	 * return boolean
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
	 * @see PropertyInterface::getPropertiesAsArray($omitEmpty = true)
	 */
	public function getPropertiesAsArray($omitEmpty = true) {
		$arr = array();
		foreach($this->_properties as $key => $value) {
			if(is_object($value)) {
				if(!$value->isEmpty() || !$omitEmpty) $value=$value->getPropertiesAsArray($omitEmpty);
				else $value = "";
			}
			
			if(!empty($value) || (is_bool($value) && !empty($key)) || !$omitEmpty){
				$arr[$key] = $value;
			}
			
		}
		return $arr;
	}
	
	/**
	 * @see PropertyInterface::getPropertiesAsJson($omitEmpty = true)
	 */
	public function getPropertiesAsJson($omitEmpty = true) {
		return json_encode($this->getPropertiesAsArray($omitEmpty));
	}
	
	/**
	 * Returns what properties that exists in this Instance
	 * @return array;
	 */
	public function getSignature(){
		return $this->_signature;
	}
	
	/**
	 * @see PropertyInterface::isEmpty()
	 */
	public function isEmpty() {
		
		foreach($this->_properties as $key => $value) {
			if(is_object($value)) $empty = $value->isEmpty();
			else $empty = empty($value);
			if(!$empty) return false;
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
		foreach($this->_properties as $key => $value) {
			$arr[]=$key."=".$value;
		}
		
		return get_called_class()."[\n".implode(",", $arr)."\n]";
	}
	
	/**
	 * Returns an array of the required properties in this instance
	 * @return array of required properties
	 */
	public function getRequiredAsArray() {
		return $this->_required;
	}
	
	/**
	 * Prints the required properties
	 * @return string representation of the required properties
	 */
	public function printRequired() {
		echo var_dump($this->_required,true);
	}
}