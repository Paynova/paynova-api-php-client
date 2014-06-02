<?php
/**
 * class LineItemCollection can store a collection of LineItem objects
 * part of service: 	Create Order, Initialize Payment, Finalize Authorization, 
 *						Annul Authorization, Refund Payment 
 *
 * @package Paynova/model/request
 * @copyright Paynova 2014
 */
class LineItemCollection extends PropertyItemCollection{
	
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
		return "LineItem";
	}
}