<?php
namespace Paynova\response\model;

use Paynova\model\PropertyItemCollection;

/**
 * class PaymentMethodDetailCollection can hold a collection of PaymentMethodDetail
 * Will be part of the response to GetPaymentOptions
 *
 * @package Paynova/response/model
 * @copyright Paynova 2015
 */


class PaymentMethodDetailCollection extends PropertyItemCollection {
	
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
		return "Paynova\\response\\model\\PaymentMethodDetail";
	}
	
}