<?php
namespace Paynova\request;

use Paynova\http\HttpConfig;
use Paynova\util\Util;
use Paynova\request\model\PaymentChannel;
use Paynova\request\model\PaymentAuthorizeType;
/**
 *  AuthorizePayment a payment without using the payment window 
 *  Known subclasses RequestAuthorizeInvoicePayment
 *
 * @package Paynova/request
 * @copyright Paynova 2015
 *
 */
abstract class RequestAuthorizePayment extends Request {

	private $_authorizeType;

	/**
	 * Construct AuthorizePayment Request
	 */
	public function __construct($authorizationType, $http = null) {
		parent::__construct(array(
						"orderId",
						"paymentChannelId",
						"totalAmount",
						"authorizationType",
						"paymentMethodId",
						"paymentMethodProductId"
				
				),
				
				array(
						"orderId",
						/*"authorizationType", Also required but enforced by constructor*/
						"totalAmount", "paymentMethodId", "paymentMethodProductId", "paymentChannelId"
				),
				"orders/{orderId}/authorizePayment",
				$http,
				array("authorizationType"=>$authorizationType)
		);
		
		//Make sure that authorizeType is a valid PaymentAuthorizeType
		/*PaymentAuthorizeType::idIsValidOtherwiseThrowInvalidException($authorizeType);
		
		$this->_authorizeType = $authorizeType;
		$this->__set("authorizeType", $authorizeType);*/
	}

	/**
	 * Do the AuthorizePayment API request - ReponseAuthorizePayment is returned
	 *
	 * @throws PaynovaExceptionRequiredPropertyMissing
	 * @throws PaynovaExceptionHttp if exception occured when contacting server
	 * @throws PaynovaExceptionConfig
	 * @param HttpConfig $httpConfig (optional)
	 * @return ReponseAuthorizePayment
	 */
	public function request(HttpConfig $httpConfig = null) {
		return parent::doRequest("POST",$httpConfig);
	}
	
	/**
	 * orderId getter/setter
	 * The unique identifier (GUID) that you received from Paynova in the response from Create Order.
	 * @param string $value (optional) used when setting
	 * @return RequestAuthorizePayment or string orderId
	 */
	public function orderId($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * totalAmount setter/getter
	 * The total amount of the order.
	 * Be sure to use a decimal point as the decimal separator
	 * @param float $value (optional) used when setting
	 * @return RequestAuthorizePayment or float totalAmount
	 */
	public function totalAmount($value = null) {
		return $this->setOrGet(__FUNCTION__,$value);
	}
	
	/**
	 * authorizationType getter
	 * @return authorizationType
	 */
	public function authorizationType() {  return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * paymentMethodId getter/setter
	 * @param string $value (optional) used when setting
	 * @return RequestAuthorizePayment or paymentMethodId
	 */
	public function paymentMethodId($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * paymentMethodProductId getter/setter
	 * This property is received when calling GetPaymentOptions
	 * @param string $value (optional) used when setting
	 * @return RequestAuthorizePayment or paymentMethodProductId
	 */
	public function paymentMethodProductId($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * paymentChannelId setter/getter
	 * Use PaymentChannel helper class constants
	 * @param int $value (optional) used when setting
	 * @return RequestGetPaymentOptions or int paymentChannelId
	 */
	public function paymentChannelId($value = null) {
		if($value!=null)PaymentChannel::idIsValidOtherwiseThrowInvalidException($value);
		return $this->setOrGet(__FUNCTION__,$value);
	}

}
