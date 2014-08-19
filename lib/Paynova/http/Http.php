<?php
namespace Paynova\http;
/**
 * interface Http
 *
 * Known implementing classes http/HttpImpl
 *
 * @package Paynova/http
 * @copyright Paynova 2014
 */
interface Http {
	
	/**
	 * Do a REST DELETE request
	 *
	 * @throws PaynovaExceptionHttp if exception occured when contacting server
	 * @throws PaynovaExceptionConfig
	 * @param string $restPath the api rest path
	 * @param HttpConfig $httpConfig (optional)
	 * @return HttpEvent
	 */
	public function delete($restPath, HttpConfig $httpConfig = null);
	
	/**
	 * Do a REST GET request
	 *
	 * @throws PaynovaExceptionHttp if exception occured when contacting server
	 * @throws PaynovaExceptionConfig
	 * @param string $restPath the api rest path
	 * @param HttpConfig $httpConfig (optional)
	 * @return HttpEvent
	 */
	public function get($restPath, HttpConfig $httpConfig = null);
	
	/**
	 * Do a POST request
	 *
	 * @throws PaynovaExceptionHttp if exception occured when contacting server
	 * @throws PaynovaExceptionConfig
	 * @param string $restPath the api rest path
	 * @param array $params of properties to send
	 * @param HttpConfig $httpConfig (optional)
	 * @return HttpEvent
	 */
	public function post($restPath, $params, HttpConfig $httpConfig = null);
}