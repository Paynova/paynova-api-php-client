<?php
/**
 * class ProfileCardDetailsCollection can store a collection of ProfileCardDetails objects
 * part of service: 	Get Customer Profile
 *
 * @package Paynova/model/response
 * @copyright Paynova 2014
 */
/**
 * class ProfileCardDetailsCollection can store a collection of ProfileCardDetails
 * 
 *
 * @package Paynova/response
 * @copyright Paynova 2014
 */
class ProfileCardDetailsCollection extends PropertyItemCollection{

	/**
	 * @see util/PaynovaCollection::__construct()
	 */
	public function __construct() {
		parent::__construct(self::getClassnameOfTypeToStore());
	}
	
	/**
	 * Returns the type of object that this collection class can store
	 * @return string classname
	 */
	public static function getClassnameOfTypeToStore() {
		return "ProfileCardDetails";
	}
}