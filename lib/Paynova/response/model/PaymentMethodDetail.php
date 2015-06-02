<?php
namespace Paynova\response\model;

use Paynova\model\Instance;

/**
 * class PaymentMethodDetail
 * Will hold information about a payment that is possible for a merchant to offer their customers
 *
 *
 * @package Paynova/response/model
 * @copyright Paynova 2015
 *
 */
class PaymentMethodDetail extends Instance {
	
	public function __construct($http = null) {
		parent::__construct(array(
				"paymentMethodId",
				"paymentMethodProductId",
				"displayName",
				"group"				=> "Paynova\\response\\model\\KeyedDisplayName",
				"interestRate"		=> "Paynova\\response\\model\\LabelSymbolValue",
				"notificationFee"	=> "Paynova\\response\\model\\LabelSymbolValue",
				"setupFee"			=> "Paynova\\response\\model\\LabelSymbolValue",
				"numberOfInstallments",
				"installmentPeriod",
				"installmentUnit",
				"legalDocuments"	=> "Paynova\\response\\model\\LinkCollection",
				"addressTypeRestrictions" => array()
				
		));
	}
	
	/**
	 * paymentMethodId getter
	 * @return return paymentMethodId
	 */
	public function paymentMethodId() { return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * paymentMethodProductId getter
	 * @return return paymentMethodProductId
	 */
	public function paymentMethodProductId() { return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * displayName getter
	 * @return return displayName
	 */
	public function displayName() { return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * group getter
	 * @return return LabelSymbolValue
	 */
	public function group() { return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * notificationFee getter
	 * @return return LabelSymbolValue
	 */
	public function notificationFee() { return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * setupFee getter
	 * @return return LabelSymbolValue
	 */
	public function setupFee() { return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * numberOfInstallments getter
	 * @return return numberOfInstallments
	 */
	public function numberOfInstallments() { return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * installmentPeriod getter
	 * @return return installmentPeriod
	 */
	public function installmentPeriod() { return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * installmentUnit getter
	 * @return return installmentUnit
	 */
	public function installmentUnit() { return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * legalDocuments getter
	 * @return return LinkCollection
	 */
	public function legalDocuments() { return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * addressTypeRestrictions getter (array)
	 * @return return addressTypeRestrictions (array)
	 */
	public function addressTypeRestrictions() { return $this->setOrGet(__FUNCTION__,null); }
}