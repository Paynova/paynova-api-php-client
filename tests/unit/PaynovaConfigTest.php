<?php
require_once __DIR__."/../TestHelper.php";

use Paynova\PaynovaConfig;

class PaynovaConfigTest extends PHPUnit_Framework_TestCase {
	
	
	public function test_username() {
		PaynovaConfig::username("foo");
		$this->assertEquals(PaynovaConfig::username(),"foo");
	}
	public function test_password() {
		PaynovaConfig::password("foo");
		$this->assertEquals(PaynovaConfig::password(),"foo");
	}
	
	public function test_endpoint() {
		PaynovaConfig::endpoint("http://www.validurl.com");
		$this->assertEquals(PaynovaConfig::endpoint(),"http://www.validurl.com");
	}
	
	/**
	 * @expectedException InvalidArgumentException
     */
	public function test_badEndpointUrl(){
		PaynovaConfig::reset();
		PaynovaConfig::endpoint("foo.com");
	}
}

