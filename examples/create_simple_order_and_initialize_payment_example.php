<?php
/*
 * Set the credentials for calling the API server
 * in examples/examples_config.php
 * 
*/
include "examples_config.php";

use Paynova\request\RequestCreateOrder;
use Paynova\request\RequestInitializePayment;
use Paynova\request\model\InterfaceOptions;

/*
 * Create an simple order
* - simple cause only the most basic information
*/
$request = RequestCreateOrder::factory(array(
		"orderNumber"=>"merchant-order-id-1",
		"currencyCode"=>"SEK",
		"totalAmount"=>"100.00",
));

$response = $request->request();

if($response->status()->isSuccess()==1) {
	/*
	 * The call was successful
	* Now we can initialize the payment
	* and get an URL to send the customer to for paying for the merchandise
	*/
	$initRequest = RequestInitializePayment::factory(array(
			"orderId"=>$response->orderId(),//response from the RequestCreateOrder request
			"totalAmount"=>"100.00",
			"paymentChannelId"=>RequestInitializePayment::PAYMENT_CHANNEL_WEB,
			"interfaceOptions"=>array(
					"interfaceId"=>InterfaceOptions::ID_AERO,
					"customerLanguageCode"=>"swe",
					"urlRedirectSuccess"=>"http://www.merchant-url.com/success",//Change to your URL
					"urlRedirectCancel"=>"http://www.merchant-url.com/cancel",//Change to your URL
					"urlRedirectPending"=>"http://www.merchant-url.com/pending",//Change to your URL
					"urlCallback"=>"http://www.url-where-to-receive-event-hooks.com/"//Change to your URL
			),
	));
	$initResponse = $initRequest->request();
	if($initResponse->status()->isSuccess()==1) {
		/*
		 * This is the URL to use to redirect the user to
		 * $initResponse->url
		 */
		echo $initResponse->url;
	} else {
		/*
		 * Use the error collection
		 * $initResponse->status()->errors();
		*/
	}
}else {
	/*
	 * $response->status()->errors();
	*/
}