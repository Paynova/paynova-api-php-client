<?php
namespace Paynova\request\model;

use Paynova\model\Instance;
use Paynova\util\Util;

/**
 * class Customer
 * part of service: 	CreateOrder
 * 
 * 
 * @package Paynova/request/model
 * @copyright Paynova 2014
 *
 */
class Customer extends Instance {
	
	/**
	 * @see model/Instance::__construct()
	 */
	public function __construct() {
		parent::__construct(array(
			"customerId","emailAddress", 
			"name"=> "Paynova\\model\\Name",
			"homeTelephone","workTelephone","mobileTelephone" 
		));	
	}
	
	/**
	 * customerId setter/getter
	 * Your unique identifier for the customer.
	 * @param string $value (optional) used when setting
	 * @return Customer or string customerId
	 */
	public function customerId($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * emailAddress setter/getter
	 * The customer's e-mail address.
	 * @param string $value (optional) used when setting)
	 * @return Customer or string emailAddress
	 */
	public function emailAddress($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * name setter/getter
	 * The name of the customer and/or company.
	 * @param Name $object (optional) used when setting
	 * @return Name
	 */
	public function name($object = null) { 
		if($object!=null)Util::validateObject($object, "Paynova\\model\\Name");
		return $this->setOrGet(__FUNCTION__,$object); 
	}
	
	/**
	 * homeTelephone setter/getter
	 * The customer's home telephone number including the national prefix. For example, +46 8 555 55 55
	 * @param string $value (optional) used when setting
	 * @return Customer or string homeTelephone
	 */
	public function homeTelephone($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * workTelephone setter/getter
	 * The customer's work telephone number including the national prefix. For example, +46 8 555 55 55
	 * @param string $value (optional) used when setting
	 * @return Customer or string workTelephone
	 */
	public function workTelephone($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * mobileTelephone setter/getter
	 * The customer's mobile telephone number including the national prefix. For example, +46 8 555 55 55
	 * @param string $value (optional) used when setting
	 * @return Customer or string mobileTelephone
	 */
	public function mobileTelephone($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	
}
