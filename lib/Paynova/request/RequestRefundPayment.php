<?php
namespace Paynova\request;

use Paynova\http\HttpConfig;
use Paynova\util\Util;

/**
 * service: 	RefundPayment
 * type: 		request
 * 
 * The Refund Payment service is used to refund a Payment within Paynova's system.
 * 
 * @package Paynova/request
 * @copyright Paynova 2014
 *
 */
class RequestRefundPayment extends Request {
	
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
					"orders/{orderId}/transactions/{transactionId}/refund/{totalAmount}",
					"transactions/{transactionId}/refund/{totalAmount}"
			),
			$http
		);
	}
	
	/**
	 * Do the RefundPayment API request - ReponseRefundPayment is returned
	 * 
	 * @throws PaynovaExceptionRequiredPropertyMissing
	 * @throws PaynovaExceptionHttp if exception occured when contacting server
	 * @throws PaynovaExceptionConfig
	 * @param HttpConfig $httpConfig (optional)
	 * @return ReponseRefundPayment
	 */
	public function request(HttpConfig $httpConfig = null) {
		return parent::doRequest("POST",$httpConfig);
	}

	/**
	 * orderId setter/getter
	 * The unique id for the order which you received in the response from your original 
	 * Create Order request.
	 * @param string $value (optional) used when setting
	 * @return RequestRefundPayment or string orderId
	 */
	public function orderId($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * transactionId setter/getter
	 * The original id of the transaction to refund. The transaction must have been successfully 
	 * finalized before a refund may be processed.
	 * @param string $value (optional) used when setting
	 * @return RequestInitializePayment or string transactionId
	 */
	public function transactionId($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * totalAmount setter/getter
	 * The total amount to refund. If provided, the amount must be equal to or less than the 
	 * finalized amount of the finalized transaction.
	 * @param float $value (optional) used when setting
	 * @return RequestInitializePayment or float totalAmount
	 */
	public function totalAmount($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
	
	
	/**
	 * lineItems setter/getter
	 * The line items which are being refunded. Line items are required if the totalAmount is less 
	 * than the original finalized amount. Line items may not be specified for simple orders. 
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
	 * @return RequestInitializePayment or string invoiceId
	 */
	public function invoiceId($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
}