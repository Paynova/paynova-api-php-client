<?php
/**
 * class PaynovaExceptionHttp
 * @package Paynova/exception
 * @copyright Paynova 2014
 *
 */
class PaynovaExceptionHttp extends PaynovaException {
	
	/**
	 * @var HttpEvent
	 */
	private $_httpEvent;
	
	/**
	 * Sets exception message and sets the HttpEvent that contains information about what caused this exception
	 * @param string $message
	 * @param HttpEvent $httpEvent
	 */
	public function __construct($message,HttpEvent $httpEvent) {
		parent::__construct($message);
		$this->_httpEvent = $httpEvent;
	}
	
	/**
	 * return HttpEvent
	 */
	public function getHttpEvent() {
		return $this->_httpEvent;
	}
}