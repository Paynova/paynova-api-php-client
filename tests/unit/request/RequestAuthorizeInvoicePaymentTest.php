<?php
require_once __DIR__."/../../TestHelper.php";

use Paynova\request\RequestAuthorizeInvoicePayment;
use Paynova\request\model\PaymentChannel;
use Paynova\request\model\PaymentAuthorizeType;
use Paynova\request\model\PaymentMethod;

class RequestAuthorizeInvoicePaymentTest extends PHPUnit_Framework_TestCase
{
	
	/**
	 * Test that all properties has its getter/setter
	 */
	public function test_propertiesAgainstSignature(){
		$object = new RequestAuthorizeInvoicePayment();
		$specialArgumentFunction = create_function('$method,$param','return $method=="paymentChannelId"?'.Paynova\request\model\PaymentChannel::WEB.':$param;');
		TestHelper::assert_modelSignature($this,$object,$specialArgumentFunction);
	}
	
	/**
	 *	Test that the properties exist
	 */
	public function testPropertiesExists() {
		$request = new RequestAuthorizeInvoicePayment();
		
		$properties = $request->getPropertiesAsArray(false);
		
		
		$this->assertArrayHasKey("orderId",$properties,"RequestAuthorizeInvoicePayment does not have property orderId");
		
		$this->assertArrayHasKey("paymentChannelId",$properties,"RequestAuthorizeInvoicePayment does not have property paymentChannelId");
		
		$this->assertArrayHasKey("totalAmount",$properties,"RequestAuthorizeInvoicePayment does not have property totalAmount");
		
		$this->assertArrayHasKey("authorizationType",$properties,"RequestAuthorizeInvoicePayment does not have property authorizationType");
		
		$this->assertArrayHasKey("paymentMethodId",$properties,"RequestAuthorizeInvoicePayment does not have property paymentMethodId");
		
		$this->assertArrayHasKey("paymentMethodProductId",$properties,"RequestAuthorizeInvoicePayment does not have property paymentMethodProductId");
		
	}
	
	/**
	 *	Test that the rest path comes out correct
	 */
	public function testRestPathIsCorrect() {
		$request = new RequestAuthorizeInvoicePayment();
		
		$expectedPath = "orders/{orderId}/authorizePayment";
		
		$this->assertEquals($request->getRestPath(),$expectedPath,"Rest path is not ".$expectedPath);
		
	}
	
	/**
	 *	Test the factory
	 */
	public function testFactoryCreate() {
		
		$request = RequestAuthorizeInvoicePayment::factory(array(
			"orderId"=>"123-abc-XYZ",
			"totalAmount"=>"100.00",
			"paymentChannelId"=>PaymentChannel::WEB,
			/*"authorizationType"=>PaymentAuthorizeType::INVOICE_PAYMENT,*/
			"paymentMethodId"=>PaymentMethod::PAYNOVA_INVOICE,
			"paymentMethodProductId"=>"DirectInvoice"
		));
		
		try{
			$request->validateRequired();
			$this->assertTrue(true);
		}catch(PaynovaExceptionRequiredPropertyMissing $e){
			$this->assertTrue(false,"RequestGetAddresses have more required properties");
		}
	
	}

}