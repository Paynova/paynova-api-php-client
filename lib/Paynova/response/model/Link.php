<?php
namespace Paynova\response\model;

use Paynova\model\Instance;

/**
 * Link
 * 
 * 
 * @package Paynova/response/model
 * @copyright Paynova 2015
 *
 */
class Link extends Instance {
	
	
	/**
	 * @see model/Instance::__construct()
	 */
	public function __construct() {
		parent::__construct(array(
			"label","uri"
		));
	}
	
	
	/**
	 * label getter
	 * @return return label
	 */
	public function label() { return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * uri getter
	 * @return return uri
	 */
	public function uri() { return $this->setOrGet(__FUNCTION__,null); }
	
}