<?php
require_once __DIR__."/../../TestHelper.php";

class HttpEventTest extends PHPUnit_Framework_TestCase {
	
	public function test_factory() {
		$properties = array(
				"code"		=>	"foo code",
				"requestHeader"		=>	"foo requestHeaders",		"requestBody"	=>	"foo requestBody",
				"responseHeader"	=>	"foo responseHeaders",		"responseBody"	=>	"foo responseBody"
		);
		$object = HttpEvent::factory($properties);
	}
} 