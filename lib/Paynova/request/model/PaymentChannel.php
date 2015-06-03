<?php
namespace Paynova\request\model;



/**
 *  A helper class for specifying the payment channel when making requests
 *
 * @package Paynova/request/model
 * @copyright Paynova 2015
 *
 */
abstract class PaymentChannel{
	const WEB = 1;
	const MAIL_TELEPHONE = 2;
	const RECURRING_SUBSCRIPTION = 7;

	public static function idIsValidOtherwiseThrowInvalidException($id){
		$validIds = array(PaymentChannel::WEB, PaymentChannel::MAIL_TELEPHONE, PaymentChannel::RECURRING_SUBSCRIPTION);
		if(!in_array($id,$validIds)){
			throw new \InvalidArgumentException("$id is not a valid PaymentChannel id");
		}
	}
}