#Paynova API PHP Client

This is an overview of the Paynova API PHP Client using [Paynova REST API][] (Aero). More in-depth information can be found in the [Wiki][].
[Paynova REST API]: http://docs.paynova.com/display/API/Paynova+API+Home
[Wiki]: https://github.com/Paynova/paynova-api-php-client/wiki

##Dependencies
PHP version >= 5.3.0 required.

The following PHP extensions are required:
* curl

##Get started
* Get started by downloading the zip-file

OR

* Use composer 
```
{
  "require" : {
    "paynova/paynova_php": "dev-master"
  }
}
```


##Quick example
Below example creates an order at Paynova.
```
include YOUR_PATH."/lib/Paynova.php";

/*
*	Set credentials here
*/
PaynovaConfig::endpoint("set-endpoint-url-here);//The API SERVER URL
PaynovaConfig::username("username);//Merchant id at Paynova
PaynovaConfig::password("password");//Merchant password at paynova

/*
* Create an order by using the factory method in RequestCreateOrder
* set the mandatory properties
*/
$request = RequestCreateOrder::factory(array(
		"orderNumber"=>"merchant-order-id-1",
		"currencyCode"=>"SEK",
		"totalAmount"=>"100.00",
));
/*
* Make the request to the API server
* and get ResponseCreateOrder
*/
$response = $request->request();

if($response->status()->isSuccess()==1) {
	//SUCCESS
}else{
	/*
	 * Use the error collection
	 * $initResponse->status()->errors();
	*/
}
```


##License
Read the LICENSE.md file