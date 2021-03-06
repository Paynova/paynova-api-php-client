<?php
namespace Paynova\request;

use Paynova\http\HttpConfig;
use Paynova\util\Util;
use Paynova\request\model\PaymentChannel;

/**
 * service: 	Initialize Payment
 * type: 		request
 *
 * The InitializePayment service is used to initialize the payment process. The response
 * if successful, will return a URL to redirect to user to.
 *
 * @package Paynova/request
 * @copyright Paynova 2014
 *
 */
class RequestInitializePayment extends Request {
	
	
	/**
	 * See request/Request::__construct()
	 */
	public function __construct($http = null) {
		parent::__construct(array(
				"orderId","totalAmount", "paymentChannelId",
				"paymentMethods" => "Paynova\\request\\model\\PaymentMethodCollection",
				"customData" => "Paynova\\request\\model\\CustomDataCollection",
				"sessionTimeout","routingIndicator","fraudScreeningProfile",
				"interfaceOptions" => "Paynova\\request\\model\\InterfaceOptions",
				"profilePaymentOptions" => "Paynova\\request\\model\\ProfilePaymentOptions",
				"lineItems" => "Paynova\\request\\model\\LineItemCollection"
			),
			array(
				"orderId","totalAmount","paymentChannelId",
				"interfaceOptions"
			),
			"orders/{orderId}/initializePayment",
			$http
		);
	}
	
	/**
	 * Do the InitializePayment API request - ReponseInitializePayment is returned
	 * @throws PaynovaExceptionRequiredPropertyMissing
	 * @throws PaynovaExceptionHttp if exception occured when contacting server
	 * @throws PaynovaExceptionConfig 
	 * @param HttpConfig $httpConfig (optional)
	 * @return ReponseInitializePayment
	 */
	public function request(HttpConfig $httpConfig = null) {
		return parent::doRequest("POST",$httpConfig);
	}

	/**
	 * orderId setter/getter
	 * The unique identifier (GUID) that you received from Paynova in the response from Create Order.
	 * @param string $value (optional) used when setting
	 * @return RequestInitializePayment or string orderId
	 */
	public function orderId($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * totalAmount setter/getter
	 * The total amount that should be processed for this payment. This must be equal to or less than the 
	 * original order amount, and less than the original order amount minus any payments which have been 
	 * already made on the order.
	 * @param float $value (optional) used when setting
	 * @return RequestInitializePayment or float totalAmount
	 */
	public function totalAmount($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * paymentChannelId setter/getter
	 * Use PaymentChannel helper class constants
	 * @param int $value (optional) used when setting
	 * @return RequestInitializePayment or int paymentChannelId
	 */
	public function paymentChannelId($value = null) { 
		if($value!=null)PaymentChannel::idIsValidOtherwiseThrowInvalidException($value);
		return $this->setOrGet(__FUNCTION__,$value); 
	}
	
	/**
	 * paymentMethods setter/getter
	 * One or more payment methods to display to the customer. If you do not send a value, all configured and 
	 * available payment methods will be displayed.
	 * @param PaymentMethodCollection $object (optional) used when setting
	 * @return PaymentMethodCollection
	 */
	public function paymentMethods($object = null) {
		if($object != null)Util::validateObject($object, "Paynova\\request\\model\\PaymentMethodCollection"); 
		return $this->setOrGet(__FUNCTION__,$object); 
	}
	
	/**
	 * customData setter/getter
	 * Collection of up to 10 (ten) private key-value data fields to store as meta-data on the transaction. 
	 * This data can be viewed in Merchant Services and is returned in the GetOrder response object. We 
	 * do not use this data for processing transactions.
	 * @param CustomDataCollection $object (optional) used when setting
	 * @return CustomDataCollection
	 */
	public function customData($object = null) { 
		if($object != null)Util::validateObject($object, "Paynova\\request\\model\\CustomDataCollection");
		return $this->setOrGet(__FUNCTION__,$object); 
	}
	
	/**
	 * sessionTimeout setter/getter
	 * The time-to-live (TTL) of the session, in seconds, before the session times out.
	 * @param int $value (optional) used when setting
	 * @return RequestInitializePayment or int sessionTimeout
	 */
	public function sessionTimeout($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * routingIndicator setter/getter
	 * The name or id of the routing table to use when processing payments.
	 * This field is used for advanced configurations and should only be provided if asked to do so by Paynova.
	 * @param string $value (optional) used when setting
	 * @return RequestInitializePayment or string routingIndicator
	 */
	public function routingIndicator($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * fraudScreeningProfile setter/getter
	 * The name or id of the fraud screening profile (named set of fraud screening rules) to use.
	 * This field is used for advanced configurations and should only be provided if asked to do so by Paynova.
	 * @param string $value (optional) used when setting
	 * @return RequestInitializePayment or string fraudScreeningProfile
	 */
	public function fraudScreeningProfile($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * interfaceOptions setter/getter
	 * Settings for the payment process
	 * @param InterfaceOptions $object (optional) used when setting
	 * @return InterfaceOptions
	 */
	public function interfaceOptions($object = null) {  
		if($object != null)Util::validateObject($object, "Paynova\\request\\model\\InterfaceOptions");
		return $this->setOrGet(__FUNCTION__,$object); 
	}
	
	/**
	 * profilePaymentOptions setter/getter
	 * Settings for the Customer profile cards
	 * @param ProfilePaymentOptions $object (optional) used when setting
	 * @return ProfilePaymentOptions
	 */
	public function profilePaymentOptions($object = null) {
		if($object != null)Util::validateObject($object, "Paynova\\request\\model\\ProfilePaymentOptions");
		return $this->setOrGet(__FUNCTION__,$object); 
	}
	
	/**
	 * lineItems setter/getter
	 * Line items included in this payment. Line items are required for the following cases, and are not 
	 * allowed if the original order is a simple order
	 * @param LineItemCollection $object (optional) used when setting
	 * @return LineItemCollection
	 */
	public function lineItems($object = null) {
		if($object!=null)Util::validateObject($object, "Paynova\\request\\model\\LineItemCollection" );
		return $this->setOrGet(__FUNCTION__,$object);
	}
	
}