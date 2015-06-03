<?php
require_once __DIR__."/../../TestHelper.php";

use Paynova\request\RequestGetPaymentOptions;
use Paynova\request\model\PaymentChannel;

class RequestGetPaymentOptionsTest extends PHPUnit_Framework_TestCase
{
	
	/**
	 * Test that all properties has its getter/setter
	 */
	public function test_propertiesAgainstSignature(){
		$object = new RequestGetPaymentOptions();
		$specialArgumentFunction = create_function('$method,$param','return $method=="paymentChannelId"?'.Paynova\request\model\PaymentChannel::WEB.':$param;');
		TestHelper::assert_modelSignature($this,$object,$specialArgumentFunction);
	}
	
	/**
	 *	Test that the properties exist
	 */
	public function testPropertiesExists() {
		$request = new RequestGetPaymentOptions();
		
		$properties = $request->getPropertiesAsArray(false);
		
		
		
		$this->assertArrayHasKey("totalAmount",$properties,"RequestGetPaymentOptions does not have property totalAmount");
		
		$this->assertArrayHasKey("paymentChannelId",$properties,"RequestGetPaymentOptions does not have property paymentChannelId");
		
		$this->assertArrayHasKey("currencyCode",$properties,"RequestGetPaymentOptions does not have property currencyCode");
		
		$this->assertArrayHasKey("countryCode",$properties,"RequestGetPaymentOptions does not have property countryCode");
		
		$this->assertArrayHasKey("languageCode",$properties,"RequestGetPaymentOptions does not have property languageCode");
		
	}
	
	/**
	 *	Test that the rest path comes out correct
	 */
	public function testRestPathIsCorrect() {
		$request = new RequestGetPaymentOptions();
		
		$expectedPath = "paymentoptions";
		
		$this->assertEquals($request->getRestPath(),$expectedPath,"Rest path is not ".$expectedPath);
		
	}
	
	/**
	 *	Test that the rest path comes out correct
	 */
	public function testFactoryCreate() {
		
		$request = RequestGetPaymentOptions::factory(array(
			"totalAmount"=>"100.00",
			"paymentChannelId"=>PaymentChannel::WEB,
			"currencyCode"=>"SEK",
			"countryCode"=>"SE",
			"languageCode"=>"SWE"
		));
		
		try{
			$request->validateRequired();
			$this->assertTrue(true);
		}catch(PaynovaExceptionRequiredPropertyMissing $e){
			$this->assertTrue(false,"RequestGetAddresses have more required properties");
		}
	
	}

}