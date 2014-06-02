<?php
/**
 * class CustomDataCollection can store a collection of CustomData objects
 * part of service: 	Annul Authorization, Initialize Payment
 *
 * @package Paynova/model/request
 * @copyright Paynova 2014
 */
class CustomDataCollection extends PropertyItemCollection{
	
	/**
	 * @see util/PaynovaCollection::__construct()
	 */
	public function __construct() {
		parent::__construct(self::getClassnameOfTypeToStore());
	}
	
	/**
	 * @see model/PropertyItemCollection::getClassnameOfTypeToStore()
	 * @return string
	 */
	public static function getClassnameOfTypeToStore() {
		return "CustomData";
	}
}