<?php
namespace Paynova\request\model;
/**
 * class TravelSegmentRail
 * part of service: 	see Paynova/request/model/TravelSegment
 *
 *
 * @package Paynova/request/model
 * @copyright Paynova 2014
 *
 */
class TravelSegmentRail extends TravelSegment {
	
	/**
	 * @see model/Instance::__construct()
	 */
	public function __construct() {
		parent::__construct(
				array(
					"departureStationCode","arrivalStationCode"
				)
		);
		$this->segmentType = TravelSegment::SEGMENT_TYPE_RAIL;
	}

	/**
	 * Overriding to force segmentType to be TravelSegment:SEGMENT_TYPE_RAIL;
	 */
	public function segmentType($value = null) { 
		if($value!=null) {
			$value = TravelSegment::SEGMENT_TYPE_RAIL;
		}
		return $this->setOrGet(__FUNCTION__,$value); 
	}
	
	/**
	 * departureStationCode setter/getter
	 * The identifier for the rail station which this segment is departing from.
	 * Note: Only applicable to and required for RAIL segments (segmentType)
	 * @param string $value (optional) used when setting
	 * @return TravelSegment or string departureStationCode
	 */
	public function departureStationCode($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * arrivalStationCode setter/getter
	 * The identifier for the arrival rail station of this segment.
	 * Note: Only applicable to and required for RAIL segments.
	 * @param string $value (optional) used when setting
	 * @return TravelSegment or string arrivalStationCode
	 */
	public function arrivalStationCode($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
}