<?php
require_once __DIR__."/../../../TestHelper.php";

class CurrencyCodeTest extends PHPUnit_Framework_TestCase {
	
	public function test_currencies() {
		$this->assertEquals(CurrencyCode::UNITED_STATES_DOLLAR,"USD");
		$this->assertEquals(CurrencyCode::EUROPEAN_EURO,"EUR");
		$this->assertEquals(CurrencyCode::BRITISH_POUND,"GBP");
		$this->assertEquals(CurrencyCode::SWEDISH_KRONA,"SEK");
		$this->assertEquals(CurrencyCode::NORWEGIAN_KRONE,"NOK");
		$this->assertEquals(CurrencyCode::DANISH_KRONE,"DKK");
		$this->assertEquals(CurrencyCode::SWISS_FRANC,"CHF");
		$this->assertEquals(CurrencyCode::AUSTRALIAN_DOLLAR,"AUD");
		$this->assertEquals(CurrencyCode::NEW_ZEALAND_DOLLAR,"NZD");
		$this->assertEquals(CurrencyCode::SINGAPORE_DOLLAR,"SGD");
		$this->assertEquals(CurrencyCode::CANADIAN_DOLLAR,"CAD");
		$this->assertEquals(CurrencyCode::POLISH_ZLOTY,"PLN");
		$this->assertEquals(CurrencyCode::TURKISH_LIRA,"TRY");
		$this->assertEquals(CurrencyCode::CHINESE_YUAN,"CNY");
		$this->assertEquals(CurrencyCode::JAPANESE_YEN,"JPY");
		$this->assertEquals(CurrencyCode::ISRAELI_NEW_SHEQEL,"ILS");
		
	}
	/**
	 * @expectedException PaynovaException
	 */
	public function test_badValidation() {
		CurrencyCode::validate("FOO");
	}
	
	public function test_validateSuccess() {
		CurrencyCode::validate(CurrencyCode::SWEDISH_KRONA);
	}
}