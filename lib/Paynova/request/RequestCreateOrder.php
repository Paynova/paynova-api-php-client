<?php
namespace Paynova\request;

use Paynova\http\HttpConfig;
use Paynova\util\Util;
use Paynova\request\model\Customer;

/**
 *
 * service: 	CreateOrder
 * type: 		request
 * 
 * The CreateOrder service is used to create an order within Paynova's system.  
 * You will receive an identifier orderId (GUID) for the order which will be used in 
 * subsequent requests to Paynova such as, among others, Initialize Payment, Finalize Authorization and Refund Payment.
 * 
 * @package Paynova/request
 * @copyright Paynova 2014
 *
 */
class RequestCreateOrder extends Request {
	
	/**
	 * See request/Request::__construct()
	 */
	public function __construct($http = null) {
		parent::__construct(array(
				"orderNumber","currencyCode","totalAmount",
				"customer"	=> "Paynova\\request\\model\\Customer",
				"billTo"	=> "Paynova\\model\\NameAddress",
				"shipTo"	=> "Paynova\\model\\NameAddress",
				"lineItems"	=> "Paynova\\request\\model\\LineItemCollection",
				"orderDescription","salesChannel","salesLocationId" 
			),
			array("orderNumber","currencyCode","totalAmount"),
			"/orders/create/{orderNumber}/{totalAmount}/{currencyCode}",
			$http
		);
	}
	
	/**
	 * Do the CreateOrder API request - ReponseCreateOrder is returned
	 *
	 * @throws PaynovaExceptionRequiredPropertyMissing
	 * @throws PaynovaExceptionHttp if exception occured when contacting server
	 * @throws PaynovaExceptionConfig
	 * @param HttpConfig $httpConfig (optional)
	 * @return ResponseCreateOrder
	 */
	public function request(HttpConfig $httpConfig = null) {
		return parent::doRequest("POST",$httpConfig);
	}
	
	/**
	 * orderNumber setter/getter
	 * Your identifier for the order, most likely from your order management system.
	 * Validation: Free-text, preferably unique, minimum length = 4, maximum length = 50.
	 * @param string $value (optional) used when setting
	 * @return RequestCreateOrder or string orderNumber
	 */
	public function orderNumber($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * currencyCode setter/getter
	 * The three-letter (alpha-3) ISO currency code or currency number as per ISO 4217.
	 * See the helper class request/model/CurrencyCode
	 * @param string $value (optional) used when setting
	 * @return RequestCreateOrder or string currencyCode
	 */
	public function currencyCode($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * totalAmount setter/getter	
	 * The total amount of the order. If line items are provided, the value of this field must equal the total sum of all line items.
	 * Be sure to use a decimal point as the decimal separator
	 * @param float $value (optional) used when setting
	 * @return RequestCreateOrder or float totalAmount
	 */
	public function totalAmount($value = null) { 
		return $this->setOrGet(__FUNCTION__,$value); 
	}
	
	/**
	 * salesChannel setter/getter	
	 * Your reference for the sales channel through which the customer is purchasing goods/services.
	 * Validation: Free-text, minimum length = 0, maximum length = 50.
	 * @param string $value (optional) used when setting
	 * @return RequestCreateOrder or string salesChannel
	 */
	public function salesChannel($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * salesLocationId setter/getter
	 * Your identifier for the sales location. This might be a website URL, a country, a call-center location, etc.REQUIRED
	 * @param string $value (optional) used when setting
	 * @return RequestCreateOrder or string salesLocationId
	 */
	public function salesLocationId($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * customer setter/getter
	 * The name of the customer and/or company.
	 * @param Customer customer (optional) used when setting
	 * @return Customer
	 */
	public function customer($object = null) {
		if($object!=null)Util::validateObject($object, "Paynova\\request\\model\\Customer" );
		return $this->setOrGet(__FUNCTION__,$object); 
	}
	
	/**
	 * billTo setter/getter
	 * The billing name and address of the customer/company, generally the "invoice address" or "account holder" details.
	 * @param NameAddress $object (optional) used when setting
	 * @return NameAddress
	 */
	public function billTo($object = null) { 
		if($object!=null)Util::validateObject($object, "Paynova\\model\\NameAddress" );
		return $this->setOrGet(__FUNCTION__,$object); 
	}
	
	/**
	 * shipTo setter/getter
	 * The ship-to name and address of the recipient.
	 * @param NameAddress $object (optional) used when setting
	 * @return NameAddress
	 */
	public function shipTo($object = null) { 
		if($object!=null)Util::validateObject($object, "Paynova\\model\\NameAddress" );
		return $this->setOrGet(__FUNCTION__,$object); 
	}
	
	/**
	 * lineItems setter/getter
	 * The line items included in this order (what the customer is paying for). You may include as many line items as required to specify the order.
	 * @param LineItemCollection $object (optional) used when setting
	 * @return LineItemCollection
	 */
	public function lineItems($object = null) {
		if($object!=null)Util::validateObject($object, "Paynova\\request\\model\\LineItemCollection" );
		return $this->setOrGet(__FUNCTION__,$object);
	}
	
	/**
	 * orderDescription setter/getter
	 * A free-text field which describes the order. This information is stored on the transaction level.
	 * @param string $value (optional) used when setting
	 * @return RequestCreateOrder or string salesLocationId
	 */
	public function orderDescription($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	
}

