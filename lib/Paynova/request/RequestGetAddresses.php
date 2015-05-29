<?php
namespace Paynova\request;

use Paynova\http\HttpConfig;
use Paynova\util\Util;

/**
 * service: 	GetAddresses
 * type: 		request
 *
 * The Get Address service is used get known addresses for a person.
 *
 * @package Paynova/request
 * @copyright Paynova 2015
 *
 */
class RequestGetAddresses extends Request {

	/**
	 * See request/Request::__construct()
	 */
	public function __construct($http = null) {
		parent::__construct(array(
						"countryCode","governmentId"
				),
				array(
						"countryCode","governmentId"
				),
				"addresses/{countryCode}/{governmentId}"
				,$http
		);
	}

	/**
	 * Do the GetAddresses API request - ReponseGetAddresses is returned
	 *
	 * @throws PaynovaExceptionRequiredPropertyMissing
	 * @throws PaynovaExceptionHttp if exception occured when contacting server
	 * @throws PaynovaExceptionConfig
	 * @param HttpConfig $httpConfig (optional)
	 * @return ReponseGetAddresses
	 */
	public function request(HttpConfig $httpConfig = null) {
		return parent::doRequest("GET",$httpConfig);
	}

	/**
	 * The two character code for the country setter/getter
	 * According to standard ISO 3166-1 alpha-2
	 * @param string $value (optional) used when setting
	 * @return RequestGetAddresses or string countryId
	 */
	public function countryCode($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }

	/**
	 * The government id for the person setter/getter
	 * Get addresses connected to person with the government id.
	 * @param string $value (optional) used when setting
	 * @return RequestGetAddresses or string governmentId
	 */
	public function governmentId($value = null) {  return $this->setOrGet(__FUNCTION__,$value); }

}
