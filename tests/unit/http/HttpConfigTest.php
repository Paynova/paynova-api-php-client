<?php
require_once __DIR__."/../../TestHelper.php";

class HttpConfigTest extends PHPUnit_Framework_TestCase {
	

	public function test_construct() {
		$config = new HttpConfig($url = "http://www.foo.com", $method = "POST");
		
		$this->assertEquals($config->get_CURLOPT(CURLOPT_HEADER), true);
		
		$this->assertEquals($config->get_CURLOPT(CURLINFO_HEADER_OUT), true);
		
		$this->assertEquals($config->get_CURLOPT(CURLOPT_RETURNTRANSFER), true);
		
		$this->assertEquals($config->get_CURLOPT(CURLOPT_TIMEOUT), 30);
		
		$this->assertEquals($config->get_CURLOPT(CURLOPT_URL), "http://www.foo.com");
	}
	
	public function test_getDefaultConfig() {
		TestHelper::setSandboxCredentials();
		
		$config = HttpConfig::getDefaultConfig();
		
		$this->assertEquals($config->get_CURLOPT(CURLOPT_HEADER), true);
		
		$this->assertEquals($config->get_CURLOPT(CURLINFO_HEADER_OUT), true);
		
		$this->assertEquals($config->get_CURLOPT(CURLOPT_RETURNTRANSFER), true);
		
		$this->assertEquals($config->get_CURLOPT(CURLOPT_TIMEOUT), 30);
		
		$this->assertNotEmpty($config->get_CURLOPT(CURLOPT_HTTPHEADER));
	}
	
	/**
	 * @runInSeparateProcess
	 * @expectedException PaynovaExceptionConfig
	 */
	public function test_getDefaultConfigWithoutSettingCredentials() {
		
		//TestHelper::resetSandboxCredentials();
		$this->setPreserveGlobalState(false);
		$config = HttpConfig::getDefaultConfig();
	}
	
	public function test_set_and_get_CURLOPT() {
		TestHelper::setSandboxCredentials();
		$config = HttpConfig::getDefaultConfig();
		$config->set_CURLOPT(CURLOPT_TIMEOUT, 60);
		$this->assertEquals($config->get_CURLOPT(CURLOPT_TIMEOUT),60);
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_unset_CURLOPT() {
		TestHelper::setSandboxCredentials();
		$config = HttpConfig::getDefaultConfig();
		$config->set_CURLOPT(CURLOPT_TIMEOUT, 60);
		$config->unset_CURLOPT(CURLOPT_TIMEOUT);
		$this->assertEmpty($config->get_CURLOPT(CURLOPT_TIMEOUT));
	}
	
	public function test_getCurlOptionsAsArray() {
		TestHelper::setSandboxCredentials();
		$config = HttpConfig::getDefaultConfig();
		$this->assertTrue(is_array($config->getCurlOptionsAsArray()));
	} 
	
	public function test_setCurlOptionsArray() {
		$config = new HttpConfig("http://www.foo.com");
		$options = array(
				CURLOPT_HEADER 			=> true,
				CURLINFO_HEADER_OUT		=> true,
				CURLOPT_RETURNTRANSFER	=> true,
				CURLOPT_TIMEOUT			=> 30,
				CURLOPT_HTTPHEADER		=>	array()
		);
		$config->setCurlOptionsArray($options);
		$this->assertEquals($config->getCurlOptionsAsArray(),$options);
	}
}