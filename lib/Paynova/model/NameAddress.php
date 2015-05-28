<?php
namespace Paynova\model;

use Paynova\model\Instance;
use Paynova\util\Util;

class NameAddress extends Instance{
	
	
	/**
	 * @see model/Instance::__construct()
	 */
	public function __construct() {
		parent::__construct(array(
			"name"		=> "Paynova\\model\\Name",
			"address"	=> "Paynova\\model\\Address"
		));	
	}
	
	/**
	 * name setter/getter
	 * The name of the customer and/or company.
	 * @param Name $object (optional) used when setting
	 * @return Name
	 */
	public function name($object = null) { 
		if($object!=null)Util::validateObject($object,"Paynova\\model\\Name");
		return $this->setOrGet(__FUNCTION__,$object); 
	}
	
	/**
	 * address setter/getter
	 * The bill-to address.
	 * @param Name $mixed (optional) used when setting
	 * @return Address
	 */
	public function address($object = null) { 
		if($object!=null)Util::validateObject($object,"Paynova\\model\\Address");
		return $this->setOrGet(__FUNCTION__,$object); 
	}
}