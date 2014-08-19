<?php
namespace Paynova\request\model;

use Paynova\exception\PaynovaException;

/**
* class CurrencyCode is helper class for currencies
* 
* We use currency codes as listed in ISO 4217.  T
*
* @package Paynova/request/model
* @copyright Paynova 2014
*/
class CurrencyCode {
	
	/**
	 * The following currency codes are currently supported by Paynova.
	 * @var const
	 */
	const UNITED_STATES_DOLLAR 	= "USD";
	const EUROPEAN_EURO 		= "EUR";
	const BRITISH_POUND 		= "GBP";
	const SWEDISH_KRONA 		= "SEK";
	const NORWEGIAN_KRONE 		= "NOK";
	const DANISH_KRONE 			= "DKK";
	const SWISS_FRANC 			= "CHF";
	const AUSTRALIAN_DOLLAR 	= "AUD";
	const NEW_ZEALAND_DOLLAR 	= "NZD";
	const HONG_KONG_DOLLAR 		= "HKD";
	const SINGAPORE_DOLLAR 		= "SGD";
	const CANADIAN_DOLLAR 		= "CAD";
	const POLISH_ZLOTY 			= "PLN";
	const TURKISH_LIRA 			= "TRY";
	const CHINESE_YUAN 			= "CNY";
	const JAPANESE_YEN 			= "JPY";
	const ISRAELI_NEW_SHEQEL 	= "ILS";
	
	/**
	 * 
	 * @var array 
	 */
	private static $_currencies = array(
		"USD",
		"EUR",
		"GBP",
		"SEK",
		"NOK",
		"DKK",
		"CHF",
		"AUD",
		"NZD",
		"HKD",
		"SGD",
		"CAD",
		"PLN",
		"TRY",
		"CNY",
		"JPY",
		"ILS"
	);
	
	/**
	 * Validate if $currency is a valid currency
	 * @param string $currency
	 * @throws PaynovaException if $currency is not a valid currency
	 */
	public static function validate($currency) {
		if(!in_array($currency,self::$_currencies)) {
			throw new PaynovaException("The Currency code '".$currency."' is not a valid currency to use in the Paynova API");
		}
	}
}