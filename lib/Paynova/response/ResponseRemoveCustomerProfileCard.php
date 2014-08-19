<?php
namespace Paynova\response;
/**
 *
 * service: RemoveCustomerProfile
 * type: 	response
 *
 * This class will be used in response to RequestRemoveCustomerProfileCard
 * The response from the API - request Remove Customer Profile Card is only the
 * status object wich is inherited from the parent class Response
 *
 * @package Paynova/response
 * @copyright Paynova 2014
 */

class ResponseRemoveCustomerProfileCard extends Response {
	
	/**
	 * @see response/Response::__construct()
	 */
	public function __construct() {
		parent::__construct(array());
	}
}