<?php
/**
 * service: 	RemoveCustomerProfile
 * type: 		request
 * 
 * The Remove Customer Profile service is used to remove a customer profile and all related data.
 * 
 * @package Paynova/request
 * @copyright Paynova 2014
 *
 */
class RequestRemoveCustomerProfile extends Request {
	
	/**
	 * See request/Request::__construct()
	 */
	public function __construct($http = null) {
		parent::__construct(array(
				"profileId"
			),
			array(
					"profileId"
			),
			"customerprofiles/{profileId}",
			$http
		);
	}
	
	/**
	 * Do the RemoveCustomerProfile  API request - ReponseRemoveCustomerProfile is returned
	 * 
	 * @throws PaynovaExceptionRequiredPropertyMissing
	 * @throws PaynovaExceptionHttp if exception occured when contacting server
	 * @throws PaynovaExceptionConfig
	 * @param HttpConfig $httpConfig (optional)
	 * @return ReponseRemoveCustomerProfile
	 */
	public function request(HttpConfig $httpConfig = null) {
		return parent::doRequest("DELETE",$httpConfig);
	}

	/**
	 * profileId setter/getter
	 * Your id for the customer profile to remove.
	 * @param string $value (optional) used when setting
	 * @return RequestRemoveCustomerProfile or string profileId
	 */
	public function profileId($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
}