<?php
require_once __DIR__."/../TestHelper.php";
class RemoveCustomerProfileCardTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * This test asumes that a that a card with cardId belongs to a profile with
	 * profileId is stored in the targeted endpoint (API server)
	 */
	public function test_successfullyRemoveCustomerProfileCard() {
		//TestHelper::setSandboxCredentials();
		$mockProfileId = "mock112233";
		$request = RequestRemoveCustomerProfileCard::factory(array(
				"profileId"=>$mockProfileId,
				"cardId"=>"49db066c-88ed-4031-ae93-a32c00afb9a6"
		));
		$mockHttp = new HttpMock(create_function('','return TestHelper::factoryHttpEventWithSuccess("SUCCESS");'));
		$request->setHttp($mockHttp);
		$response = $request->request();
		$this->assertInstanceOf("Status",$response->status());
	}
}