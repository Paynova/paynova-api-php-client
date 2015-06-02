<?php
require_once __DIR__."/../../../TestHelper.php";

use Paynova\response\model\PaymentMethodDetailCollection;

class PaymentMethodDetailCollectionTest extends PHPUnit_Framework_TestCase {

	private $_fake = array(
			array(
				"paymentMethodId"=>1,
				"paymentMethodProductId"=>null,
				"displayName"=>"VISA",
				"group"=>array("key"=>"card","displayName"=>"Kredit-/betalkort"),
				"interestRate"=>null,
				"notificationFee"=>null,
				"setupFee"=>null,
				"numberOfInstallments"=>null,
				"installmentPeriod"=>null,
				"installmentUnit"=>null,
				"legalDocuments"=>null,
				"addressTypeRestrictions"=>array()
	
			),
			array(
				"paymentMethodId" => 311,
				"paymentMethodProductId" => "InstallmentsThreeMonths",
				"displayName" => "Delbetalning 3 månader",
				"group" => array(
						"key" => "installment",
						"displayName" => "Part-Payment"
				),
				"interestRate" => array(
						"label" => "Annuity",
						"symbol" => "%",
						"value" => 10.00
				),
				"notificationFee" => array(
						"label" => "Aviavgift",
						"symbol" => "kr",
						"value" => 29.00
				),
				"setupFee" => array(
						"label" => "Uppläggningsavgift",
						"symbol" => "kr",
						"value" => 95.00
				),
				
				"numberOfInstallments" => 3,
				"installmentPeriod" => 1,
				"installmentUnit" => "month",
				"legalDocuments" => array(
						"0" => array(
								"label" => "Avtalsvilkor 3 månader delbetalning",
								"uri" => "http://www.paynova.com"
						)
				
				),
				"addressTypeRestrictions" => array(
						"0" => "legal"
				)
				
			)
		);

	
	
	public function test_factory(){
		$collection = PaymentMethodDetailCollection::factory($this->_fake);
		
		$this->assertInstanceOf("Paynova\\response\\model\\PaymentMethodDetailCollection",$collection);

	}
	
	public function test_assertThatValuesExists(){
		$collection = PaymentMethodDetailCollection::factory($this->_fake);
		
		$detail = $collection->offsetGet(1);
		
		$this->assertEquals($detail->group()->key(),"installment");
		
		$this->assertEquals($detail->setupFee()->symbol(),"kr");
		
		$restriction = $detail->addressTypeRestrictions();
		$restriction = $restriction[0];
		$this->assertEquals($restriction,"legal");
		
		$document = $detail->legalDocuments()->offsetGet(0); 
		$this->assertEquals($document->uri,"http://www.paynova.com");
	}
	
}