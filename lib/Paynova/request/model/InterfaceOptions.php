<?php
namespace Paynova\request\model;

use Paynova\model\Instance;

/**
 * class InterfaceOptions
 * part of service: 	InitializePayment
 * 
 * 
 * @package Paynova/request/model
 * @copyright Paynova 2014
 *
 */
class InterfaceOptions extends Instance {
	
	/**
	 * interfaceId options
	 */
	const ID_AERO = 5;
	
	/**
	 * layoutName options
	 */
	const LAYOUT_PAYNOVA_FULLPAGE_1 = "Paynova_FullPage_1";
	const LAYOUT_PAYNOVA_MOBILE_1 = "Paynova_Mobile_1";
	
	/**
	 * @see model/Instance::__construct()
	 */
	public function __construct() {
		parent::__construct(array(
				"interfaceId","displayLineItems","themeName",
				"layoutName","customerLanguageCode","urlRedirectSuccess",
				"urlRedirectCancel","urlRedirectPending","urlCallback"
		));
	}
	
	/**
	 * interfaceId setter/getter
	 * The id of the web interface to use. Currently, the only value accepted is 5 for our Aero interface.
	 * Use const ID_AERO from this class
	 * @param int $value (optional) used when setting
	 * @return InterfaceOptions or int interfaceId
	 */
	public function interfaceId($value = null) { return $this->setOrGet(__FUNCTION__,$value); }

	/**
	 * displayLineItems setter/getter
	 * Indicates whether or not order line-items should be displayed to the customer. The default is true if 
	 * you send line items, false if you do not send line items.
	 * @param boolean $bool (optional) used when setting
	 * @return InterfaceOptions or boolean
	 */
	public function displayLineItems($bool = null) { return $this->setOrGet(__FUNCTION__,$bool); }
	
	/**
	 * themeName setter/getter
	 * The name of your custom hosted theme at Paynova. Note that this field only applies to merchants who have 
	 * setup a custom theme with us and specifying an invalid value will result in your payment page not rendering properly.
	 * @param string $value (optional) used when setting
	 * @return InterfaceOptions or string themeName
	 */
	public function themeName($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * layoutName setter/getter
	 * The name of the layout to use. The following values are public layouts which you may use:
	 * Paynova_Fullpage_1 = Layout designed for desktop browsers
	 * Paynova_Mobile_1 =  Layout designed for mobile browsers. Only card payments are supported.
	 * See LAYOUT_xxx constants
	 * @param string $value (optional) used when setting
	 * @return InterfaceOptions or string layoutName
	 */
	public function layoutName($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * customerLanguageCode setter/getter
	 * The three-letter language code identifying the language that the payment interface should 
	 * be displayed to the customer in.
	 * @param string $value (optional) used when setting
	 * @return InterfaceOptions or string customerLanguageCode
	 */
	public function customerLanguageCode($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * urlRedirectSuccess setter/getter
	 * The URL on your website to which we should redirect the customer upon successful payment.
	 * @param string $value (optional) used when setting
	 * @return InterfaceOptions or string urlRedirectSuccess
	 */
	public function urlRedirectSuccess($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * urlRedirectCancel setter/getter
	 * The URL on your website to which we should redirect the customer upon the customer cancelling 
	 * payment or running out of payment attempts.
	 * @param string $value (optional) used when setting
	 * @return InterfaceOptions or string urlRedirectCancel
	 */
	public function urlRedirectCancel($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * urlRedirectPending setter/getter
	 * The URL on your website to which we should redirect the customer upon a payment being in either 
	 * an indeterminable or pending state. Payment methods which are not "real-time" 
	 * (for example, Laschrift/ELV, �berweisung) use this status.
	 * @param string $value (optional) used when setting
	 * @return InterfaceOptions or string urlRedirectPending
	 */
	public function urlRedirectPending($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * urlCallback setter/getter
	 * A URL to your system which we can send Event Hook Notifications (EHNs) to. If this parameter 
	 * is provided, it will be used instead of any statically configured EHN URLs.
	 * @param string $value (optional) used when setting
	 * @return InterfaceOptions or string urlCallback
	 */
	public function urlCallback($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
}