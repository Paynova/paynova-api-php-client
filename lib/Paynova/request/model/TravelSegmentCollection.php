<?php
/**
 * class TravelSegmentCollection stores objects of class TravelSegments 
 * part of service: 	see Paynova/request/model/TravelData 
 *
 * @package Paynova/model/request
 * @copyright Paynova 2014
 */
class TravelSegmentCollection extends PropertyItemCollection{
	
	/**
	 * @see util/PaynovaCollection::__construct()
	 */
	public function __construct() {
		parent::__construct(self::getClassnameOfTypeToStore());
	}
	
	/**
	 * @see model/PropertyItemCollection::getClassnameOfTypeToStore()
	 * @return string
	 */
	public static function getClassnameOfTypeToStore() {
		return "TravelSegment";
	}
	
}