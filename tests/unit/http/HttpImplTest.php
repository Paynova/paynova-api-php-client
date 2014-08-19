<?php
require_once __DIR__."/../../TestHelper.php";

use Paynova\http\HttpConfig;
use Paynova\http\HttpEvent;
use Paynova\exception\PaynovaExceptionHttp;

class HttpImplTest extends PHPUnit_Framework_TestCase {
	/**
	 * @expectedException Paynova\exception\PaynovaExceptionHttp
	 */
	public function test_get_throwPaynovaExceptionBadURL() {
		TestHelper::setSandboxCredentials();
		$config = HttpConfig::getDefaultConfig();
		$config->set_CURLOPT(CURLOPT_TIMEOUT, 5);
		$config->set_CURLOPT(CURLOPT_URL, "http://www.foo.com");
		$httpMock = new HttpMock(create_function('','throw new Paynova\exception\PaynovaExceptionHttp("Bad url",new Paynova\http\HttpEvent());'));
		
		$httpEvent = $httpMock->get("/customerprofiles/fooprofile-123",$config);
		
		
	}
	
	/**
	 * @expectedException Paynova\exception\PaynovaExceptionHttp
	 */
	public function test_get_throwPaynovaExceptionBadRestPath() {
		TestHelper::setSandboxCredentials();
		$config = HttpConfig::getDefaultConfig();
		$config->set_CURLOPT(CURLOPT_TIMEOUT, 5);
		$httpMock = new HttpMock(create_function('','throw new Paynova\exception\PaynovaExceptionHttp("Bad Rest path",new Paynova\http\HttpEvent());'));
		$httpEvent = $httpMock->get("/customerprofiles/123/badrestpath",$config);
		
	}
	
	public function test_get_success() {
		//TestHelper::setSandboxCredentials();
		$httpMock = new HttpMock(create_function('','return TestHelper::factoryHttpEventWithSuccess("SUCCESS_GET_CUSTOMER_PROFILE","fooprofile-123");'));
		$httpEvent = $httpMock->get("/customerprofiles/fooprofile-123");
		$this->assertInstanceOf("Paynova\http\HttpEvent",$httpEvent);
	}
	
	public function test_post_success() {
		//TestHelper::setSandboxCredentials();
		$mockOrderId = TestHelper::getRandomOrderId();
		$httpMock = new HttpMock(create_function('','return TestHelper::factoryHttpEventWithSuccess("SUCCESS_CREATE_ORDER","'.$mockOrderId.'");'));
		
		$config = HttpConfig::getDefaultConfig();
		$httpEvent = null;
		
		$httpEvent = $httpMock->post("/orders/create/1234/100.00/SEK",array(
			"orderId"=>"1234",
			"totalAmount"=>100.00,
			"currencyCode" => "SEK"
				
		),$config);
		
		$this->assertInstanceOf("Paynova\http\HttpEvent",$httpEvent);
	}
	
	public function test_delete_success() {
		//TestHelper::setSandboxCredentials();
		$httpMock = new HttpMock(create_function('','return TestHelper::factoryHttpEventWithSuccess("SUCCESS_GET_CUSTOMER_PROFILE","fooprofile-123");'));
		$httpEvent = $httpMock->delete("/customerprofiles/fooprofile-123");
		$this->assertInstanceOf("Paynova\http\HttpEvent",$httpEvent);
	}
	
	
}