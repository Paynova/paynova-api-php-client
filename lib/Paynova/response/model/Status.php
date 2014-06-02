<?php
/**
 * class Status
 * part of service: 	All API service calls (responses)
 *
 * A class that holds read-only properties
 * An object of this holds status information about the REST request call
 *
 * @package Paynova/response/model
 * @copyright Paynova 2014
 *
 */
class Status extends Instance {
	
	public function __construct() {
		parent::__construct(array(
			"isSuccess","errorNumber","statusKey",
			"statusMessage",
			"errors"=>"ErrorCollection",
			"exceptionDetails"
				
		));
		
	}
	
	/**
	 * isSuccess getter
	 * Indicates whether or not the operation was successful.
	 * @return string isSuccess
	 */
	public function isSuccess() {  return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * errorNumber getter
	 * A numeric identifier indicating the operation's status. For successful operations, 
	 * this value will always be 0 (zero). 
	 * @return string errorNumber
	 */
	public function errorNumber() {  return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * statusKey getter
	 * A short textual representation of the operation's status. For successful operations, 
	 * this value will always be "SUCCESS".
	 * @return string statusKey
	 */
	public function statusKey() {  return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * statusMessage getter
	 * A detailed description of the operation's status.
	 * @return string statusMessage
	 */
	public function statusMessage() {  return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * errors getter
	 * If any validation errors occurred, this collection will contain detailed information 
	 * about the error(s).
	 * @return ErrorCollection
	 */
	public function errors() { return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * exceptionDetails getter
	 * Exeption information
	 * @return string exceptionDetails
	 */
	public function exceptionDetails() {  return $this->setOrGet(__FUNCTION__,null); }
}