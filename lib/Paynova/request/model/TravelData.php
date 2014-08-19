<?php
namespace Paynova\request\model;

use Paynova\model\Instance;
use Paynova\util\Util;

/**
 * class TravelData 
 * part of service: 	see Paynova/request/model/LineItem 
 *
 * @package Paynova/model/request
 * @copyright Paynova 2014
 */
class TravelData extends Instance {
	
	/**
	 * @see model/Instance::__construct()
	 */
	public function __construct() {
		parent::__construct(array(
			"bookingReference",
			"travelSegments"=>"Paynova\\request\\model\\TravelSegmentCollection",
				
		));
	}
	
	/**
	 * bookingReference setter/getter
	 * The booking reference number for the entire booking.
	 * @param string $value (optional) used when setting
	 * @return TravelData or string bookingReference
	 */
	public function bookingReference($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * travelSegments setter/getter
	 * The travel segments which are included in this booking.
	 * @param TravelSegmentCollection $object (optional) used when setting
	 * @return TravelSegmentCollection
	 */
	public function travelSegments($object = null) { 
		if($object != null)Util::validateObject($object,"TravelSegmentCollection");
		return $this->setOrGet(__FUNCTION__,$object); 
	}
}