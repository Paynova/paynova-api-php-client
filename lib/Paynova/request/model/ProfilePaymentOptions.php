<?php
/**
 * class ProfilePaymentOptions
 * part of service: 	Initialize Payment 
 *						 
 *
 * @package Paynova/model/request
 * @copyright Paynova 2014
 */
class ProfilePaymentOptions extends Instance {
	
	/**
	 * @see model/Instance::__construct()
	 */
	public function __construct() {
		parent::__construct(array(
				"profileId",
				"profileCard"=>"ProfileCard",
				"displaySaveProfileCardOption"
		));
	}
	
	/**
	 * profileId setter/getter
	 * Your identifier for the customer profile.
	 * @param string $value (optional) used when setting
	 * @return ProfilePaymentOptions or string profileId
	 */
	public function profileId($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * profileCard setter/getter
	 * The profile card use in the payment. If the payment is to be performed on a stored profile card, 
	 * this parameter is required.
	 * @param ProfileCard $object (optional) used when setting
	 * @return ProfileCard
	 */
	public function profileCard($object = null) {
		if($object != null)Util::validateObject($object, "ProfileCard"); 
		return $this->setOrGet(__FUNCTION__,$object); 
	}
	
	/**
	 * displaySaveProfileCardOption setter/getter
	 * If you would like the customer to choose whether or not to save their card in your customer profile 
	 * on Paynova's page, then set this option to true
	 * @param boolean $bool (optional) used when setting
	 * @return ProfilePaymentOptions or boolean
	 */
	public function displaySaveProfileCardOption($bool = null) { return $this->setOrGet(__FUNCTION__,$bool); }
}