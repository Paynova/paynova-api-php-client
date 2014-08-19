<?php
namespace Paynova\response\model;

use Paynova\model\Instance;

/**
 * class Error
 * part of service: 	See response/model/ErrorCollection
 *
 * A class that holds read-only properties
 *
 * @package Paynova/response/model
 * @copyright Paynova 2014
 *
 */
class Error extends Instance {
	
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct(array(
			"errorCode","fieldName", "message"
		));
	}
	
	/**
	 * errorCode getter
	 * A short textual representation of the type of error incurred. 
	 * For example, "NotNull", "GreaterThan", etc.
	 * @return string errorCode
	 */
	public function errorCode() {  return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * fieldName getter
	 * The name of the field/property for which the validation error was incurred.
	 * @return string fieldName
	 */
	public function fieldName() {  return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * message getter
	 * A detailed description of the validation error.
	 * @return string message
	 */
	public function message() {  return $this->setOrGet(__FUNCTION__,null); }
}