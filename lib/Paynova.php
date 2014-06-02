<?php
/**
 * Paynova API Client
 * Initialize
 */
set_include_path(get_include_path() . PATH_SEPARATOR . realpath(dirname(__FILE__)));

require_once("Paynova/util/PaynovaCollection.php");
require_once("Paynova/util/PaynovaIterator.php");
require_once("Paynova/util/Util.php");
require_once("Paynova/util/Version.php");

require_once("Paynova/model/PropertyInterface.php");
require_once("Paynova/model/Instance.php");
require_once("Paynova/model/PropertyItemCollection.php");



require_once("Paynova/PaynovaConfig.php");

require_once("Paynova/http/Http.php");
require_once("Paynova/http/HttpConfig.php");
require_once("Paynova/http/HttpEvent.php");
require_once("Paynova/http/HttpImpl.php");

require_once("Paynova/exception/PaynovaException.php");
require_once("Paynova/exception/PaynovaExceptionApiCredentialsNotSet.php");
require_once("Paynova/exception/PaynovaExceptionConfig.php");
require_once("Paynova/exception/PaynovaExceptionHttp.php");
require_once("Paynova/exception/PaynovaExceptionRequiredPropertyMissing.php");
	
require_once("Paynova/request/Request.php");
require_once("Paynova/request/RequestAnnulAuthorization.php");
require_once("Paynova/request/RequestCreateOrder.php");
require_once("Paynova/request/RequestFinalizeAuthorization.php");
require_once("Paynova/request/RequestGetCustomerProfile.php");
require_once("Paynova/request/RequestInitializePayment.php");
require_once("Paynova/request/RequestRefundPayment.php");
require_once("Paynova/request/RequestRemoveCustomerProfile.php");
require_once("Paynova/request/RequestRemoveCustomerProfileCard.php");
require_once("Paynova/request/model/Address.php");
require_once("Paynova/request/model/CurrencyCode.php");
require_once("Paynova/request/model/CustomData.php");
require_once("Paynova/request/model/CustomDataCollection.php");
require_once("Paynova/request/model/Customer.php");
require_once("Paynova/request/model/InterfaceOptions.php");
require_once("Paynova/request/model/LineItem.php");
require_once("Paynova/request/model/LineItemCollection.php");
require_once("Paynova/request/model/Name.php");
require_once("Paynova/request/model/NameAddress.php");
require_once("Paynova/request/model/Passenger.php");
require_once("Paynova/request/model/PaymentMethod.php");
require_once("Paynova/request/model/PaymentMethodCollection.php");
require_once("Paynova/request/model/ProfileCard.php");
require_once("Paynova/request/model/ProfilePaymentOptions.php");
require_once("Paynova/request/model/Ticket.php");
require_once("Paynova/request/model/TicketCollection.php");
require_once("Paynova/request/model/TravelData.php");
require_once("Paynova/request/model/TravelSegment.php");
require_once("Paynova/request/model/TravelSegmentAir.php");
require_once("Paynova/request/model/TravelSegmentCollection.php");
require_once("Paynova/request/model/TravelSegmentRail.php");

require_once("Paynova/response/Response.php");
require_once("Paynova/response/ResponseAnnulAuthorization.php");
require_once("Paynova/response/ResponseCreateOrder.php");
require_once("Paynova/response/ResponseFactory.php");
require_once("Paynova/response/ResponseFinalizeAuthorization.php");
require_once("Paynova/response/ResponseGetCustomerProfile.php");
require_once("Paynova/response/ResponseInitializePayment.php");
require_once("Paynova/response/ResponseRefundPayment.php");
require_once("Paynova/response/ResponseRemoveCustomerProfile.php");
require_once("Paynova/response/ResponseRemoveCustomerProfileCard.php");
require_once("Paynova/response/model/Error.php");
require_once("Paynova/response/model/ErrorCollection.php");
require_once("Paynova/response/model/ProfileCardDetails.php");
require_once("Paynova/response/model/ProfileCardDetailsCollection.php");
require_once("Paynova/response/model/Status.php");

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
}
Dependencies::phpVersion();
Dependencies::requiredDependencies();
