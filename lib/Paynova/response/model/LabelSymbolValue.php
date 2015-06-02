<?php
namespace Paynova\response\model;

use Paynova\model\Instance;

/**
 * LabelSymbolValue
 * 
 * 
 * @package Paynova/response/model
 * @copyright Paynova 2015
 *
 */
class LabelSymbolValue extends Instance {
	
	
	/**
	 * @see model/Instance::__construct()
	 */
	public function __construct() {
		parent::__construct(array(
			"label","symbol","value"
		));
	}
	
	/**
	 * label getter
	 * @return return label
	 */
	public function label() { return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	* symbol getter
	* @return return symbol
	*/
	public function symbol() { return $this->setOrGet(__FUNCTION__,null); }
	
	
	/**
	* value getter
	* @return return value
	*/
	public function value() { return $this->setOrGet(__FUNCTION__,null); }
	
}