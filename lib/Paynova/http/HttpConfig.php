<?php
namespace Paynova\http;

use Paynova\util\Version;
use Paynova\exception\PaynovaException;
use Paynova\exception\PaynovaExceptionConfig;
use Paynova\PaynovaConfig;

use \InvalidArgumentException;

/**
* class HttpConfig is a wrapper for CURLOPTions. It stores CURLOPTIONions that will be used in the
* curl connection to the API SERVER thru the Paynova class Http
* 
* All CURLOPTions that can be set with curl_setopt 
* @see http://php.net/manual/en/function.curl-setopt.php
* can be set here, with the exception of:  
* CURLOPT_CUSTOMREQUEST, 
* CURLOPT_POST, 
* CURLOPT_POSTFIELDS
* The above options will be set/overriden at send time in the Paynova class Http 
*
* @package Paynova/http
* @copyright Paynova 2014
*/
class HttpConfig  {
	
	private static $_DEFAULT_CURL_OPTIONS = array(
			CURLOPT_HEADER 			=> true,
			CURLINFO_HEADER_OUT		=> true,
			CURLOPT_RETURNTRANSFER	=> true,
			CURLOPT_TIMEOUT			=> 30,
			CURLOPT_HTTPHEADER		=>	array()
	);
	
	
	
	/**
	 * 
	 * @var array $_curloptions array to store the CURLOPT associated with this HttpConfig
	 */
	private $_curlOptions;
	
	
	/**
	 * @param string $url the URL target for the CURL call (no validation occurs)
	 */
	public function __construct($url = null) {
		$this->_curlOptions = self::$_DEFAULT_CURL_OPTIONS;
		
		if($url != null){ 
			$this->set_CURLOPT(CURLOPT_URL, $url);
		}
	}
	
	/**
	 * Returns the default HttpConfig used for calling the Paynova API server
	 * 
	 * @throws PaynovaExceptionConfig
	 * @return HttpConfig 
	 */
	public static function getDefaultConfig() {
		$config = new self();
		
		$config->set_CURLOPT(CURLOPT_HTTPHEADER, 	array(
				"Accept: application/json",
				"Content-Type: application/json",
				"User-Agent: Paynova PHP Library v".Version::get()
		));
		
		$config->set_CURLOPT(CURLOPT_USERPWD, 	PaynovaConfig::username() . ":" . PaynovaConfig::password());
		
		$config->set_CURLOPT(CURLOPT_URL, 		trim(PaynovaConfig::endpoint(),"/"));
		
		return $config;
	}
	/**
	 * Set a CURLOPT associated with this HttpConfig object
	 * All allowed CURLOPT is allowed, no validation occurs
	 * @param int $opt the CURLOPT_xx to set
	 * @param mixed $value to set
	 */
	public function set_CURLOPT($opt, $value) {
		$this->_curlOptions[$opt] = $value;
	}
	
	/**
	 * Unset a CURLOPT
	 * @param int $opt the CURLOPT to unset
	 */
	public function unset_CURLOPT($opt) {
		unset($this->_curlOptions[$opt]);
	}
	
	/**
	 * Is a CURLOPT set
	 * @param int $opt the CURLOPT to check
	 */
	public function isset_CURLOPT($opt) {
		return is_set($this->_curlOptions[$opt]);
	}
	
	/**
	 * Get a CURLOPT associated with this HttpConfig
	 * @throws InvalidArgumentException if $opt does not exist
	 * @param int $opt the CURLOPT to get
	 */
	public function get_CURLOPT($opt) {
		if(!array_key_exists($opt, $this->_curlOptions)) {
			throw new InvalidArgumentException("CURLOPT '".$opt."' is not set in this HttpConfig");
		}
		return $this->_curlOptions[$opt];
	}
	
	/**
	 * Returns the curl options that can be used for setting curl_setopt_array
	 * @return array of curl options
	 */
	public function getCurlOptionsAsArray() {
		return $this->_curlOptions;
	}
	
	/**
	 * Sets the complete CURLOPTions array
	 * @throws PanovaException if $options not is an array
	 * @param array $options 
	 */
	public function setCurlOptionsArray($options) {
		if(!is_array($options)) {
			throw new PaynovaException("\$options is not an array");
		}
		$this->_curlOptions = $options;
	}
	
	/**
	 * @return string representation of the curloptions
	 */
	public function __toString() {
		return var_export($this->getCurlOptionsAsArray(),true);
	}
}