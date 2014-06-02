<?php
require_once __DIR__."/../TestHelper.php";

class FinalizeAuthorizationTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * With this test we can only assert that the request-response works
	 * We can not validate that the finalize request will succed since
	 * finalize can only be made up to the order amount
	 */
	public function test_finalizeAuthorizationRequestResponse() {
		//TestHelper::setSandboxCredentials();
		$mockTransactionId = TestHelper::getRandomTransactionId();
		$mockAmount = 100.00;
		$request = RequestFinalizeAuthorization::factory(array(
				"orderId"=>TestHelper::getRandomOrderId(),
				"transactionId"=>"'.$mockTransactionId.'",
				"totalAmount"=>$mockAmount
		));
		
		$mockHttp = new HttpMock(create_function('','return TestHelper::factoryHttpEventWithSuccess("SUCCESS_FINALIZE_AUTHORIZATION",'.$mockAmount.','.$mockTransactionId.');'));
		
		//$mockHttp = new HttpImpl();
		$request->setHttp($mockHttp);
		$response = $request->request();
		$this->assertInstanceOf("ResponseFinalizeAuthorization",$response);
		$this->assertInstanceOf("Status",$response->status());
		
		$this->assertNotEmpty($response->status->statusKey());
		
	}
}