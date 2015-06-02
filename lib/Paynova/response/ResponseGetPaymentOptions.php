<?php
namespace Paynova\response;
/**
 *
 * service: 	CreateOrder
 * type: 		response
 *
 * An object of this class will be created by RequestGetAddresses from the API REST call response
 * Hold only read-properties
 *
 * @package Paynova/request
 * @copyright Paynova 2015
 *
 */
class ResponseGetPaymentOptions extends Response {

	/**
	 * @see response/Response::__construct()
	 */
	public function __construct() {
		parent::__construct(array(
			"availablePaymentMethods"=>"Paynova\\response\\model\\PaymentMethodDetailCollection"
				
		));
	}

	/**
	 * availablePaymentMethods getter
	 * The the collection of available payment options
	 * @return PaymentMethodDetailCollection
	 */
	public function availablePaymentMethods() {  return $this->setOrGet(__FUNCTION__,null); }
	
}