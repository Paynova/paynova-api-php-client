<?php

/*
 * Autoload all classes
 */
function __autoload($class_name) {
	
	$file = $class_name.".php";
	$path = "";
	$dirs = get_paynova_dirs();
	foreach($dirs as $dir)
		if(is_file(__DIR__."/".$dir."/".$file)) { 
			$path = __DIR__."/".$dir."/".$file;
			break;
		}
	
	if($path!="")include_once $path;
	else echo "Class ".$file." could not be found";

}
/*
 * 	__autoload is available since PHP 5 but may be removed in the future
* 	spl_auto_load_register is available since 5.1.2
* *
*/
spl_autoload_register('__autoload');

/**
 * Returns all directories where to find Paynova SDK classes
 * @return array of directories
 */
function get_paynova_dirs() {
	return array(
			"Paynova/model",
			"Paynova/util",
			"Paynova/",
			"Paynova/http",
			
			"Paynova/exception",
			"Paynova/request", 
			"Paynova/request/model",
			"Paynova/response", 
			"Paynova/response/model"
			
	);
}
/**
 * Includes all Paynova files
 */
function include_all_classes() {
	$dirs = get_paynova_dirs();
	foreach($dirs as $dir) {
		$dir = __DIR__."/".$dir;
		if ($handle = opendir($dir)) {
			while (false !== ($entry = readdir($handle))) {
				$file = $dir."/".$entry;
				if(is_file($file) && preg_match("/([A-Z][^\.]*?\.php)/",$entry,$match)==1) {
					include_once $file;
				}
			}
			closedir($handle);
		}
	}
}

/**
 * Enable to discover subclasses with get_declared_classes() and is_subclass_of()
 * - otherwise __autoload is enough
 */
include_all_classes();




/*
 * Atleast PHP version 5.0.0
 */
if (version_compare(PHP_VERSION, '5.3.0', '<')) {
	throw new PaynovaException('PHP version >= 5.3.0 required. System version = '.PHP_VERSION);
}

/*
 *	Dependencies
 */
function requireDependencies() {
	$requiredExtensions = array('curl');
	foreach ($requiredExtensions AS $ext) {
		if (!extension_loaded($ext)) {
			throw new PaynovaException('The Paynova sdk library requires the ' . $ext . ' extension.');
		}
	}
}

requireDependencies();
