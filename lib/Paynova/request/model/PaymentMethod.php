<?php
/**
 * class PaymentMethod
 * part of service: 	see Paynova/request/model/PaymentMethodCollection
 *
 *
 * @package Paynova/request/model
 * @copyright Paynova 2014
 *
 */
class PaymentMethod extends Instance {

	/**
	 * payment cards constants
	 */
	const CARD_VISA = 1;
	const CARD_MASTERCARD = 2;
	const CARD_AMERICAN_EXPRESS = 3;
	const CARD_DINERS_CLUB = 4;
	const CARD_MAESTRO = 12;
	
	/**
	 * bank constants
	 */
	const BANK_NORDEA_SWEDEN = 101;
	const BANK_SWEDBANK = 102;
	const BANK_HANDELSBANKEN = 103;
	const BANK_SEB = 104;
	const BANK_IDEAL = 110;
	const BANK_LASTSCHRIFT_ELV = 111;
	const BANK_NORDEA_FINLAND = 113;
	const BANK_AKTIA = 114;
	const BANK_DANSKE_BANK_FINLAND = 115;
	const BANK_CHINA_PAY_CROSSBORDER = 116;
	const BANK_POHJOLA = 117;
	const BANK_UBERWEISUNG = 118;
	const BANK_CHINA_PAY_DOMESTIC = 119;
	const BANK_DANSKE_BANK_DENMARK = 121;
	const BANK_SOFORTUBERWEISUNG_SOFORTBANKING = 123;
	
	/**
	 * E-account/wallet constants
	 */
	const E_ACCOUNT_WALLET_SKRILL = 302;
	const E_ACCOUNT_WALLET_PAYPAL = 304;
	const E_ACCOUNT_WALLET_RESURS_BANK_CARD = 305;
	const E_ACCOUNT_WALLET_RESURS_BANK_INVOICE = 306;
	
	
	/**
	 * @see model/Instance::__construct()
	 */
	public function __construct() {
		parent::__construct(array(
			"id"
		));
	}
	
	/**
	 * id setter/getter
	 * The id of the payment method. Use the constants in the class 
	 * Three categories of methods/constants exists CARD_xxx, BANK_xxx, E_ACCOUNT_WALLET_xxx
	 * @param int $value (optional) used when setting
	 * @return PaymentMethod or int id
	 */
	public function id($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
}