<?php
namespace Paynova\request\model;

use Paynova\model\Instance;
use Paynova\util\Util;

/**
 * class TravelSegment
 * part of service: 	see Paynova/request/model/TravelSegmentCollection
 *
 *
 * @package Paynova/request/model
 * @copyright Paynova 2014
 *
 */
abstract class TravelSegment extends Instance {
	
	
	/**
	 * Segment type constants
	 * @var const
	 */
	const SEGMENT_TYPE_AIR = "AIR";
	const SEGMENT_TYPE_RAIL = "RAIL";
	
	/**
	 * @see model/Instance::__construct()
	 */
	public function __construct($signature) {
		parent::__construct(
				array_merge(
						array(
								"segmentType", "departureDate","departureTime",
								"departureCountryCode",
								"arrivalDate","arrivalTime","arrivalCountryCode",
								"carrierDesignator",
								"tickets"=>"Paynova\\request\\model\\TicketCollection"
						
						),
						$signature
				)
		);
		
	}
	
	
	/**
	 * segmentType setter/getter
	 * The means of travel. 
	 * See constants in TravelSegment::SEGMENT_TYPE_xxx for possible values
	 * @param string $value (optional) used when setting
	 * @return TravelSegment or string segmentType
	 */
	public function segmentType($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * departureDate setter/getter
	 * The scheduled departure date for this segment, in the format YYYY-MM-DD. For example, "2013-11-23".
	 * @param string $value (optional) used when setting
	 * @return TravelSegment or string departureDate
	 */
	public function departureDate($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * departureTime setter/getter
	 * The scheduled departure date for this segment, in the format YYYY-MM-DD. For example, "2013-11-23".
	 * @param string $value (optional) used when setting
	 * @return TravelSegment or string departureTime
	 */
	public function departureTime($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * departureCountryCode setter/getter
	 * The country in which the departure station/airport for this segment is in. This may be the two-letter (alpha-2), 
	 * three-letter (alpha-3) code or the ISO country number as per ISO 3166-1.
	 * @param string $value (optional) used when setting
	 * @return TravelSegment or string departureCountryCode
	 */
	public function departureCountryCode($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * arrivalDate setter/getter
	 * The scheduled arrival date for this segment, in the format YYYY-MM-DD. For example, "2013-11-23".
	 * @param string $value (optional) used when setting
	 * @return TravelSegment or string arrivalDate
	 */
	public function arrivalDate($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * arrivalTime setter/getter
	 * The scheduled arrival time for this segment, in the format HH:MM, using the 24-hour time format. For example, "19:55".
	 * @param string $value (optional) used when setting
	 * @return TravelSegment or string arrivalTime
	 */
	public function arrivalTime($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * arrivalCountryCode setter/getter
	 * The country in which the destination station/airport for this segment is in. 
	 * This may be the two-letter (alpha-2), three-letter (alpha-3) code or the ISO country number as per ISO 3166-1.
	 * @param string $value (optional) used when setting
	 * @return TravelSegment or string arrivalCountryCode
	 */
	public function arrivalCountryCode($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * carrierDesignator setter/getter
	 * The IATA or ICAO airline code, or the UIC railway code, of the carrier for this segment, in the format <authority>:<code>.
	 * Examples:
	 * (AIR Segments) If you were sending the code for Scandinavian Airlines (SAS), you would send:
	 * For IATA you would send: "IATA:SK"
	 * For ICAO, you would send: "ICAO:SAS"
	 * (RAIL Segments) If you were sending the code for Swedish Railway (SJ), you would send:
	 * For UIC you would send: "UIC:1174"
	 * @param string $value (optional) used when setting
	 * @return TravelSegment or string carrierDesignator
	 */
	public function carrierDesignator($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * tickets setter/getter
	 * The tickets which were issued for this segment of travel.
	 * @param TicketCollection $object (optional) used when setting
	 * @return TicketCollection
	 */
	public function tickets($object = null) {
		if($object != null)Util::validateObject($object, "Paynova\\request\\model\\TicketCollection"); 
		return $this->setOrGet(__FUNCTION__,$object); 
	}
	
	
}