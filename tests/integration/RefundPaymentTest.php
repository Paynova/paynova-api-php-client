<?php
require_once __DIR__."/../TestHelper.php";

use Paynova\request\RequestRefundPayment;

class RefundPaymentTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * With this test we can only assert that the request-response works
	 * We can not validate that the refund request will succed since
	 * refund can only be made up to the amount of the finalized sum
	 */
	public function test_RefundPaymentRequestResponse() {
		//TestHelper::setSandboxCredentials();
		$mockOrderId = TestHelper::getRandomOrderId();
		$mockTransactionId = TestHelper::getRandomTransactionId();
		$mockAmount = 100.00;
		$request = RequestRefundPayment::factory(array(
				"orderId"=>$mockOrderId,
				"transactionId"=>$mockTransactionId,
				"totalAmount"=>$mockAmount
		));
		$mockHttp = new HttpMock(create_function('','return TestHelper::factoryHttpEventWithSuccess("SUCCESS_REFUND_PAYMENT","'.$mockAmount.'","'.$mockTransactionId.'");'));
		$request->setHttp($mockHttp);
		
		$response = $request->request();
		
		$this->assertInstanceOf("Paynova\\response\\ResponseRefundPayment",$response);
		
		$this->assertInstanceOf("Paynova\\response\\model\\Status",$response->status());
		
		$this->assertNotEmpty($response->status->statusKey());
	}
}