<?php
require_once __DIR__."/../../TestHelper.php";

use Paynova\response\ResponseRefundPayment;

class ResponseRefundPaymentTest extends PHPUnit_Framework_TestCase {
	
	public function test_factoryByHttpEvent() {
		$httpEvent = TestHelper::factoryHttpEventWithSuccess("SUCCESS_REFUND_PAYMENT",100.00,TestHelper::getRandomTransactionId());
		
		$response = ResponseRefundPayment::factoryByHttpEvent($httpEvent);
		
		$this->assertInstanceOf("Paynova\\response\\ResponseRefundPayment",$response);
		return $response;
	}

	/**
	 * @depends test_factoryByHttpEvent
	 */
	public function test_status(ResponseRefundPayment $response) {
		$this->assertInstanceOf("Paynova\\response\\model\\Status",$response->status());
	}
	
	/**
	 * @depends test_factoryByHttpEvent
	 */
	public function test_totalAmountRefunded(ResponseRefundPayment $response) {
		$this->assertEquals($response->totalAmountRefunded(),100.00);
	}
	
	
}