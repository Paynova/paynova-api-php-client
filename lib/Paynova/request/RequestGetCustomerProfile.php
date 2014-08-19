<?php
namespace Paynova\request;

use Paynova\http\HttpConfig;

/**
 * service: 	GetCustomerProfile
 * type: 		request
 * 
 * The Get Customer Profile service is used to retrieve information about a merchant customer 
 * profile stored at Paynova.
 * 
 * @package Paynova/request
 * @copyright Paynova 2014
 *
 */
class RequestGetCustomerProfile extends Request {
	
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
	 * Do the GetCustomerProfile  API request - ReponseGetCustomerProfile is returned
	 * 
	 * @throws PaynovaExceptionRequiredPropertyMissing
	 * @throws PaynovaExceptionHttp if exception occured when contacting server
	 * @throws PaynovaExceptionConfig
	 * @param HttpConfig $httpConfig (optional)
	 * @return ReponseGetCustomerProfile
	 */
	public function request(HttpConfig $httpConfig = null) {
		return parent::doRequest("GET",$httpConfig);
	}

	/**
	 * profileId setter/getter
	 * Your unique identifier for the customer profile stored at Paynova.
	 * @param string $value (optional) used when setting
	 * @return RequestGetCustomerProfile or string profileId
	 */
	public function profileId($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
}