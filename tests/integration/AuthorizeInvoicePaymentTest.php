<?php
require_once __DIR__."/../TestHelper.php";

use Paynova\request\RequestAuthorizeInvoicePayment;
use Paynova\response\ResponseAuthorizeInvoicePayment;
use Paynova\request\RequestCreateOrder;
use Paynova\request\model\PaymentChannel;
use Paynova\request\model\PaymentMethod;

class AuthorizeInvoicePaymentTest extends PHPUnit_Framework_TestCase {
	
	
	
	
	
	public function test_assertSuccessAuthorizeInvoicePayment() {
		TestHelper::setSandboxCredentials();
		
		$createOrderRequest = RequestCreateOrder::factory(
			array(
				"orderNumber"=>TestHelper::getRandomOrderNumber(),
				"currencyCode" =>"SEK",
				"totalAmount" => 125,
				"lineItems" => array(
						array(
								"id" => TestHelper::getRandomOrderNumber(),
								"articleNumber" => TestHelper::getRandomNumber(),
								"name" => "Foo",
								"quantity" => 1,
								"unitMeasure" =>"st.",
								"unitAmountExcludingTax" => 50,
								"taxPercent" => 25,
								"totalLineTaxAmount" =>round(1*50*(25/100),2),
								"totalLineAmount" => 62.50,
								
						),array(
								"id" => TestHelper::getRandomOrderNumber(),
								"articleNumber" => TestHelper::getRandomNumber(),
								"name" => "Foo2",
								"quantity" => 1,
								"unitMeasure" =>"st.",
								"unitAmountExcludingTax" => 50,
								"taxPercent" => 25,
								"totalLineTaxAmount" =>round(1*50*(25/100),2),
								"totalLineAmount" => 62.50,
								
						)
				)		
			)
		);
		$mockOrderId = TestHelper::getRandomOrderId();
		
		$mockHttp = new HttpMock(create_function('','return TestHelper::factoryHttpEventWithSuccess(\'SUCCESS_CREATE_ORDER\',\''.$mockOrderId.'\');'));
		//$mockHttp = new HttpImpl();
		$createOrderRequest->setHttp($mockHttp);
		$createOrderResponse = $createOrderRequest->request();
		
		
		$authorizeInvoicePaymentRequest = RequestAuthorizeInvoicePayment::factory(array(
				"orderId"=>$createOrderResponse->orderId,
				"totalAmount"=>"125.00",
				"paymentChannelId"=>PaymentChannel::WEB,
				"paymentMethodId"=>PaymentMethod::PAYNOVA_INVOICE,
				"paymentMethodProductId"=>"DirectInvoice"
		));
		
		
		
		$authorizeInvoicePaymentResponse = $authorizeInvoicePaymentRequest->request();
		
		
		
		$this->assertEquals( $authorizeInvoicePaymentResponse->status()->isSuccess, 1);
		$this->assertTrue( $authorizeInvoicePaymentResponse->status()->errors()->size()==0 );
		$this->assertNotEmpty($authorizeInvoicePaymentResponse->orderId());
	}
	
	
}