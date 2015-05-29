<?php
require_once __DIR__."/../../TestHelper.php";

use Paynova\request\RequestGetAddresses;

class RequestGetAddressesTest extends PHPUnit_Framework_TestCase
{
	
	/**
	 * Test that all properties has its getter/setter
	 */
	public function test_propertiesAgainstSignature(){
		$object = new RequestGetAddresses();
		TestHelper::assert_modelSignature($this,$object);
	}
	
	/**
	 *	Test that the properties exist
	 */
	public function testPropertiesExists() {
		$request = new RequestGetAddresses();
		
		$properties = $request->getPropertiesAsArray(false);
		
		$this->assertArrayHasKey("countryCode",$properties,"RequestGetAddresses does not have property countryCode");
		
		$this->assertArrayHasKey("governmentId",$properties,"RequestGetAddresses does not have property governmentId");
		
	}
	
	/**
	 *	Test that the rest path comes out correct
	 */
	public function testRestPathIsCorrect() {
		 $request = new RequestGetAddresses();
		$request->countryCode("SE");
		$request->governmentId("123456-1234");
		
		$expectedPath = "addresses/{countryCode}/{governmentId}";
		
		$this->assertEquals($request->getRestPath(),$expectedPath,"Rest path is not ".$expectedPath);
		
	}
	
	/**
	 *	Test that the rest path comes out correct
	 */
	public function testFactoryCreate() {
		$request = RequestGetAddresses::factory(array(
			"countryCode"=>"SE",
			"governmentId"=>"123456-1234"
		));
		
		try{
			$request->validateRequired();
			$this->assertTrue(true);
		}catch(PaynovaExceptionRequiredPropertyMissing $e){
			$this->assertTrue(false,"RequestGetAddresses have more required properties");
		}
	
	}

}