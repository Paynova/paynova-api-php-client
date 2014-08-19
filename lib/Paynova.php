<?php
/**
 * Paynova API Client
 * Initialize
 */

function paynova_autoloader($class_name){
	include __DIR__."/".str_replace("\\","/",$class_name) . '.php';
}

spl_autoload_register('paynova_autoloader');

use Paynova\exception\PaynovaException;

class Dependencies {
	public static function phpVersion() {
		/*
		 * Atleast PHP version 5.3.0
		*/
		if (version_compare(PHP_VERSION, '5.3.0', '<')) {
			throw new PaynovaException('PHP version >= 5.3.0 required. System version = '.PHP_VERSION);
		}
	}
	
	public static function requiredDependencies() {
		$requiredExtensions = array('curl');
		foreach ($requiredExtensions AS $ext) {
			if (!extension_loaded($ext)) {
				throw new PaynovaException('The Paynova sdk library requires the ' . $ext . ' extension.');
			}
		}
	}
	public static function loadAllClassesInPaynovaNamespace($dir = "",$paynovaDir = ""){
		if($dir == "")$dir = __DIR__."/";
	
		$cdir = scandir($dir);
	
		foreach ($cdir as $key => $value) {
			if (!in_array($value,array(".",".."))) {
				if (is_dir($dir . DIRECTORY_SEPARATOR . $value)){
					self::loadAllClassesInPaynovaNamespace($dir . DIRECTORY_SEPARATOR . $value,$paynovaDir."/".$value);
				} else if(preg_match("/\.php$/",$value)){
					$file = preg_replace("/^\//","",$paynovaDir.(($paynovaDir!="")?"/":"").$value);
					require_once($file);
					
				}
			}
		}
	
	}
}
Dependencies::loadAllClassesInPaynovaNamespace();
Dependencies::phpVersion();
Dependencies::requiredDependencies();
