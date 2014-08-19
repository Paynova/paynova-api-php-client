<?php
namespace Paynova\request\model;

use Paynova\model\Instance;

/*
 * 
 */
class Name extends Instance {
	
	/**
	 * @see model/Instance::__construct()
	 */
	public function __construct($useRequired = true) {
		parent::__construct(array(
			"companyName","title","firstName","middleNames", "lastName","suffix" 
		));
		
	}
	
	/**
	 * companyName setter/getter
	 * The company's name, if the purchase is being made on behalf of a company.
	 * Validation: Maximum length = 50 characters.
	 * @param string $value (optional) used when setting
	 * @return Name or string companyName
	 */
	public function companyName($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * title setter/getter
	 * The title. For example, "Mr.", "Mrs.".
	 * Validation: Maximum length = 10 characters.
	 * @param string $value (optional) used when setting
	 * @return Name or string title
	 */
	public function title($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * firstName setter/getter
	 * The first name (given name).
	 * Validation: Maximum length = 50 characters.
	 * @param string $value optional (used when getting)
	 * @return Name or string firstName
	 */
	public function firstName($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * middleNames setter/getter
	 * The middle names.
	 * Validation: Maximum length = 100 characters.
	 * @param string $value optional (used when getting)
	 * @return Name or string middleNames
	 */
	public function middleNames($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * lastName setter/getter
	 * The last name (surname).
	 * Validation: Maximum length = 50 characters.
	 * @param string $value optional (used when getting)
	 * @return Name or string lastName
	 */
	public function lastName($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * suffix setter/getter
	 * The name's suffix. For example, "Sr.", "Jr.".
	 * Validation: Maximum length = 10 characters.
	 * @param string $value optional (used when getting)
	 * @return $this or string suffix
	 */
	public function suffix($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	
}