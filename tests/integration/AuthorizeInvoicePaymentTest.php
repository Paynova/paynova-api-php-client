<?php
require_once __DIR__."/../TestHelper.php";

use Paynova\request\RequestGetAddresses;
use Paynova\request\RequestAuthorizeInvoicePayment;
use Paynova\response\ResponseAuthorizeInvoicePayment;
use Paynova\request\RequestCreateOrder;
use Paynova\request\model\PaymentChannel;
use Paynova\request\model\PaymentMethod;

class AuthorizeInvoicePaymentTest extends PHPUnit_Framework_TestCase {
	
	public function test_assertSuccessAuthorizeInvoicePayment() {
		TestHelper::setSandboxCredentials();
		
		//Get addressess to use in the create order
		$mockHttp = new HttpMock(create_function('','return TestHelper::factoryHttpEventWithSuccess("SUCCESS_GET_ADDRESSES","");'));
		
		$getAddressesRequest = new RequestGetAddresses($mockHttp);
		
		$getAddressesRequest->countryCode("SE")
		->governmentId(localConfig("customerGovernmentId"));
		
		$getAddressesResponse = $getAddressesRequest->request();
		
		$legalAdr =  $getAddressesResponse->addresses->offsetGet(0);
		$legalAdrArr = $legalAdr->getPropertiesAsArray();
		unset($legalAdrArr["address"]["type"]);
		$createOrderArr = array(
				"orderNumber"=>TestHelper::getRandomOrderNumber(),
				"currencyCode" =>"SEK",
				"totalAmount" => 125,
				"customer" => array(
					"customerId" => "123",
					"governmentId" => localConfig("customerGovernmentId"),
					"emailAddress" => localConfig("customerEmail"),
					"name" => $legalAdrArr["name"]
					
				),
				"billTo" => $legalAdrArr,
				"shipTo" => $legalAdrArr,
				"lineItems" => array(
						array(
								"id" => TestHelper::getRandomOrderNumber(),
								"articleNumber" => TestHelper::getRandomNumber(),
								"name" => "Foo",
								"description"=>"Fii",
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
								"description"=>"Fii2",
								"quantity" => 1,
								"unitMeasure" =>"st.",
								"unitAmountExcludingTax" => 50,
								"taxPercent" => 25,
								"totalLineTaxAmount" =>round(1*50*(25/100),2),
								"totalLineAmount" => 62.50,
								
						)
				)		
			);
		$createOrderRequest = RequestCreateOrder::factory($createOrderArr);
		
		$mockOrderId = TestHelper::getRandomOrderId();
		
		$mockHttp = new HttpMock(create_function('','return TestHelper::factoryHttpEventWithSuccess(\'SUCCESS_CREATE_ORDER\',\''.$mockOrderId.'\');'));
		//$mockHttp = new HttpImpl();
		$createOrderRequest->setHttp($mockHttp);
		$createOrderResponse = $createOrderRequest->request();
		
		
		$mockHttp = new HttpMock(create_function('','return TestHelper::factoryHttpEventWithSuccess("SUCCESS_AUTHORIZE_INVOICE_PAYMENT","");'));
		
		$authorizeInvoicePaymentRequest = RequestAuthorizeInvoicePayment::factory(array(
				"orderId"=>$createOrderResponse->orderId,
				"totalAmount"=>"125.00",
				"paymentChannelId"=>PaymentChannel::WEB,
				"paymentMethodId"=>PaymentMethod::PAYNOVA_INVOICE,
				"paymentMethodProductId"=>"DirectInvoice"
		));
		$authorizeInvoicePaymentRequest->setHttp($mockHttp);
		$authorizeInvoicePaymentResponse = $authorizeInvoicePaymentRequest->request();
		
		
		$this->assertEquals( $authorizeInvoicePaymentResponse->status()->isSuccess, 1);
		$this->assertTrue( $authorizeInvoicePaymentResponse->status()->errors()->size()==0 );
		$this->assertNotEmpty($authorizeInvoicePaymentResponse->orderId());
	}
	
	
}