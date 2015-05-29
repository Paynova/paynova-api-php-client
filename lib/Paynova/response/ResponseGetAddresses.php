<?php
namespace Paynova\response;
/**
 *
 * service: 	CreateOrder
 * type: 		response
 *
 * An object of this class will be created by RequestGetAddresses from the API REST call response
 * Hold only read-properties
 *
 * @package Paynova/request
 * @copyright Paynova 2015
 *
 */
class ResponseGetAddresses extends Response {

	/**
	 * @see response/Response::__construct()
	 */
	public function __construct() {
		parent::__construct(array(
			"governmentId","countryCode",
			"addresses"=>"Paynova\\response\\model\\NameAddressCollection"
				
		));
	}

	/**
	 * governmentId getter
	 * The government id sent it with the request
	 * @return string governmentId
	 */
	public function governmentId() {  return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * The two character code for the country getter
	 * According to standard ISO 3166-1 alpha-2
	 * @return string countryCode
	 */
	public function countryCode() {  return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * addresses getter that hold a NameAddressCollection with all addresses connected to the person with governmentId
	 * @return Paynova\response\model\NameAddressCollection
	 */
	public function addresses() {  return $this->setOrGet(__FUNCTION__,null); }
}