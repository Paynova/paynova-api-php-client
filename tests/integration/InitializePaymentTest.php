<?php
require_once __DIR__."/../TestHelper.php";

use Paynova\request\RequestCreateOrder;
use Paynova\request\RequestInitializePayment;
use Paynova\request\model\InterfaceOptions;
use Paynova\request\model\PaymentChannel;

class InitializePaymentTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * orderId aka GUID
	 */
	public function test_failInitializePaymentDueBadOrderId() {
		//TestHelper::setSandboxCredentials();
		$request = RequestInitializePayment::factory(array(
				"orderId"=>"1234",
				"totalAmount"=>100.00,
				"paymentChannelId"=>PaymentChannel::WEB,
				"interfaceOptions"=>array(
						"interfaceId"=>InterfaceOptions::ID_AERO,
						"customerLanguageCode"=>"swe",
						"urlRedirectSuccess"=>localConfig("merchantURL")."/back/",
						"urlRedirectCancel"=>localConfig("merchantURL")."/back/",
						"urlRedirectPending"=>localConfig("merchantURL")."/back/",
						"urlCallback"=>localConfig("merchantURL")."/hooks/"
						
				)
		));
		$mockHttp = new HttpMock(create_function('','return TestHelper::factoryHttpEventWithError("ORDER_NOT_FOUND");'));
		$request->setHttp($mockHttp);
		$response = $request->request();
		$this->assertNotEquals($response->status()->isSuccess(), 1);
		$this->assertTrue($response->status()->statusKey()=="ORDER_NOT_FOUND");
	}
	
	public function test_succesInitializePayment() {
		//TestHelper::setSandboxCredentials();
		$request = RequestCreateOrder::factory(array(
				"orderNumber"=>TestHelper::getRandomOrderNumber(),
				"currencyCode" =>"SEK",
				"totalAmount" => 100.00
		));
		$mockOrderId = "297b8df7-3fb8-4058-a813-a33200c52845";
		
		$mockHttp = new HttpMock(create_function('','return TestHelper::factoryHttpEventWithSuccess("SUCCESS_CREATE_ORDER","'.$mockOrderId.'");'));
		$request->setHttp($mockHttp);
		$response = $request->request();
		
		$request = RequestInitializePayment::factory(array(
				"orderId"=>$response->orderId(),
				"totalAmount"=>100.00,
				"paymentChannelId"=>PaymentChannel::WEB,
				"interfaceOptions"=>array(
						"interfaceId"=>InterfaceOptions::ID_AERO,
						"customerLanguageCode"=>"swe",
						"urlRedirectSuccess"=>localConfig("merchantURL")."/back/",
						"urlRedirectCancel"=>localConfig("merchantURL")."/back/",
						"urlRedirectPending"=>localConfig("merchantURL")."/back/",
						"urlCallback"=>localConfig("merchantURL")."/hooks/"
				),
				"profilePaymentOptions"=>array(
						"profileId" => "112233"
				)
		));
		$mockUrl = "http://www.foo.com";
		$mockHttp = new HttpMock(create_function('','return TestHelper::factoryHttpEventWithSuccess("SUCCESS_INITALIZE_PAYMENT","'.$mockUrl.'");'));
		$request->setHttp($mockHttp);
		$response = $request->request();
		$this->assertNotEmpty($response->url());
		$this->assertEquals($response->status()->isSuccess(), 1);
	}
}