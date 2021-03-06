<?php
namespace Paynova\response\model;

use Paynova\model\PropertyItemCollection;

/**
 * class ErrorCollection can store a collection of Error objects
 * part of service: 	All services that returns errors
 *
 * @package Paynova/model/response
 * @copyright Paynova 2014
 */
class NameAddressCollection extends PropertyItemCollection {
	
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
		return "Paynova\\model\\NameAddress";
	}
	
}