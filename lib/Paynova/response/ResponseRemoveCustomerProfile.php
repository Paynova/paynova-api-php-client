<?php
namespace Paynova\response;
/**
 *
 * service: RemoveCustomerProfile
 * type: 	response
 *
 * This class will be used in response to RequestRemoveCustomerProfile
 * The response from the API - request Remove Customer Profile is only the
 * status object wich is inherited from the parent class Response
 *
 * @package Paynova/response
 * @copyright Paynova 2014
 */

class ResponseRemoveCustomerProfile extends Response {
	
	/**
	 * @see response/Response::__construct()
	 */
	public function __construct() {
		parent::__construct(array());
	}
}