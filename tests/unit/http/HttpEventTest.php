<?php
require_once __DIR__."/../../TestHelper.php";

use Paynova\http\HttpEvent;

class HttpEventTest extends PHPUnit_Framework_TestCase {
	
	public function test_factory() {
		$properties = array(
				"code"		=>	"foo code",
				"requestHeader"		=>	"foo requestHeaders",		"requestBody"	=>	"foo requestBody",
				"responseHeader"	=>	"foo responseHeaders",		"responseBody"	=>	"foo responseBody"
		);
		$object = HttpEvent::factory($properties);
		$this->assertEquals($properties["code"], $object->code());
		$this->assertEquals($properties["responseBody"], $object->responseBody());
	}
} 