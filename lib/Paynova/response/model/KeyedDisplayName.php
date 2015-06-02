<?php
namespace Paynova\response\model;

use Paynova\model\Instance;

/**
 * KeyedDisplayName
 * 
 * 
 * @package Paynova/response/model
 * @copyright Paynova 2015
 *
 */
class KeyedDisplayName extends Instance {
	
	
	/**
	 * @see model/Instance::__construct()
	 */
	public function __construct() {
		parent::__construct(array(
			"key","displayName"
		));
	}
	
	
	/**
	 * key getter
	 * @return return key
	 */
	public function key() { return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * displayName getter
	 * @return return displayName
	 */
	public function displayName() { return $this->setOrGet(__FUNCTION__,null); }
	
}