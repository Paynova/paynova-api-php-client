<?php
namespace Paynova\request;

use Paynova\http\HttpConfig;

/**
 * service: 	RemoveCustomerProfileCard
 * type: 		request
 * 
 * The Remove Customer Profile Card service is used to remove a stored card from a customer profile.
 * 
 * @package Paynova/request
 * @copyright Paynova 2014
 *
 */
class RequestRemoveCustomerProfileCard extends Request {
	
	/**
	 * See request/Request::__construct()
	 */
	public function __construct($http = null) {
		parent::__construct(array(
				"profileId","cardId"
			),
			array(
					"profileId","cardId"
			),
			"customerprofiles/{profileId}/cards/{cardId}",
			$http
		);
	}
	
	/**
	 * Do the RemoveCustomerProfileCard  API request - ReponseRemoveCustomerProfileCard is returned
	 * 
	 * @throws PaynovaExceptionRequiredPropertyMissing
	 * @throws PaynovaExceptionHttp if exception occured when contacting server
	 * @throws PaynovaExceptionConfig
	 * @param HttpConfig $httpConfig (optional)
	 * @return ReponseRemoveCustomerProfileCard
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
	
	/**
	 * cardId setter/getter
	 * Paynova's GUID identifier for the card associated with the customer profile.
	 * @param string $value (optional) used when setting
	 * @return RequestRemoveCustomerProfile or string cardId
	 */
	public function cardId($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }
	
}