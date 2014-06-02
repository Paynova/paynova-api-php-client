<?php
ini_set("display_errors",'on');
include_once __DIR__."/../lib/Paynova.php";
include_once __DIR__."/../vendor/autoload.php";
//The file is a local setting file and not included in the project,
//it just contains the below function
@include_once __DIR__."/../local-config.php";
if(!function_exists("localConfig")) {
	function localConfig($var) {
		$arr = array(
			"do-local-tests"=>true,//To tests locally or against below endpoint true/false
			"endpoint"=>"set-endpoint-url-here",
			"username"=>"set-merchant-username-here",
			"password"=>"set-merchant-password-here",
			"secretkey"=>"set-merchant-secret-key-here",
			"merchantURL"=>"set-merchant-callback/redirect-url-here"
		);
		return $arr[$var];
	}
}
class TestHelper {
	
	public static $_messagePrinted = false;
	
	public static function doLocalTests(){
		if(!localConfig("do-local-tests") && !self::$_messagePrinted){
			TestHelper::setSandboxCredentials();
			self::printMessage();
			self::$_messagePrinted = true;
		}
		return localConfig("do-local-tests");
	}
	
	private static function printMessage() {
		echo "\nIntegration tests and http/HttpImplTest are done against the endpoint ".PaynovaConfig::endpoint()."\n".
		"- see ".__FILE__."\n\n";
	}
	
	public static function setSandboxCredentials() {
		PaynovaConfig::endpoint(	localConfig("endpoint")			);//The API SERVER URL
		PaynovaConfig::username(	localConfig("username")			);//Merchant id at Paynova
		PaynovaConfig::password(	localConfig("password")			);//Merchant password at paynova
	}
	public static function resetSandboxCredentials() {
		PaynovaConfig::reset();
	}
	public static function getRandomOrderNumber() {
		return self::getRandomNumber()."-foo-".self::getRandomNumber();
	}
	
	public static function getRandomNumber() {
		return rand(1000,99999);
	}
	public static function getRandomOrderId() {
		return  TestHelper::getRandomNumber()."-".TestHelper::getRandomNumber()."-".TestHelper::getRandomNumber();
	}
	public static function getRandomTransactionId() {
		return self::getRandomNumber()."".self::getRandomNumber()."".self::getRandomNumber();
	}
	public static function factoryHttpEventWithSuccess($type = "",$arg1 = "", $arg2 = "") {
		return HttpEvent::factory(array(
					"code"=>201,
					"responseHeader"=>"",
					"responseBody"=>TestHelper::getSuccessJsonStr($type,$arg1,$arg2),
					"requestHeader"=>"",
					"requestBody"=>""
		));
	}
	
	public static function getSuccessJsonStr($type, $arg1 = "", $arg2 = ""){
		$json = '{
					'.self::getJsonResponse($type,$arg1, $arg2).'
				}
				';
		return str_replace("\n","",str_replace("\t","",$json));
	}
	
	public static function factoryHttpEventWithError($type) {
		return HttpEvent::factory(array(
				"code"=>201,
				"responseHeader"=>"",
				"responseBody"=>TestHelper::getErrorJsonStr($type),
				"requestHeader"=>"",
				"requestBody"=>""
		));
	}
	
	public static function getErrorJsonStr($type){
		$json = '{
					'.self::getJsonResponse($type).'
				}
				';
		return str_replace("\n","",str_replace("\t","",$json));
	}
	
	public static function getJsonResponse($type,$arg1 = "", $arg2 = "") {
		
		switch($type){
			case "SUCCESS":
				return '"status": { "isSuccess": true,	"errorNumber": 0,	"statusKey": "SUCCESS",	"statusMessage": "The operation was successful.",	"errors": null,	"exceptionDetails": null}';
				break;
			case "SUCCESS_FINALIZE_AUTHORIZATION":
				return '"status": { "isSuccess": true,	"errorNumber": 0,	"statusKey": "SUCCESS",	"statusMessage": "The operation was successful.",	"errors": null,	"exceptionDetails": null},"totalAmountFinalized": '.$arg1.',"totalAmountPendingFinalization": 0,"canFinalizeAgain": false,"amountRemainingForFinalization": 0,"transactionId": "'.$arg2.'","batchId": "141000132879","acquirerId": "1010"';
				break;
			case "SUCCESS_CREATE_ORDER":
				return '"status": { "isSuccess": true,	"errorNumber": 0,	"statusKey": "SUCCESS",	"statusMessage": "The operation was successful.",	"errors": null,	"exceptionDetails": null}, "orderId":"'.$arg1.'"';
				break;
			case "SUCCESS_INITALIZE_PAYMENT":
				return '"status": { "isSuccess": true,	"errorNumber": 0,	"statusKey": "SUCCESS",	"statusMessage": "The operation was successful.",	"errors": null,	"exceptionDetails": null}, "sessionId":"'.TestHelper::getRandomNumber().'","url":"'.$arg1.'"';
				break;
			case "SUCCESS_GET_CUSTOMER_PROFILE":
				return '"status": { "isSuccess": true,	"errorNumber": 0,	"statusKey": "SUCCESS",	"statusMessage": "The operation was successful.",	"errors": null,	"exceptionDetails": null}, "profileId":"'.$arg1.'","profileCards":[{"expirationYear":0,"expirationMonth":0,"firstSix":"String","lastFour":"String"}]';
				break;
			case "SUCCESS_REFUND_PAYMENT":
				return '"status": { "isSuccess": true,	"errorNumber": 0,	"statusKey": "SUCCESS",	"statusMessage": "The operation was successful.",	"errors": null,	"exceptionDetails": null}, "totalAmountRefunded":'.$arg1.',"totalAmountPendingRefund":0,"canRefundAgain":false,"amountRemainingForRefund":0,"transactionId":'.$arg2.',"batchId":'.self::getRandomNumber().',"acquirerId":1010';
				break;
			case "HTTP_401":
					return '"status": { "isSuccess": false,	"errorNumber": -3,	"statusKey": "HTTP_401","statusMessage": "API authentication failed",	"errors": null,	"exceptionDetails": null}';
					break;
			case "VALIDATION_ERROR":
					return '"status": { "isSuccess": false,	"errorNumber": -2,	"statusKey": "VALIDATION_ERROR","statusMessage": "The request contained one or more validation errors.  See the errors collection for further details.",	"errors": [{"errorCode":"foo","fieldName":"foo","message":"foo"}],	"exceptionDetails": null}';
				break;
			case "ORDER_NOT_FOUND":
				return '"status": { "isSuccess": false,	"errorNumber": 3000,	"statusKey": "ORDER_NOT_FOUND","statusMessage": "The specified order was not found.",	"errors": null,	"exceptionDetails": null}';
				break;
				
		}
	}
}

class HttpMock implements Http{
	
	var $_func;
	var $_http;
	public function __construct($func) {
		$this->_func = $func;
		if(!TestHelper::doLocalTests()){
			$this->_http = new HttpImpl();
		}
	}
	
	public function put($restPath, $params){
		throw new PaynovaException("PUT is not supported");
	}
	
	
	public function delete($restPath, HttpConfig $httpConfig = null){
		if(!TestHelper::doLocalTests()){
			$httpEvent = $this->_http->delete($restPath,$httpConfig);
			return $httpEvent;
		}
		return call_user_func($this->_func,null);
	}
	
	
	public function get($restPath, HttpConfig $httpConfig = null){
		if(!TestHelper::doLocalTests()){
			$httpEvent = $this->_http->get($restPath,$httpConfig);
			return $httpEvent;
		}
		return call_user_func($this->_func,null);
	}
	
	
	public function post($restPath, $params, HttpConfig $httpConfig = null){
		if(!TestHelper::doLocalTests()){
			$httpEvent = $this->_http->post($restPath,$params,$httpConfig);
			return $httpEvent;
		}
		return call_user_func($this->_func,null);
	}
}

