<?php
require_once __DIR__."/../TestHelper.php";

use Paynova\request\RequestRemoveCustomerProfile;

class RemoveCustomerProfileTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * This test asumes that a profileId has been sent along a call to InitializePayment
	 */
	public function test_successfullyRemoveCustomerProfile() {
		//TestHelper::setSandboxCredentials();
		$mockProfileId = "mock112233";
		$request = RequestRemoveCustomerProfile::factory(array(
				"profileId"=>$mockProfileId
		));
		$mockHttp = new HttpMock(create_function('','return TestHelper::factoryHttpEventWithSuccess("SUCCESS");'));
		$request->setHttp($mockHttp);
		$response = $request->request();
		
		$this->assertInstanceOf("Paynova\\response\\model\\Status",$response->status());
		
	}
}