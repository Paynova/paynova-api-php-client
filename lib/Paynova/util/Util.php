<?php
/**
 * class Util
 * A utility class throughout the Paynova SDK
 *
 *
 * @package Paynova/util
 * @copyright Paynova 2014
 *
 */
class Util {
	
	/**
	 * Validates that $object is of $typeOfObject otherwise throw InvalidArgumentException
	 * @param object $object
	 * @param string $typeOfObject
	 * @throws InvalidArgumentException
	 */
	public static function validateObject($object, $typeOfObject) {
		
		if(!is_object($object)) {
			throw new InvalidArgumentException("\$object has to be an object of type ".$typeOfObject); 
		} 
		else if(
			$typeOfObject!="" && 
				!(get_class($object)==$typeOfObject || 
						in_array(get_class($object),self::getSubclasses($typeOfObject))
				)
		
		) {
			throw new InvalidArgumentException("\$object has be of type ".$typeOfObject); 
		}
	}
	
	/**
	 * Validates that all $objArray is of $typeOfObject otherwise throw InvalidArgumentException
	 * @param object $object
	 * @param string $typeOfObject
	 * @throws InvalidArgumentException
	 */
	public static function validateArrayOfObjects($objArray,$typeOfObjects) {
		
		if(!is_array($objArray)) {
			throw new PaynovaException("Not an array of objects");
		}
		foreach($objArray as $object) {
			self::validateObject($object, $typeOfObjects);
		}
	}
	
	/**
	 * Returns all the (Paynova)subclasses to $parentClassName
	 * @param string $parentClassName
	 * @return array of subclasses
	 */
	public static function getSubclasses($parentClassName) {
	    $classes = array();
	    
	    foreach (get_declared_classes() as $className) {
	    	if (is_subclass_of($className, $parentClassName)) {
	    		$classes[] = $className;
	    	}
	    }
		return $classes;
	}
	
	/**
	 * Checks if a class is abstract
	 * @param string $classname
	 * @return boolean
	 */
	public static function classIsAbstract($classname) {
		$c = new ReflectionClass($classname);
		return $c->isAbstract();
	}
	
	/**
	 * Validate the DIGEST for the POST-redirect
	 * Helper function that can be used to verify the DIGEST (sha1) code for the POST-redirect
	 * when the customer comes back from the payment-window-process.
	 * See the API documentation for the POST-redirect
	 * @param string $digestCode the digest to verfiy against
	 * @param array $postArr params to build the digest (send in the $_POST array)
	 * @param string $secretKey the secret key associated with the merchant account
	 * @return boolean true if $digestCode is veryfied, false otherwise
	 */
	public static function verify_POST_REDIRECT_DIGEST($postArr, $secretKey) {
		$basicNeeded = array(
				"ORDER_ID","SESSION_ID","ORDER_NUMBER","SESSION_STATUS","CURRENCY_CODE"
		);
		$paymentNeeded = array(
				"PAYMENT_#_STATUS","PAYMENT_#_TRANSACTION_ID","PAYMENT_#_AMOUNT"
		);
		
		$strToSha = "";
		
		$paymentNum = 1;
		
		foreach($basicNeeded as $index=>$key){
			$strToSha.=$postArr[$key].";";
		}
		for($i=1;$i<=intval($postArr["PAYMENT_COUNT"]);$i++) {
			foreach($paymentNeeded as $index=>$key){
				$key = str_replace("#",$i,$key);
				$strToSha.=$postArr[$key].";";
			}
		}
		$strToSha.=$secretKey;//Not that separator was added in the last for loop
		return $postArr["DIGEST"] == strtoupper(sha1(utf8_encode($strToSha)));
	}
	
	public static function verify_EVENT_HOOK_BODY_DIGEST($postArr,$secretKey) {
		$basicNeeded = array(
			"EVENT_TYPE","EVENT_TIMESTAMP","DELIVERY_TIMESTAMP","MERCHANT_ID"
		);
		
		
		$strToSha = "";
		foreach($basicNeeded as $index=>$key){
			$strToSha.=$postArr[$key].";";
		}
		
		$strToSha.=$secretKey;//Not that separator was added in the last for loop
		return $postArr["DIGEST"] == strtoupper(sha1(utf8_encode($strToSha)));
	}
	
	/**
	 * Verify the DIGEST (pn-digest) sent in the header of a EVENT HOOK
	 * return true / false 
	 * @param string $secretKey associated with the merchant account
	 * @param string $incomingHeadersArray (optional) the headers array received from the API SERVER
	 * if not present as parameter, the function will get it by getallheaders()
	 * @param string $http_raw_post_data the raw POST data sent received from the API SERVER
	 * if not present as parameter, the function will get it by reading php://input
	 * @return boolean
	 */
	public static function verify_EVENT_HOOK_HEAD_DIGEST($secretKey, $incomingHeadersArray = null, $http_raw_post_data = null) {
		
		return self::get_EVENT_HOOK_HEAD_DIGEST($incomingHeadersArray) == self::create_EVENT_HOOK_HEAD_DIGEST($secretKey, $http_raw_post_data);
	
	}
	
	/**
	 * Get the DIGEST (pn-digest) sent in the header of a EVENT HOOK
	 * @param string $incomingHeadersArray (optional) the headers array received from the API SERVER
	 * if not present as parameter, the function will get it by getallheaders()
	 * @return string 
	 */
	public static function get_EVENT_HOOK_HEAD_DIGEST($incomingHeadersArray = null) {
		//Get all the incoming headers
		//see http://www.php.net/manual/en/function.getallheaders.php
		if($incomingHeadersArray == null) {
			$incomingHeadersArray = getallheaders();
		}
	
		return $incomingHeadersArray["pn-digest"];
	}
	
	/**
	 * Creates and returns a DIGEST code calculated from RAW POST DATA and the merchant secret key
	 * @param string $secretKey associated with the merchant account
	 * @param string $http_raw_post_data the raw POST data sent received from the API SERVER
	 * if not present as parameter, the function will get it by reading php://input
	 * @return string
	 */
	public static function create_EVENT_HOOK_HEAD_DIGEST($secretKey, $http_raw_post_data = null) {
		//Get the all the raw incoming post data
		//see http://in.php.net/manual/en/wrappers.php.php#wrappers.php.input
		if($http_raw_post_data == null) {
			$f = fopen( 'php://input', 'r' );
				
			while( $line = fgets( $f ) ) {
				$http_raw_post_data.=$line;
			}
			fclose( $f );
		}
	
		$strToSha=$http_raw_post_data.$secretKey;
	
		return strtoupper(sha1(utf8_encode($strToSha)));
	}
}