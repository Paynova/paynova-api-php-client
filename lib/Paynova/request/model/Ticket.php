<?php
/**
 * class Ticket
 * part of service: 	see Paynova/request/model/TicketCollection
 * 
 * 
 * @package Paynova/request/model
 * @copyright Paynova 2014
 *
 */
class Ticket extends Instance {
	
	/**
	 * @see model/Instance::__construct()
	 */
	public function __construct() {
		parent::__construct(array(
			"serviceId","ticketNumber","isRefundable",
			"isRebookable",
			"passenger"=>"Passenger"
		));
	}
	
	/**
	 * serviceId setter/getter
	 * The carrier's service id for this ticket.
	 * Validation: Length = 0-20 characters and numbers.
	 * @param string $value (optional) used when setting
	 * @return Ticket or string serviceId
	 */
	public function serviceId($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * ticketNumber setter/getter
	 * The carrier's ticket number.
	 * @param string $value (optional) used when setting
	 * @return Ticket or string ticketNumber
	 */
	public function ticketNumber($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * isRefundable setter/getter
	 * Indicates whether or not this ticket is refundable.
	 * @param boolean $bool (optional) used when setting
	 * @return Ticket or boolean isRefundable
	 */
	public function isRefundable($bool = null) { return $this->setOrGet(__FUNCTION__,$bool); }
	
	/**
	 * isRebookable setter/getter
	 * Indicates whether or not this ticket is re-bookable.
	 * @param boolean $bool (optional) used when setting
	 * @return Ticket or boolean isRebookable
	 */
	public function isRebookable($bool = null) { return $this->setOrGet(__FUNCTION__,$bool); }
	
	/**
	 * passengers setter/getter
	 * The passenge(s) travelling on this ticket.
	 * @param string $object (optional) used when setting
	 * @return Ticket or string passengers
	 */
	public function passenger($object = null) { 
		if($object != null)Util::validateObject($object, "Passenger");
		return $this->setOrGet(__FUNCTION__,$object); 
	}
	
	
}