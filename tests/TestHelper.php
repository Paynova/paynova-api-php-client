<?php
@ini_set('display_errors', 'on');
@error_reporting(E_ALL | E_STRICT);
include_once __DIR__."/../vendor/autoload.php";
include_once __DIR__."/../lib/Paynova.php";
use Paynova\PaynovaConfig;
use Paynova\http\Http;
use Paynova\http\HttpConfig;
use Paynova\http\HttpEvent;
use Paynova\http\HttpImpl;
use Paynova\exception\PaynovaException;


//The file is a local setting file and not included in the project,
//it just contains the below function
@include_once __DIR__."/../local-config.php";
if(!function_exists("localConfig")) {
	function localConfig($var) {
		$arr = array(
			/*
			 * The customerGovernmentId and the customer has to be connected to the same customer and
			 * that customer has to be connected to the merchant specified below
			 *  
			 */
			"do-local-tests"=>true,//To tests locally or against below endpoint true/false
			"endpoint"=>"http://set-endpoint-url-here.com",
			"username"=>"set-merchant-username-here",
			"password"=>"set-merchant-password-here",
			"secretkey"=>"set-merchant-secret-key-here",
			"merchantURL"=>"set-merchant-callback/redirect-url-here",
			"customerGovernmentId"=>"set-customer-government-id-here",//To be able to test GetAddresses - ask Paynova for a valid 
			"customerEmail" =>"set-customer-email-here"//To be able to test AuthorizePayment
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
			case "SUCCESS_GET_ADDRESSES":
				return '"governmentId":"123456781234","countryCode":"SE","addresses":[{"name":{"companyName":null,"title":null,"firstName":"Namni","middleNames":null,"lastName":"ENAMNI","suffix":null},"address":{"type":"legal","street1":"GATUADRESS 77","street2":null,"street3":"","street4":"","city":"LANDSKRONA","postalCode":"26151","regionCode":null,"countryCode":"SE"}},{"name":{"companyName":null,"title":null,"firstName":"Namni","middleNames":null,"lastName":"ENAMNI","suffix":null},"address":{"type":"nonverified","street1":"GATUADRESS 77","street2":"","street3":"","street4":"","city":"LANDSKRONA","postalCode":"26151","regionCode":"","countryCode":"SE"}},{"name":{"companyName":null,"title":null,"firstName":"Namni","middleNames":null,"lastName":"ENAMNI","suffix":null},"address":{"type":"nonverified","street1":"GATUADRESS 77","street2":"","street3":"","street4":"","city":"LANDSKRONA","postalCode":"26151","regionCode":null,"countryCode":"SE"}}],"status":{"isSuccess":true,"errorNumber":0,"statusKey":"SUCCESS","statusMessage":"The operation was successful.","errors":null,"exceptionDetails":null}';
				break;
			case "FAIL_GET_ADDRESSES":
				return '"governmentId":null,"countryCode":null,"addresses":[],"status":{"isSuccess":false,"errorNumber":-2,"statusKey":"VALIDATION_ERROR","statusMessage":"The request contained one or more validation errors.  See the errors collection for further details.","errors":[{"errorCode":"GovernmentIdIsInvalid","fieldName":"GovernmentId","message":"Provided value does not evaluate to a valid government id."}],"exceptionDetails":null}';
				break;
			case "SUCCESS_GET_PAYMENT_OPTIONS":
				return '"status":{"isSuccess":true,"errorNumber":0,"statusKey":"SUCCESS","statusMessage":"The operation was successful.","errors":null,"exceptionDetails":null},"availablePaymentMethods":[{"paymentMethodId":1,"paymentMethodProductId":null,"displayName":"VISA","group":{"key":"card","displayName":"Kredit-/betalkort"},"interestRate":null,"notificationFee":null,"setupFee":null,"numberOfInstallments":null,"installmentPeriod":null,"installmentUnit":null,"legalDocuments":null,"addressTypeRestrictions":[]},{"paymentMethodId":2,"paymentMethodProductId":null,"displayName":"MasterCard","group":{"key":"card","displayName":"Kredit-/betalkort"},"interestRate":null,"notificationFee":null,"setupFee":null,"numberOfInstallments":null,"installmentPeriod":null,"installmentUnit":null,"legalDocuments":null,"addressTypeRestrictions":[]},{"paymentMethodId":3,"paymentMethodProductId":null,"displayName":"American Express","group":{"key":"card","displayName":"Kredit-/betalkort"},"interestRate":null,"notificationFee":null,"setupFee":null,"numberOfInstallments":null,"installmentPeriod":null,"installmentUnit":null,"legalDocuments":null,"addressTypeRestrictions":[]},{"paymentMethodId":4,"paymentMethodProductId":null,"displayName":"Diners Club","group":{"key":"card","displayName":"Kredit-/betalkort"},"interestRate":null,"notificationFee":null,"setupFee":null,"numberOfInstallments":null,"installmentPeriod":null,"installmentUnit":null,"legalDocuments":null,"addressTypeRestrictions":[]},{"paymentMethodId":101,"paymentMethodProductId":null,"displayName":"Nordea","group":{"key":"online_bank","displayName":"Internetbank"},"interestRate":null,"notificationFee":null,"setupFee":null,"numberOfInstallments":null,"installmentPeriod":null,"installmentUnit":null,"legalDocuments":null,"addressTypeRestrictions":[]},{"paymentMethodId":311,"paymentMethodProductId":"DirectInvoice","displayName":"Direkt faktura","group":{"key":"invoice","displayName":"Invoice"},"interestRate":null,"notificationFee":{"label":"Fakturaavgift","symbol":"kr","value":"29.00"},"setupFee":null,"numberOfInstallments":null,"installmentPeriod":null,"installmentUnit":null,"legalDocuments":[{"label":"Test","uri":"http://paynova.com"}],"addressTypeRestrictions":["legal"]},{"paymentMethodId":311,"paymentMethodProductId":"InstallmentsThreeMonths","displayName":"Delbetalning 3 månader","group":{"key":"installment","displayName":"Part-Payment"},"interestRate":{"label":"Annuity","symbol":"%","value":"10.00"},"notificationFee":{"label":"Aviavgift","symbol":"kr","value":"29.00"},"setupFee":{"label":"Uppläggningsavgift","symbol":"kr","value":"95.00"},"numberOfInstallments":3,"installmentPeriod":1,"installmentUnit":"month","legalDocuments":[{"label":"Avtalsvilkor 3 månader delbetalning","uri":"http://www.paynova.com"}],"addressTypeRestrictions":["legal"]},{"paymentMethodId":102,"paymentMethodProductId":null,"displayName":"Swedbank","group":{"key":"online_bank","displayName":"Internetbank"},"interestRate":null,"notificationFee":null,"setupFee":null,"numberOfInstallments":null,"installmentPeriod":null,"installmentUnit":null,"legalDocuments":null,"addressTypeRestrictions":[]},{"paymentMethodId":104,"paymentMethodProductId":null,"displayName":"SEB","group":{"key":"online_bank","displayName":"Internetbank"},"interestRate":null,"notificationFee":null,"setupFee":null,"numberOfInstallments":null,"installmentPeriod":null,"installmentUnit":null,"legalDocuments":null,"addressTypeRestrictions":[]},{"paymentMethodId":305,"paymentMethodProductId":"125","displayName":"Kampanj","group":{"key":"invoice","displayName":"Invoice"},"interestRate":null,"notificationFee":null,"setupFee":null,"numberOfInstallments":null,"installmentPeriod":null,"installmentUnit":null,"legalDocuments":null,"addressTypeRestrictions":[]},{"paymentMethodId":305,"paymentMethodProductId":"34","displayName":"Paynovakort","group":{"key":"card","displayName":"Kredit-/betalkort"},"interestRate":null,"notificationFee":null,"setupFee":null,"numberOfInstallments":null,"installmentPeriod":null,"installmentUnit":null,"legalDocuments":null,"addressTypeRestrictions":[]},{"paymentMethodId":305,"paymentMethodProductId":"35","displayName":"Ansök om ett nytt Paynovakort","group":{"key":"revolving_credit","displayName":"Revolving Credit"},"interestRate":null,"notificationFee":null,"setupFee":null,"numberOfInstallments":null,"installmentPeriod":null,"installmentUnit":null,"legalDocuments":null,"addressTypeRestrictions":[]},{"paymentMethodId":305,"paymentMethodProductId":"36","displayName":"Faktura","group":{"key":"invoice","displayName":"Invoice"},"interestRate":null,"notificationFee":null,"setupFee":null,"numberOfInstallments":null,"installmentPeriod":null,"installmentUnit":null,"legalDocuments":null,"addressTypeRestrictions":[]},{"paymentMethodId":305,"paymentMethodProductId":"55","displayName":"Paynovakort","group":{"key":"card","displayName":"Kredit-/betalkort"},"interestRate":null,"notificationFee":null,"setupFee":null,"numberOfInstallments":null,"installmentPeriod":null,"installmentUnit":null,"legalDocuments":null,"addressTypeRestrictions":[]},{"paymentMethodId":305,"paymentMethodProductId":"56","displayName":"Nytt kort","group":{"key":"revolving_credit","displayName":"Revolving Credit"},"interestRate":null,"notificationFee":null,"setupFee":null,"numberOfInstallments":null,"installmentPeriod":null,"installmentUnit":null,"legalDocuments":null,"addressTypeRestrictions":[]},{"paymentMethodId":305,"paymentMethodProductId":"57","displayName":"Faktura","group":{"key":"invoice","displayName":"Invoice"},"interestRate":null,"notificationFee":null,"setupFee":null,"numberOfInstallments":null,"installmentPeriod":null,"installmentUnit":null,"legalDocuments":null,"addressTypeRestrictions":[]},{"paymentMethodId":306,"paymentMethodProductId":"125","displayName":"Kampanj","group":{"key":"invoice","displayName":"Invoice"},"interestRate":null,"notificationFee":null,"setupFee":null,"numberOfInstallments":null,"installmentPeriod":null,"installmentUnit":null,"legalDocuments":null,"addressTypeRestrictions":[]},{"paymentMethodId":306,"paymentMethodProductId":"34","displayName":"Paynovakort","group":{"key":"card","displayName":"Kredit-/betalkort"},"interestRate":null,"notificationFee":null,"setupFee":null,"numberOfInstallments":null,"installmentPeriod":null,"installmentUnit":null,"legalDocuments":null,"addressTypeRestrictions":[]},{"paymentMethodId":306,"paymentMethodProductId":"35","displayName":"Ansök om ett nytt Paynovakort","group":{"key":"revolving_credit","displayName":"Revolving Credit"},"interestRate":null,"notificationFee":null,"setupFee":null,"numberOfInstallments":null,"installmentPeriod":null,"installmentUnit":null,"legalDocuments":null,"addressTypeRestrictions":[]},{"paymentMethodId":306,"paymentMethodProductId":"36","displayName":"Faktura","group":{"key":"invoice","displayName":"Invoice"},"interestRate":null,"notificationFee":null,"setupFee":null,"numberOfInstallments":null,"installmentPeriod":null,"installmentUnit":null,"legalDocuments":null,"addressTypeRestrictions":[]},{"paymentMethodId":306,"paymentMethodProductId":"55","displayName":"Paynovakort","group":{"key":"card","displayName":"Kredit-/betalkort"},"interestRate":null,"notificationFee":null,"setupFee":null,"numberOfInstallments":null,"installmentPeriod":null,"installmentUnit":null,"legalDocuments":null,"addressTypeRestrictions":[]},{"paymentMethodId":306,"paymentMethodProductId":"56","displayName":"Nytt kort","group":{"key":"revolving_credit","displayName":"Revolving Credit"},"interestRate":null,"notificationFee":null,"setupFee":null,"numberOfInstallments":null,"installmentPeriod":null,"installmentUnit":null,"legalDocuments":null,"addressTypeRestrictions":[]},{"paymentMethodId":306,"paymentMethodProductId":"57","displayName":"Faktura","group":{"key":"invoice","displayName":"Invoice"},"interestRate":null,"notificationFee":null,"setupFee":null,"numberOfInstallments":null,"installmentPeriod":null,"installmentUnit":null,"legalDocuments":null,"addressTypeRestrictions":[]},{"paymentMethodId":308,"paymentMethodProductId":null,"displayName":"MasterPass","group":{"key":"other","displayName":"Other"},"interestRate":null,"notificationFee":null,"setupFee":null,"numberOfInstallments":null,"installmentPeriod":null,"installmentUnit":null,"legalDocuments":null,"addressTypeRestrictions":[]},{"paymentMethodId":304,"paymentMethodProductId":null,"displayName":"PayPal","group":{"key":"other","displayName":"Other"},"interestRate":null,"notificationFee":null,"setupFee":null,"numberOfInstallments":null,"installmentPeriod":null,"installmentUnit":null,"legalDocuments":null,"addressTypeRestrictions":[]}]';
				break;
			case "SUCCESS_AUTHORIZE_INVOICE_PAYMENT":
				return '"status":{"isSuccess":true,"errorNumber":0,"statusKey":"SUCCESS","statusMessage":"The operation was successful.","errors":null,"exceptionDetails":null},"orderId":"f224bb03-753e-40af-93a2-a4ad00e758a6","transactionId":"201506041602186502","acquirerId":1045,"acquirerReferenceId":"111261"';
				break;
		}
	}
	/**
	 * 
	 * @param unknown $thisObject
	 * @param unknown $object
	 * @param string $specialPropertyParamFunction (if a object has a special property that needs an argument 
	 * 												of a special type send in a function that returns that. Example TravelSegmentAir)
	 * 												$method, $param needs to be arguments
	 * 												
	 */
	public static function assert_modelSignature($thisObject,$object,$specialPropertyParamFunction = null){
		$signature = $object->getSignature();
		foreach($signature as $key=>$value) {
			$method = $value;
			$param = "";
			$assert = true;
			if(!is_int($key) && class_exists($value)) {
				$method=$key;
	
				$param = new $value();
			}else {
				$param = "foo";
				$refl = new ReflectionMethod(get_class($object), $method);
				//Only test properties with setter and getter
				if($refl->getNumberOfParameters()<1){
					$assert = false;
				}else if($specialPropertyParamFunction != null && is_callable($specialPropertyParamFunction)){
					//Check if any special param is needed
					$param = $specialPropertyParamFunction($method,$param);
				}
			}
			if($assert){
				call_user_func_array(array($object,$method),array($param));
				$thisObject->assertEquals(call_user_func_array(array($object,$method),array()),$param);
			}
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

