<?php
require_once __DIR__."/../../../TestHelper.php";

use Paynova\request\model\PaymentMethod;
use Paynova\request\model\Address;

class PaymentMethodTest extends PHPUnit_Framework_TestCase {
	
	public function test_construct() {
		$method = new PaymentMethod();
		return $method;
	}
	/**
	 * @depends test_construct
	 */
	public function test_Visa(PaymentMethod $method) {
		$method->id(1);
		$this->assertEquals($method->id(""), PaymentMethod::CARD_VISA);
	}
	
	/**
	 * @depends test_construct
	 */
	public function test_MasterCard(PaymentMethod $method) {
		$method->id(2);
		$this->assertEquals($method->id(), PaymentMethod::CARD_MASTERCARD);
	}
	
	/**
	 * @depends test_construct
	 */
	public function test_AmericanExpress(PaymentMethod $method) {
		$method->id(3);
		$this->assertEquals($method->id(), PaymentMethod::CARD_AMERICAN_EXPRESS);
	}
	
	/**
	 * @depends test_construct
	 */
	public function test_DinersClub(PaymentMethod $method) {
		$method->id(4);
		$this->assertEquals($method->id(), PaymentMethod::CARD_DINERS_CLUB);
	}
	
	/**
	 * @depends test_construct
	 */
	public function test_Maestro(PaymentMethod $method) {
		$method->id(12);
		$this->assertEquals($method->id(), PaymentMethod::CARD_MAESTRO);
	}
	
	/**
	 * @depends test_construct
	 */
	public function test_NordeaSweden(PaymentMethod $method) {
		$method->id(101);
		$this->assertEquals($method->id(), PaymentMethod::BANK_NORDEA_SWEDEN);
	}
	
	/**
	 * @depends test_construct
	 */
	public function test_Swedebank(PaymentMethod $method) {
		$method->id(102);
		$this->assertEquals($method->id(), PaymentMethod::BANK_SWEDBANK);
	}
	
	/**
	 * @depends test_construct
	 */
	public function test_Handelsbanken(PaymentMethod $method) {
		$method->id(103);
		$this->assertEquals($method->id(), PaymentMethod::BANK_HANDELSBANKEN);
	}
	
	/**
	 * @depends test_construct
	 */
	public function test_SEB(PaymentMethod $method) {
		$method->id(104);
		$this->assertEquals($method->id(), PaymentMethod::BANK_SEB);
	}
	
	/**
	 * @depends test_construct
	 */
	public function test_iDeal(PaymentMethod $method) {
		$method->id(110);
		$this->assertEquals($method->id(), PaymentMethod::BANK_IDEAL);
	}
	
	/**
	 * @depends test_construct
	 */
	public function test_Lastschrift(PaymentMethod $method) {
		$method->id(111);
		$this->assertEquals($method->id(), PaymentMethod::BANK_LASTSCHRIFT_ELV);
	}
	
	/**
	 * @depends test_construct
	 */
	public function test_NordeaFinland(PaymentMethod $method) {
		$method->id(113);
		$this->assertEquals($method->id(), PaymentMethod::BANK_NORDEA_FINLAND);
	}
	
	/**
	 * @depends test_construct
	 */
	public function test_Aktia(PaymentMethod $method) {
		$method->id(114);
		$this->assertEquals($method->id(), PaymentMethod::BANK_AKTIA);
	}
	
	/**
	 * @depends test_construct
	 */
	public function test_DanskeBankFinland(PaymentMethod $method) {
		$method->id(115);
		$this->assertEquals($method->id(), PaymentMethod::BANK_DANSKE_BANK_FINLAND);
	}
	
	/**
	 * @depends test_construct
	 */
	public function test_ChinaPayCrossborder(PaymentMethod $method) {
		$method->id(116);
		$this->assertEquals($method->id(), PaymentMethod::BANK_CHINA_PAY_CROSSBORDER);
	}
	
	/**
	 * @depends test_construct
	 */
	public function test_Pohjola(PaymentMethod $method) {
		$method->id(117);
		$this->assertEquals($method->id(), PaymentMethod::BANK_POHJOLA);
	}
	
	/**
	 * @depends test_construct
	 */
	public function test_Uberweisung(PaymentMethod $method) {
		$method->id(118);
		$this->assertEquals($method->id(), PaymentMethod::BANK_UBERWEISUNG);
	}
	
	/**
	 * @depends test_construct
	 */
	public function test_ChinaPayDomestic(PaymentMethod $method) {
		$method->id(119);
		$this->assertEquals($method->id(), PaymentMethod::BANK_CHINA_PAY_DOMESTIC);
	}
	
	/**
	 * @depends test_construct
	 */
	public function test_DanskeBankDenmark(PaymentMethod $method) {
		$method->id(121);
		$this->assertEquals($method->id(), PaymentMethod::BANK_DANSKE_BANK_DENMARK);
	}
	
	/**
	 * @depends test_construct
	 */
	public function test_SofortuberweisungSofortbanking(PaymentMethod $method) {
		$method->id(123);
		$this->assertEquals($method->id(""), PaymentMethod::BANK_SOFORTUBERWEISUNG_SOFORTBANKING);
	}
	
	/**
	 * @depends test_construct
	 */
	public function test_Skrill(PaymentMethod $method) {
		$method->id(302);
		$this->assertEquals($method->id(), PaymentMethod::E_ACCOUNT_WALLET_SKRILL);
	}
	
	/**
	 * @depends test_construct
	 */
	public function test_PayPal(PaymentMethod $method) {
		$method->id(304);
		$this->assertEquals($method->id(), PaymentMethod::E_ACCOUNT_WALLET_PAYPAL);
	}
	
	/**
	 * @depends test_construct
	 */
	public function test_ResursBankCard(PaymentMethod $method) {
		$method->id(305);
		$this->assertEquals($method->id(), PaymentMethod::E_ACCOUNT_WALLET_RESURS_BANK_CARD);
	}
	
	/**
	 * @depends test_construct
	 */
	public function test_ResursBankInvoice(PaymentMethod $method) {
		$method->id(306);
		$this->assertEquals($method->id(), PaymentMethod::E_ACCOUNT_WALLET_RESURS_BANK_INVOICE);
	}
	
	public function test_propertiesAgainstSignature(){
		$object = new Address();
		$signature = $object->getSignature();
		foreach($signature as $key=>$value) {
			$method = $value;
			$param = "";
		
			if(!is_int($key) && class_exists($value)) {
				$method=$key;
				$param = new $value();
			}else {
				$param = "foo";
			}
			call_user_func_array(array($object,$method),array($param));
			$this->assertEquals(call_user_func_array(array($object,$method),array()),$param);
		}
	}
	
	public function test_factory(){
		$o1 = PaymentMethod::factory(array(
				"id"=>"foo"
	
		
		));
		$o2 = new PaymentMethod();
		$o2->id("foo");
		$this->assertEquals($o1,$o2);
	}
	
	
}