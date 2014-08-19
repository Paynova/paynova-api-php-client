<?php
namespace Paynova\request\model;

use Paynova\model\Instance;

/**
 * class ProfileCard
 * part of service: 	see Paynova/request/model/ProfilePaymentOptions
 *
 *
 * @package Paynova/request/model
 * @copyright Paynova 2014
 *
 */
class ProfileCard extends Instance {
	
	/**
	 * @see model/Instance::__construct()
	 */
	public function __construct() {
		parent::__construct(array(
				"cardId","cvc"
		));
	}
	
	/**
	 * cardId setter/getter
	 * Paynova's unique id for the card stored in the customer profile.
	 * @param string $value (optional) used when setting
	 * @return ProfileCard or string cardId
	 */
	public function cardId($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * cvc setter/getter
	 * Depending on the payment channel and your acquiring agreement, the card CVC 
	 * (three or four digit security code) may be required. Paynova will inform you if 
	 * you are required to send this information.
	 * @param string $value (optional) used when setting
	 * @return ProfileCard or string cvc
	 */
	public function cvc($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
}
	