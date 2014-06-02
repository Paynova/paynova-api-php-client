<?php
/**
 * service: ResponseInitializePayment
 * type: 	response
 *
 * This class will be used in response to RequestInitializePayment
 * Hold only read-properties
 *
 * @package Paynova/response
 * @copyright Paynova 2014
 */
class ResponseInitializePayment extends Response {
	
	
	/**
	 * @see response/Response::__construct()
	 */
	public function __construct() {
		parent::__construct(array(
			"sessionId","url"
		));
	}
	
	/**
	 * sessionId getter
	 * The unique identifier (GUID) for the payment session. This id will be used when opening/redirecting 
	 * to our hosted payment pages. This parameter will not be returned if the operation fails.
	 * @return string sessionId
	 */
	public function sessionId() {  return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * url getter
	 * The prepared URL to our hosted payment page. This parameter will not be returned if the operation 
	 * fails.
	 * @return url sessionId
	 */
	public function url() {  return $this->setOrGet(__FUNCTION__,null); }
}