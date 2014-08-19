<?php
namespace Paynova\request\model;

use Paynova\model\PropertyItemCollection;

/**
 * class PaymentMethodCollection can store a collection of PaymentMethod objects
 * part of service: 	Initialize Payment 
 *						 
 *
 * @package Paynova/model/request
 * @copyright Paynova 2014
 */
class PaymentMethodCollection extends PropertyItemCollection{
	
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
		return "Paynova\\request\\model\\PaymentMethod";
	}
}