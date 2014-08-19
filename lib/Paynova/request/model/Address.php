<?php
namespace Paynova\request\model;

use Paynova\model\Instance;

/**
 * class Address
 * part of service: 	CreateOrder
 * 
 * 
 * @package Paynova/request/model
 * @copyright Paynova 2014
 *
 */
class Address extends Instance {
	
	
	/**
	 * @see model/Instance::__construct()
	 */
	public function __construct() {
		parent::__construct(array(
			"street1","street2","street3","street4" ,
			"city","postalCode","regionCode","countryCode" 
		));
	}
	
	/**
	 * street1 setter/getter
	 * The street address, line 1.
	 * @param string $value (optional) used when setting
	 * @return Address or string street1
	 */
	public function street1($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * street2 setter/getter
	 * The street address, line 2.
	 * @param string $value (optional) used when setting
	 * @return Address or string street2
	 */
	public function street2($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * street3 setter/getter
	 * The street address, line 3.
	 * @param string $value (optional) used when setting
	 * @return Address or string street3
	 */
	public function street3($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * street4 setter/getter
	 * The street address, line 4.
	 * @param string $value (optional) used when setting
	 * @return Address or string street4
	 */
	public function street4($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * city setter/getter
	 * The city.
	 * @param string $value (optional) used when setting
	 * @return Address or string city
	 */
	public function city($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * postalCode setter/getter
	 * The postal/zip code.
	 * @param string $value (optional) used when setting
	 * @return Address or string postalCode
	 */
	public function postalCode($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
/**
	 * regionCode setter/getter
	 * The region code/state code.
	 * @param string $value (optional) used when setting
	 * @return Address or string regionCode
	 */
	public function regionCode($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * countryCode setter/getter
	 * The country code. This may be the two-letter (alpha-2), three-letter (alpha-3) code or 
	 * the ISO country number as per ISO 3166-1.
	 * @param string $value (optional) used when setting
	 * @return Address or string countryCode
	 */
	public function countryCode($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	
	
}