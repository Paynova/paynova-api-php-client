<?php
/**
 *
 * class ResponseFactory is used to create an Response object
 *
 *
 * @package Paynova/request
 * @copyright Paynova 2014
 *
 */
class ResponseFactory {
	
	/**
	 * Creates a Response object. If $httpEventRequestCreator is RequestCreateOrder
	 * then a ResponseCreateOrder is returned. $httpEvent holds the actual Response
	 * @param HttpEvent $httpEvent
	 * @param string $httpEventRequestCreator the classname of the Request causing the 
	 * @return Response
	 */
	public static function createResponse(HttpEvent $httpEvent, $httpEventRequestCreator) {
		
		$responseClass = self::_getResponseClass($httpEventRequestCreator);
		
		$responseObject = $responseClass::factoryByHttpEvent($httpEvent);
		
		return $responseObject;
	}
	
	/**
	 * Get the corrensponding Response subclass to the Request
	 * @param string $requestClassName name of the Request subclass
	 */
	private static function _getResponseClass($httpEventRequestCreator) {
		return str_replace("Request","Response",$httpEventRequestCreator);
	}
	
}