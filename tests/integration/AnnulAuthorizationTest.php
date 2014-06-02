<?php
require_once __DIR__."/../TestHelper.php";

class AnnulAuthorizationTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * No actual Http server call is made
	 */
	public function test_AnnulAuthorizationRequestResponse() {
		//TestHelper::setSandboxCredentials();
		
		$mockHttp = new HttpMock(create_function('','return TestHelper::factoryHttpEventWithSuccess("SUCCESS");'));
		
		
		
		$request = new RequestAnnulAuthorization($mockHttp);
		$request->orderId("ee384e22-35df-4817-8828-a32b0096787f")
				->transactionId("201405141108416605")
				->totalAmount(100.00);
		
		$response = $request->request();
		$this->assertInstanceOf("ResponseAnnulAuthorization",$response);
		
		$this->assertInstanceOf("Status",$response->status());
		
		$this->assertNotEmpty($response->status->statusKey());
		
	}
}