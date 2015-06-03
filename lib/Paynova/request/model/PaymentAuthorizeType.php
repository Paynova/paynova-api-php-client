<?php
namespace Paynova\request\model;



/**
 *  A helper class for specifying the type of Authorize
 *
 * @package Paynova/request/model
 * @copyright Paynova 2015
 *
 */
abstract class PaymentAuthorizeType{
	const INVOICE_PAYMENT 	= "InvoicePayment";

	public static function idIsValidOtherwiseThrowInvalidException($id){
		$validIds = array(PaymentAuthorizeType::INVOICE_PAYMENT);
		if(!in_array($id,$validIds)){
			throw new \InvalidArgumentException("$id is not a valid PaymentChannel id");
		}
	}
}