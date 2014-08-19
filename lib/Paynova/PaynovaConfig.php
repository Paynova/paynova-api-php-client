<?php
namespace Paynova;

use \InvalidArgumentException;
use Paynova\exception\PaynovaExceptionConfig; 

/**
 * Paynova Config 
 * Stores server-endpoints, merchant-credentials
 *
 * @package    paynova\api\sdk
 * @copyright  2014 Paynova
 *
 */
class PaynovaConfig
{
	
	/**
	 * @var config settings
	 */
	 private static $_settings = array(
		"endpoint" => "",
		"username" => "",
		"password" => "",
	);
	
	
	
	 
	/**
	 * No need to instantiate an object of PaynovaConfig
	 */
	public function __construct() {}
	
	
	/**
	 * magically called when trying to reach private/non declared instance variables
	 * see PHP overloading
	 *
	 * @param string $name of property
	 * @return mixed
	 */
	public function __get($name) {
		if (array_key_exists($name, $this->attributes)) {
			return $this->attributes[$name];
		} else {
			throw new \InvalidArgumentException('Undefined property on ' . get_class($this) . ': ' . $name, E_USER_NOTICE);
			
		}
	
	}
	
	/**
	 * Checks if an attribute is set
	 * @param mixed $name
	 * @return boolean
	 */
	public function __isset($name) {
		return array_key_exists($name, $this->attributes);
	}
	
	/**
	 * Clear all the settings
	 */
	public static function reset() {
		foreach(self::$_settings as $key=>$value) {
			self::$_settings[$key]="";
		}
	}
	
	/**
	 * 
	 * @param string $key setting to set
	 * @param string $value to assign to $key
	 * @throws PaynovaExceptionConfig
	 * @return boolean if $key successfully was set
	 */
	private static function set($key,$value) {
		
		if($key=="endpoint" && !filter_var($value,FILTER_VALIDATE_URL)) {
			throw new InvalidArgumentException($value." is not a valid (endpoint) URL");
		}
		
		if(!isset(self::$_settings[$key])){
			throw new PaynovaExceptionConfig('"'.$key.'" no such config setting');
		}
		
		if(empty($value)) {
			throw new PaynovaExceptionConfig("No config setting can be empty");
		}
		self::$_settings[$key]=$value;
		return true;
	}
	/**
	 * 
	 * @param string $key setting to set
	 * @throws PaynovaExceptionConfig
	 */
	private static function get($key) {
		if(isset(self::$_settings[$key]) && empty(self::$_settings[$key])) {
			throw new PaynovaExceptionConfig('"'.$key.'" is not set yet.');
		}
		
		if(array_key_exists($key,self::$_settings)) {
			return self::$_settings[$key];
		}
		
		return null;
	}
	
	
	private static function setOrGet($key = null,$value = null) {
		if(!empty($value)) {
			self::set($key,$value);
		} else {
			return self::get($key);
		}
		return true;
	}
	
	/**
	 * Set or get the the API server endpoint
	 * @param string $endpoint (optional) if setting
	 * @return string endpoint if getting
	 */
	public static function endpoint($endpoint = null) {
		return self::setOrGet(__FUNCTION__, $endpoint);
	}
	
	/**
	 * Set or get the username 
	 * @param string $username (optional) if setting
	 * @return string username if getting
	 */
	public static function username($username = null) {
		return self::setOrGet(__FUNCTION__, $username);
	}
	
	/**
	 * Set or get the password 
	 * @param string $password (optional) if setting
	 * @return string password if getting
	 */
	public static function password($password = null) {
		return self::setOrGet(__FUNCTION__, $password);
	}
	
}