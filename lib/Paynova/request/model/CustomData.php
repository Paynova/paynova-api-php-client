<?php
/**
 * class CustomData
 * part of service: 	Annul Authorization, Initialize Payment
 *
 * Enable a way to send custom data with above API service calls. 
 *
 * @package Paynova/request/model
 * @copyright Paynova 2014
 *
 */
class CustomData extends Instance {
	
	/**
	 * @see model/Instance::__construct()
	 */
	public function __construct() {
		parent::__construct(array(
			"key","value"
		));
	}
	
	/**
	 * key setter/getter
	 * The key identifying the value pair.
	 * @param string $value (optional) used when setting
	 * @return CustomData or string key
	 */
	public function key($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * value setter/getter
	 * The value of this key-value pair
	 * @param string $value (optional) used when setting
	 * @return PaymentMethod or string value
	 */
	public function value($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * Insert the the key-value pair
	 * @param string $value (optional) used when setting
	 */
	public function setKeyValue($key,$value) { 
		$this->setOrGet("key",	$key);
		$this->setOrGet("value",$value);
	}
	
	
}