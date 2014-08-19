<?php
include "../lib/Paynova.php";

use Paynova\PaynovaConfig;

//The file is a local setting file and not included in the project,
//it just contains the below function
@include_once __DIR__."/../local-config.php";

if(!function_exists("localConfig")) {
	function localConfig($var) {
		$arr = array(
				"endpoint"=>"set-endpoint-url-here",
				"username"=>"set-merchant-username-here",
				"password"=>"set-merchant-password-here"
		);
		return $arr[$var];
	}
}


/*
 * Set the credentials for calling the API server
 * 
*/
try{
	PaynovaConfig::endpoint(	localConfig("endpoint")			);//The API SERVER URL
	PaynovaConfig::username(	localConfig("username")			);//Merchant id at Paynova
	PaynovaConfig::password(	localConfig("password")			);//Merchant password at paynova
	echo "Making Paynova API - REST calls against ".PaynovaConfig::endpoint()." - with user ".PaynovaConfig::username()."\n\n";
}catch(Exception $e) {
	die("You forgot to set your Paynova credentials. Use the PaynovaConfig:: methods");
}