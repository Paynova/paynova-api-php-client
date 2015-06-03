<?php
namespace Paynova\request;

use Paynova\http\HttpConfig;
use Paynova\request\model\PaymentAuthorizeType;

/**
 *  AuthorizePayment a payment without using the payment window 
 *  Known subclasses RequestAuthorizeInvoicePayment
 *
 * @package Paynova/request
 * @copyright Paynova 2015
 *
 */
class RequestAuthorizeInvoicePayment extends RequestAuthorizePayment {

	/**
	 * Construct RequestAuthorizeInvoicePayment Request
	 */
	public function __construct($http = null) {
		parent::__construct(PaymentAuthorizeType::INVOICE_PAYMENT, $http);
	}
	
}