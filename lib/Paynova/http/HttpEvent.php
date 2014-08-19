<?php
namespace Paynova\http;

use Paynova\model\Instance;
/**
 * class HttpEvent is the result of a HTTP call
 * Information found here is 
 * - http status code
 * - request header/body 
 * - response header/body
 *
 *
 * @package Paynova/http
 * @copyright Paynova 2014
 */
class HttpEvent extends Instance {
	
	/**
	 * Constructor declares the properties that belong to this class
	 */
	public function __construct() {
		parent::__construct(array(
			"code",
			"responseHeader","responseBody",
			"requestHeader", "requestBody" 	
		));
		
	}
	
	/**
	 * Get the code of this HTTP event
	 * @return string $code
	 */
	public function code() { return $this->setOrGet(__FUNCTION__,null); }
	
	
	/**
	 * Get the responseHeader of this HTTP event
	 * @return string $responseHeader
	 */
	public function responseHeader() { return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * Get the responseBody of this HTTP event
	 * @return string $responseBody
	 */
	public function responseBody() { return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * Get the requestHeader that caused this HTTP event
	 * @param string $value
	 * @return string $requestHeader
	 */
	public function requestHeader() { return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * Get the requestBody of this HTTP event
	 * @return string $requestBody
	 */
	public function requestBody() { return $this->setOrGet(__FUNCTION__,null); }
	
}