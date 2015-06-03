<?php
require_once __DIR__."/../TestHelper.php";

use Paynova\request\RequestGetPaymentOptions;
use Paynova\request\model\PaymentChannel;

class GetPaymentOptionsTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * 	Making sure that the response object is of type ResponseGetAddresses
	 */
	public function test_getPaymentOptionsResponseTypeIsCorrect() {
		TestHelper::setSandboxCredentials();
		
		$mockHttp = new HttpMock(create_function('','return TestHelper::factoryHttpEventWithSuccess("SUCCESS_GET_PAYMENT_OPTIONS","");'));
		
		$request = new RequestGetPaymentOptions($mockHttp);
		
		
		$request->countryCode("SE")
			->totalAmount(100.00)
			->paymentChannelId(PaymentChannel::WEB)
			->currencyCode("SEK")
			->countryCode("SE")
			->languageCode("SWE");
		
		
		
		$response = $request->request();
		
		$this->assertInstanceOf("Paynova\\response\\ResponseGetPaymentOptions",$response,"The response is not of type ResponseGetPaymentOptions");
		
		$this->assertTrue($response->status->isSuccess());
	}
}