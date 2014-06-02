<?php
/**
 * class Passenger
 * part of service: 	see Paynova/request/model/Ticket
 *
 *
 * @package Paynova/request/model
 * @copyright Paynova 2014
 *
 */
class Passenger extends Instance {
	
	/**
	 * @see model/Instance::__construct()
	 */
	public function __construct() {
		parent::__construct(array(
			"name"=>"Name",
			"telephone","emailAddress"
		));
	}
	
	/**
	 * name setter/getter
	 * The passenger(s) travelling on this ticket.
	 * @param string $value (optional) used when setting
	 * @return Name
	 */
	public function name($object = null) {
		if($object !=null)Util::validateObject($object, "Name");
		return $this->setOrGet(__FUNCTION__,$object);
	}
	
	/**
	 * telephone setter/getter
	 * The passenger's telephone number.
	 * The telephone number, including the national prefix. 
	 * For example, +46 8 555 55 55
	 * @param string $value (optional) used when setting
	 * @return Passenger or string telephone
	 */
	public function telephone($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * emailAddress setter/getter
	 * The passenger's e-mail address.
	 * @param string $value (optional) used when setting
	 * @return Passenger or string emailAddress
	 */
	public function emailAddress($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
}