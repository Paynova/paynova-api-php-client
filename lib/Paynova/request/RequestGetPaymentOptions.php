<?php
namespace Paynova\request;

use Paynova\http\HttpConfig;

/**
 * service: 	GetPaymentOptions
 * type: 		request
 * 
 * To get the paymentoptions that a merchant has
 * 
 * @package Paynova/request
 * @copyright Paynova 2015
 *
 */
class RequestGetPaymentOptions extends Request {
	
	
	/**
	 * constants for paymentChannelId
	 */
	const PAYMENT_CHANNEL_WEB = 1;
	const PAYMENT_CHANNEL_MAIL_TELEPHONE = 2;
	const PAYMENT_CHANNEL_RECURRING_SUBSCRIPTION = 7;
	
	/**
	 * See request/Request::__construct()
	 */
	public function __construct($http = null) {
		parent::__construct(array(
				"totalAmount","paymentChannelId","currencyCode","countryCode","languageCode"
			),
			array(
				"totalAmount","paymentChannelId","currencyCode","countryCode","languageCode"
			),
			"paymentoptions",
			$http
		);
	}
	
	/**
	 * Do the GetPaymentOptions  API request - ReponseGetPaymentOptions is returned
	 * 
	 * @throws PaynovaExceptionRequiredPropertyMissing
	 * @throws PaynovaExceptionHttp if exception occured when contacting server
	 * @throws PaynovaExceptionConfig
	 * @param HttpConfig $httpConfig (optional)
	 * @return ReponseGetPaymentOptions
	 */
	public function request(HttpConfig $httpConfig = null) {
		return parent::doRequest("POST",$httpConfig);
	}

	/**
	 * totalAmount setter/getter	
	 * Be sure to use a decimal point as the decimal separator
	 * @param float $value (optional) used when setting
	 * @return RequestGetPaymentOptions or float totalAmount
	 */
	public function totalAmount($value = null) { 
		return $this->setOrGet(__FUNCTION__,$value); 
	}
	
	
	/**
	 * paymentChannelId setter/getter
	 * The channel of payment. See constanst PAYMENT_CHANNEL_xxxx
	 * @param int $value (optional) used when setting
	 * @return RequestGetPaymentOptions or int paymentChannelId
	 */
	public function paymentChannelId($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	
	/**
	 * currencyCode setter/getter
	 * The three-letter (alpha-3) ISO currency code or currency number as per ISO 4217.
	 * See the helper class request/model/CurrencyCode
	 * @param string $value (optional) used when setting
	 * @return RequestGetPaymentOptions or string currencyCode
	 */
	public function currencyCode($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * The two character code for the country setter/getter
	 * According to standard ISO 3166-1 alpha-2
	 * @param string $value (optional) used when setting
	 * @return RequestGetPaymentOptions or string countryId
	 */
	public function countryCode($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * languageCode setter/getter
	 * The three-letter language code identifying the language of the user that will have the payment options displayed
	 * be displayed to the customer in.
	 * @param string $value (optional) used when setting
	 * @return InterfaceOptions or string customerLanguageCode
	 */
	public function languageCode($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	
}