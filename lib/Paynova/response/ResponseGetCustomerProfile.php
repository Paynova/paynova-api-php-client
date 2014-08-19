<?php
namespace Paynova\response;
/**
 *
 * service: GetCustomerProfile
 * type: 	response
 *
 * This class will be used in response to RequestGetCustomerProfile
 * Hold only read-properties
 *
 * @package Paynova/response
 * @copyright Paynova 2014
 */
class ResponseGetCustomerProfile extends Response {
	
	/**
	 * @see response/Response::__construct()
	 */
	public function __construct() {
		parent::__construct(array(
			"profileId",
			"profileCards"=>"Paynova\\response\\model\\ProfileCardDetailsCollection"
		));
	}
	
	/**
	 * profileId getter
	 * Your unique identifier for the customer's profile.
	 * @return string profileId
	 */
	public function profileId() {  return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * profileCards getter
	 * Details about any profile cards stored within the customer profile will be returned here.
	 * @return ProfileCardDetailsCollection
	 */
	public function profileCards() {  return $this->setOrGet(__FUNCTION__,null); }
}