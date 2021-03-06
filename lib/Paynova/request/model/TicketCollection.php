<?php
namespace Paynova\request\model;

use Paynova\model\PropertyItemCollection;

/**
 * class TicketCollection can store a collection of Ticket objects
 * part of service: 	see Paynova/request/model/TravelSegment 
 *
 * @package Paynova/model/request
 * @copyright Paynova 2014
 */
class TicketCollection extends PropertyItemCollection{
	public function __construct() {
		parent::__construct("Paynova\\request\\model\\Ticket");
	}
	
	/**
	 * @see model/PropertyItemCollection::getClassnameOfTypeToStore()
	 * @return string
	 */
	public static function getClassnameOfTypeToStore() {
		return "Paynova\\request\\model\\Ticket";
	}
}