<?php
namespace Paynova\request\model;

/**
 * class TravelSegmentAir for air travel segment
 * part of service: 	see Paynova/request/model/TravelSegment
 *
 *
 * @package Paynova/request/model
 * @copyright Paynova 2014
 *
 */
class TravelSegmentAir extends TravelSegment {
	
	/**
	 * @see model/Instance::__construct()
	 */
	public function __construct() {
		parent::__construct(
				array(
					"departureAirportCode","arrivalAirportCode",
				)
		);
		$this->segmentType = TravelSegment::SEGMENT_TYPE_AIR;
	}

	/**
	 * Overriding to force segmentType to be TravelSegment:SEGMENT_TYPE_AIR;
	 */
	public function segmentType($value = null) { 
		if($value!=null) {
			$value = TravelSegment::SEGMENT_TYPE_AIR;
		}
		return $this->setOrGet(__FUNCTION__,$value); 
	}
	
	/**
	 * departureAirportCode setter/getter
	 * The IATA or ICAO airport or city code of the departure airport for this segment,
	 * in the format <authority>:<code>.
	 * For example, if you were sending the code for Arlanda airport in Stockholm, Sweden, you would send:
	 * For IATA you would send: "IATA:ARN"
	 * For ICAO you would send: "ICAO:ESSA"
	 * Note: Only applicable to and required for AIR segments.
	 * @param string $value (optional) used when setting
	 * @return TravelSegment or string departureAirportCode
	 */
	public function departureAirportCode($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * arrivalAirportCode setter/getter
	 * The IATA or ICAO airport or city code of the arrival airport for this segment, 
	 * in the format <authority>:<code>.
	 * For example, if you were sending the code for Arlanda airport in 
	 * Stockholm, Sweden, you would send:
	 * For IATA you would send: "IATA:ARN"
	 * For ICAO you would send: "ICAO:ESSA"
	 * Only applicable to and required for AIR segments.
	 * @param string $value (optional) used when setting
	 * @return TravelSegment or string arrivalAirportCode
	 */
	public function arrivalAirportCode($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
}