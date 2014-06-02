<?php
/**
 * class Version
 * 
 * Holds the current Paynova SDK version
 * 
 * 
 * @package Paynova/response/model
 * @copyright Paynova 2014
 *
 */
class Version {
	/**
	 * 
	 * @var string
	 */
	public static $version = "1.0.0";
	
	/**
	 * Can't instantiate
	 */
	private function __construct() { }
	
	/**
	 * Returns the version
	 * @return string
	 */
	public static function get() {
		return self::$version;
	} 
}