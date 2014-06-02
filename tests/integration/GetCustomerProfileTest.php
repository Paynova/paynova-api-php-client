<?php
require_once __DIR__."/../TestHelper.php";
class GetCustomerProfileTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * This test asumes that a profileId has been sent along a call to InitializePayment
	 */
	public function test_successfullyGetCustomerProfile() {
		
		//TestHelper::setSandboxCredentials();
		$mockProfileId = "mycustomer123";
		$request = RequestGetCustomerProfile::factory(array(
				"profileId"=>$mockProfileId
		));
		
		$mockHttp = new HttpMock(create_function('','return TestHelper::factoryHttpEventWithSuccess("SUCCESS_GET_CUSTOMER_PROFILE","'.$mockProfileId.'");'));
		
		
		
		
		//$mockHttp = new HttpImpl();
		$request->setHttp($mockHttp);
		$response = $request->request();
		$this->assertInstanceOf("Status",$response->status());
		$this->assertInstanceOf("ProfileCardDetailsCollection",$response->profileCards());
		
	}
}