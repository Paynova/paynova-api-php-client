<?php
namespace Paynova\response\model;

use Paynova\model\PropertyItemCollection;

/**
 * class LinkCollection can hold a collection of Link's
 * 
 *
 * @package Paynova/response/model
 * @copyright Paynova 2015
 */


class LinkCollection extends PropertyItemCollection {
	
	/**
	 * @see util/PaynovaCollection::__construct()
	 */
	public function __construct() {
		parent::__construct(self::getClassnameOfTypeToStore());
	}
	
	/**
	 * @see model/PropertyItemCollection::getClassnameOfTypeToStore()
	 * @return string
	 */
	public static function getClassnameOfTypeToStore() {
		return "Paynova\\response\\model\\Link";
	}
	
}