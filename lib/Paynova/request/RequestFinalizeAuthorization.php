<?php
namespace Paynova\request;

use Paynova\http\HttpConfig;
use Paynova\util\Util;

/**
 * service: 	FinalizeAuthorization
 * type: 		request
 * 
 * The Finalize Authorization service is used to finalize all or part of an authorization.
 * 
 * @package Paynova/request
 * @copyright Paynova 2014
 *
 */
class RequestFinalizeAuthorization extends Request {
	
	
	/**
	 * See request/Request::__construct()
	 */
	public function __construct($http = null) {
		parent::__construct(array(
				"orderId","transactionId","totalAmount", 
				"lineItems" => "Paynova\\request\\model\\LineItemCollection",
				"invoiceId"
			),
			array(
					"transactionId","totalAmount"
			),
			array(
					"orders/{orderId}/transactions/{transactionId}/finalize/{totalAmount}",
					"transactions/{transactionId}/finalize/{totalAmount}"
			),
			$http
		);
	}
	
	/**
	 * Do the FinalizeAuthorization API request - ReponseFinalizeAuthorization is returned
	 * 
	 * @throws PaynovaExceptionRequiredPropertyMissing
	 * @throws PaynovaExceptionHttp if exception occured when contacting server
	 * @throws PaynovaExceptionConfig
	 * @param HttpConfig $httpConfig (optional)
	 * @return ReponseFinalizeAuthorization
	 */
	public function request(HttpConfig $httpConfig = null) {
		return parent::doRequest("POST",$httpConfig);
	}

	/**
	 * orderId setter/getter
	 * The unique id you received from Paynova to identify the order.
	 * @param string $value (optional) used when setting
	 * @return RequestFinalizeAuthorization or string orderId
	 */
	public function orderId($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * transactionId setter/getter
	 * The unique id of the transaction (authorization) that you received from Paynova.
	 * @param string $value (optional) used when setting
	 * @return RequestFinalizeAuthorization or string transactionId
	 */
	public function transactionId($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * totalAmount setter/getter
	 * The total amount to finalize. The amount must be equal to or less than the original authorized amount.
	 * @param float $value (optional) used when setting
	 * @return RequestFinalizeAuthorization or float totalAmount
	 */
	public function totalAmount($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
	
	
	/**
	 * lineItems setter/getter
	 * @throws InvalidArgumentException when setting, if $object is not of class LineItemCollection
	 * @param LineItemCollection $object (optional) used when setting
	 * @return LineItemCollection
	 */
	public function lineItems($object = null) {
		if($object!=null)Util::validateObject($object, "Paynova\\request\\model\\LineItemCollection" );
		return $this->setOrGet(__FUNCTION__,$object);
	}
	
	/**
	 * invoiceId setter/getter
	 * Your identifier for the invoice. For invoice payment methods, this identifier will be printed on the invoice and is required.
	 * @param string $value (optional) used when setting
	 * @return RequestFinalizeAuthorization or string invoiceId
	 */
	public function invoiceId($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
}