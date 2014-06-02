<?php
/**
 * class Request
 * This is the base class for all Requests
 * part of service: 	All services
 *
 *
 * @package Paynova/request
 * @copyright Paynova 2014
 *
 */
abstract class Request extends Instance {
	/**
	 * @var string holds the rest path
	 */
	private $_restPath = "";
	
	
	/**
	 * The http client to use
	 * @var $http 
	 */
	private $_http;
	
	/**
	 * Constructor purpose:
	 * 1 Initialize this Request object with the correct properties according 
	 * to the API specifications for making a Request
	 * 2 setting the required properties for the api-call
	 * 3 sets the API REST path
	 * @param array $signature
	 * @param array $required
	 * @param string $restPath
	 * @param Http $http (optional)
	 */
	public function __construct($signature, $required, $restPath, Http $http = null) {
		parent::__construct($signature,$required);
		
		$this->_setRestPath($restPath);
		
		if($http == null) {
			$http = new HttpImpl();
		}
		$this->setHttp($http);
	}
	
	/**
	 * Set the Http client that this Request is using to connect to the API server
	 * @throw PaynovaException if $http is null
	 * @param Http $http
	 */
	public function setHttp(Http $http) {
		if($http == null) {
			throw new PaynovaException("The Http client can not be null");
		}
		$this->_http = $http;
	}
	
	/**
	 * Set the REST path for this Request
	 * @param String $path
	 * @throws PaynovaException if trying to set wit an empty path
	 */
	private function _setRestPath($path) {
		if(empty($path)) {
			throw new PaynovaException("restPath can not be empty in a Request");
		}
		$this->_restPath = $path;
	}
	
	/**
	 * Get the REST path for this Request
	 * @return string
	 */
	public function getRestPath() {
		return $this->_restPath;
	}
	
	/**
	 * Do an API request - a subclass of Response is returned
	 *
	 * @throws PaynovaExceptionRequiredPropertyMissing
	 * @throws PaynovaExceptionHttp if exception occured when contacting server
	 * @throws PaynovaExceptionConfig
	 * @throws PaynovaException if $restMethod is not supported
	 * @param string $restMethod POST/GET/DELETE (PUT not supported by API server)
	 * @param HttpConfig $httpConfig (optional)
	 * @return Response
	 */
	protected function doRequest($restMethod, HttpConfig $httpConfig = null) {
		$httpEvent = null;
		
		$this->validateRequired();
		
		$restPath = $this->_getParsedRestPath();
		
		$requestParams = $this->getPropertiesAsArray();
		
		switch($restMethod) {
			case "POST":
				$httpEvent = $this->_http->post($restPath, $requestParams, $httpConfig);
				break;
			//case "PUT":
				//$httpEvent = Http::put($restPath, $requestParams);
				//break;
			case "GET":
				$httpEvent =  $this->_http->get($restPath, $httpConfig);
				break;
			case "DELETE":
				$httpEvent =  $this->_http->delete($restPath, $httpConfig);
				break;
			default:
				throw new PaynovaException("No such restMethod '".$restMethod."'");
		}
		
		return ResponseFactory::createResponse($httpEvent,get_called_class());
	}
	
	
	/**
	 * Parses the REST path in this Request with the stored properties
	 * @return string the parsed REST path
	 */
	private function _getParsedRestPath() {
		$path = $this->getRestPath();
		
		if(!is_array($path))$paths = array($path);
		else $paths = $path;
		$restPath = "";
		
		//Sort on character length, largest first
		usort($paths,function($a, $b){
			if (strlen($a) == strlen($b)) {
				return 0;
			}
			return (strlen($a) < strlen($b)) ? 1 : -1;
		});
		
		foreach($paths as $path) {
			
			$path = "/".trim($path,"/")."/";
			
			/*
			 * All required params is on the top level of the property array
			 */
			foreach($this->getPropertiesAsArray() as $key=>$value) {
				if(!is_object($value) && !is_array($value)) {
					$path = str_replace("{".$key."}",$value,$path);
				}
			}
			
			/*
			 * Check if the path has been completely parsed
			 */
			if(!preg_match("/\{.*?\}/",$path)) {
				$restPath = $path;
				break;
			}
		}
		return $restPath;
	}
	
	/**
	 * Do request for a Request
	 * @return Response subclass
	 */
	abstract public function request(HttpConfig $config);
}
