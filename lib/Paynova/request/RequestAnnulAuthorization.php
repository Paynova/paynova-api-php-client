<?php
/**
 * service: 	AnnulAuthorization
 * type: 		request
 * 
 * The Annul Authorization service is used to annul an authorization. Depending on the payment method 
 * used to generate the authorization, this service has different effects.
 * 
 * @package Paynova/request
 * @copyright Paynova 2014
 *
 */
class RequestAnnulAuthorization extends Request {

	/**
	 * See request/Request::__construct()
	 */
	public function __construct($http = null) {
		parent::__construct(array(
				"orderId","transactionId","totalAmount", 
				"lineItems" => "LineItemCollection",
				"customData" => "CustomDataCollection"
			),
			array(
				"transactionId"
			),
			array(
				"orders/{orderId}/transactions/{transactionId}/annul/{totalAmount}",
				"transactions/{transactionId}/annul/{totalAmount}"
			)
			,$http
		);
	}
	
	/**
	 * Do the AnnulAuthorization API request - ReponseAnnulAuthorization is returned
	 * 
	 * @throws PaynovaExceptionRequiredPropertyMissing
	 * @throws PaynovaExceptionHttp if exception occured when contacting server
	 * @throws PaynovaExceptionConfig
	 * @param HttpConfig $httpConfig (optional)
	 * @return ReponseAnnulAuthorization
	 */
	public function request(HttpConfig $httpConfig = null) {
		return parent::doRequest("POST",$httpConfig);
	}

	/**
	 * orderId setter/getter
	 * The unique id you received from Paynova to identify the order.
	 * @param string $value (optional) used when setting
	 * @return RequestAnnulAuthorization or string orderId
	 */
	public function orderId($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * transactionId setter/getter
	 * The transaction id you received from Paynova pointing to an authorized payment transaction.
	 * @param string $value (optional) used when setting
	 * @return RequestInitializePayment or string transactionId
	 */
	public function transactionId($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * totalAmount setter/getter
	 * The total amount to annul. Depending on the payment method, partial annullments may or may 
	 * not be allowed.
	 * @param float $value (optional) used when setting
	 * @return RequestInitializePayment or float totalAmount
	 */
	public function totalAmount($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
	
	
	/**
	 * lineItems setter/getter
	 * The line items which are being annulled. Line items are only required when annuling an amount 
	 * less than the original transaction amount. Line items are only allowed when the original 
	 * order was a detailed order. See Orders for more information on detailed vs. simple orders.
	 * @throws InvalidArgumentException when setting, if $object is not of class LineItemCollection
	 * @param LineItemCollection $object (optional) used when setting
	 * @return LineItemCollection
	 */
	public function lineItems($object = null) {
		if($object!=null)Util::validateObject($object, "LineItemCollection" );
		return $this->setOrGet(__FUNCTION__,$object);
	}
	
	/**
	 * customData setter/getter
	 * Collection of up to 10 (ten) private key-value data fields to store as meta-data on the transaction. 
	 * This data can be viewed in Merchant Services and is returned in the GetOrder response object. 
	 * We do not use this data for processing transactions.
	 * @throws InvalidArgumentException when setting, if $object is not of class CustomDataCollection
	 * @param CustomDataCollection $object (optional) used when setting
	 * @return CustomDataCollection
	 */
	public function customData($object = null) {
		if($object!=null)Util::validateObject($object, "CustomDataCollection" );
		return $this->setOrGet(__FUNCTION__,$object);
	}
	
}