<?php
namespace Paynova\response\model;

use Paynova\model\Instance;

/**
 * class ProfileCardDetails
 * part of service: 	see response/model/ProfileCardDetailsCollection
 *
 *
 * @package Paynova/response/model
 * @copyright Paynova 2014
 *
 */
class ProfileCardDetails extends Instance {
	
	/**
	 * @see model/Instance::__construct()
	 */
	public function __construct() {
		parent::__construct(array(
				"cardId", "expirationYear", "expirationMonth",
				"firstSix","lastFour"
		));
	}
	
	/**
	 * cardId getter
	 * Paynova's unique identifier for the profile card stored within a customer 
	 * profile. This id should be used for subsequent requests to Paynova involving 
	 * profile card payments.
	 * @return string cardId
	 */
	public function cardId() { return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * expirationYear getter
	 * The four-digit expiration year of the card.
	 * @return string expirationYear
	 */
	public function expirationYear() { return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * expirationMonth getter
	 * The two-digit expiration month of the card.
	 * @return string expirationMonth
	 */
	public function expirationMonth() { return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * firstSix getter
	 * The first six digits of the card number (BIN/IIN).
	 * @return string firstSix
	 */
	public function firstSix() { return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * lastFour getter
	 * The last four digits of the card number.
	 * @return string lastFour
	 */
	public function lastFour() { return $this->setOrGet(__FUNCTION__,null); }
}