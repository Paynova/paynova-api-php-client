<?php
namespace Paynova\response;
/**
 *
 * service: 	AuthorizePayment
 * type: 		response
 *
 * An object of this class will be created by RequestAuthorizePayment from the API REST call response
 * Hold only read-properties
 *
 * @package Paynova/request
 * @copyright Paynova 2015
 *
 */
class ResponseAuthorizePayment extends Response {
	
	/**
	 * @see response/Response::__construct()
	 */
	public function __construct() {
		parent::__construct(array(
			"orderId","transactionId","acquirerId","acquirerReferenceId"
		));
	}
	
	/**
	 * orderId getter
	 * If the request was successful and you received an HTTP 201 "Created" response, this field will contain 
	 * the order id (GUID) which you can use in subsequent calls to the order API and for initializing 
	 * payments.
	 * @return string orderId
	 */
	public function orderId() {  return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * transactionId getter
	 * Paynova's transaction id for the authorization
	 * @return string transactionId
	 */
	public function transactionId() {  return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * acquirerId getter
	 * @return string acquirerId
	 */
	public function acquirerId() {  return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * acquirerReferenceId getter
	 * @return string acquirerReferenceId
	 */
	public function acquirerReferenceId() {  return $this->setOrGet(__FUNCTION__,null); }
}