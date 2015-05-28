<?php
require_once __DIR__."/../../TestHelper.php";

use Paynova\model\Address;
use Paynova\request\model\TravelSegmentAir;
use Paynova\request\model\TravelSegmentRail;
use Paynova\util\Util;


class UtilTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_validateObjectFail() {
		$address = new Address();
		Util::validateObject($address, "Paynova\\request\\model\\Customer");
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_validateArrayOfObjectsFail() {
		$arr = array(new Address(), new Address());
		Util::validateArrayOfObjects($arr,"Paynova\\request\\model\\Customer");
	}
	
	
	public function test_getSubclasses() {
		$subclasses = Util::getSubclasses("Paynova\\model\\Instance");
		$this->assertTrue(count($subclasses)>0);
	}
	
	
	public function test_classIsAbstract() {
		$this->assertTrue(Util::classIsAbstract("Paynova\\request\\model\\TravelSegment"));
	}
	
	
	public function test_verify_REDIRECT_DIGEST() {
		$vars = "ORDER_ID: 13bda5ab-c78d-4ebf-a78d-a33a00baf847
SESSION_ID: a42b58b8-386b-4ff7-ac9e-a33a00bafe98
ORDER_NUMBER: API-A4F6A165-20140529131838
SESSION_STATUS: Completed
SESSION_STATUS_ID: 1
CUSTOM_DATA_COUNT: 0
CURRENCY_CODE: SEK
PAYMENT_1_STATUS: Cancelled
PAYMENT_1_STATUS_ID: 2
PAYMENT_1_TRANSACTION_ID: 201405291321004302
PAYMENT_1_AMOUNT: 100.00
PAYMENT_1_PAYMENT_METHOD_ID: 101
PAYMENT_1_PAYMENT_METHOD_NAME: Nordea
PAYMENT_1_ACQUIRER_ID: 1006
PAYMENT_1_TIMESTAMP: 2014-05-29 11:21:00Z
PAYMENT_2_STATUS: Cancelled
PAYMENT_2_STATUS_ID: 2
PAYMENT_2_TRANSACTION_ID: 201405291321121633
PAYMENT_2_AMOUNT: 100.00
PAYMENT_2_PAYMENT_METHOD_ID: 101
PAYMENT_2_PAYMENT_METHOD_NAME: Nordea
PAYMENT_2_ACQUIRER_ID: 1006
PAYMENT_2_TIMESTAMP: 2014-05-29 11:21:12Z
PAYMENT_3_STATUS: Authorized
PAYMENT_3_STATUS_ID: 4
PAYMENT_3_TRANSACTION_ID: 201405291321509104
PAYMENT_3_AMOUNT: 100.00
PAYMENT_3_PAYMENT_METHOD_ID: 1
PAYMENT_3_PAYMENT_METHOD_NAME: VISA
PAYMENT_3_ACQUIRER_ID: 1010
PAYMENT_3_ACQUIRER_REFERENCE_ID: 500108349
PAYMENT_3_CARD_FIRST_FOUR: 4111
PAYMENT_3_CARD_LAST_FOUR: 1111
PAYMENT_3_TIMESTAMP: 2014-05-29 11:21:50Z
PAYMENT_3_APPROVAL_CODE: 984123
PAYMENT_COUNT: 3
DIGEST: 7253013C0EB775E693D7AE38F5A032F7FD967E59";
		$tokens = explode("\n",trim($vars));
		$_POST = array();
		foreach($tokens as $key=>$value){
			$tok = explode(":",$value);
			$_POST[trim($tok[0])] = trim($tok[1]);
		}
		$this->assertTrue(Util::verify_POST_REDIRECT_DIGEST($_POST, "kalleanka"));
	}
	
}