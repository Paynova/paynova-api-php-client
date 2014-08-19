<?php
namespace Paynova\response;

use Paynova\model\Instance;
use Paynova\http\HttpEvent;
use Paynova\exception\PaynovaException;

/**
 * class Response
 * This is the base class for all Responses
 * part of service: 	All services
 *
 *
 * @package Paynova/response
 * @copyright Paynova 2014
 *
 */
abstract class Response extends Instance {
	
	/**
	 * The HttpEvent that caused this Response
	 * @var HttpEvent
	 */
	private $_httpEvent = null;
	
	
	/**
	 * Constructor purpose:
	 * 1 Initialize this Response object with the correct properties according 
	 * to the API specifications reply
	 * @param array $signature
	 */
	protected function __construct($signature){
		parent::__construct(
				array_merge(array("status"=>"Paynova\\response\\model\\Status"),$signature)
		);
	}
	
	/**
	 * status getter
	 *
	 * @return Status
	 */
	public function status() {  return $this->setOrGet(__FUNCTION__,null); }
	
	
	/**
	 * Set the HttpEvent
	 * @param HttpEvent $httpEvent
	 */
	public function setHttpEvent(HttpEvent $httpEvent) {
		$this->_httpEvent = $httpEvent;
	}
	
	/**
	 * Get the HttpEvent
	 * @return HttpEvent
	 */
	public function getHttpEvent() {
		return $this->_httpEvent;
	}
	
	/**
	 * Create an instance of a Response from a HttpEvent
	 * @param HttpEvent $httpEvent
	 * @return Response
	 */
	public static function factoryByHttpEvent(HttpEvent $httpEvent) {
		if(($jsonArray = json_decode($httpEvent->responseBody(),$assoc = true)) ===FALSE) {
			throw new PaynovaException(
				"The httpEvent->responseBody ".$httpEvent->responseBody()." is not a valid JSON object\n"
			);
		}
		$jsonArray = $jsonArray;
		$object = self::factory($jsonArray);
		$object->setHttpEvent($httpEvent);
		return $object;
	}
}