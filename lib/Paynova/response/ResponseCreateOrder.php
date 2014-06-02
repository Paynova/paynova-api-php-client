<?php
/**
 *
 * service: 	CreateOrder
 * type: 		response
 *
 * An object of this class will be created by RequestCreateOrder from the API REST call response
 * Hold only read-properties
 *
 * @package Paynova/request
 * @copyright Paynova 2014
 *
 */
class ResponseCreateOrder extends Response {
	
	/**
	 * @see response/Response::__construct()
	 */
	public function __construct() {
		parent::__construct(array(
			"orderId"
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
}