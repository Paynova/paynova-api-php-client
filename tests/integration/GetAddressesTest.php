<?php
require_once __DIR__."/../TestHelper.php";

use Paynova\request\RequestGetAddresses;

class GetAddressesTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * 	Making sure that the response object is of type ResponseGetAddresses
	 */
	public function test_getAddressesResponseTypeIsCorrect() {
		TestHelper::setSandboxCredentials();
		
		$mockHttp = new HttpMock(create_function('','return TestHelper::factoryHttpEventWithSuccess("SUCCESS_GET_ADDRESSES","");'));
		
		$request = new RequestGetAddresses($mockHttp);
		
		$request->countryCode("SE")
			->governmentId(localConfig("customerGovernmentId"));
		
		$response = $request->request();
		
		$this->assertInstanceOf("Paynova\\response\\ResponseGetAddresses",$response,"The response is not of type ResponseGetAddress");
		
		$this->assertTrue($response->status->isSuccess());
	}
	
	/**
	 * 	Get addresses and assert that the response contains addresses
	 */
	public function test_getAddressesThatContainsAddresses(){
		
		TestHelper::setSandboxCredentials();
		
		$mockHttp = new HttpMock(create_function('','return TestHelper::factoryHttpEventWithSuccess("SUCCESS_GET_ADDRESSES","");'));
		
		$request = new RequestGetAddresses($mockHttp);
		
		$request->countryCode("SE")
		->governmentId(localConfig("customerGovernmentId"));
		
		$response = $request->request();
		
		$this->assertTrue($response->addresses()->size()>0,"The response of RequestGetAddresses does not contain any addresses");
		
	}
	
	/**
	 * 	Assert false
	 */
	public function test_failGetAddressesWithNonExistingGovernmentId(){
	
		TestHelper::setSandboxCredentials();
	
		$mockHttp = new HttpMock(create_function('','return TestHelper::factoryHttpEventWithSuccess("FAIL_GET_ADDRESSES","");'));
	
		$request = new RequestGetAddresses($mockHttp);
	
		$request->countryCode("SE")
		->governmentId("99999999-9999");
	
		$response = $request->request();
		
		$this->assertFalse($response->status->isSuccess(),"The status should be not SUCCESS but was success");
		
		$errors = $response->status()->errors()->getObjectsAsArray();
		
		$this->assertEquals($errors[0]->errorCode,"GovernmentIdIsInvalid","The GovernmentId was not invalid");
	}
}