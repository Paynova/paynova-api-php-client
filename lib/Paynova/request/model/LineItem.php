<?php
/**
 * class LineItem
 * part of service: 	see Paynova/request/model/LineItemCollection
 * 
 * 
 * @package Paynova/request/model
 * @copyright Paynova 2014
 *
 */
class LineItem extends Instance {
	
	/**
	 * Constanst used for lineItemGroupKey
	 */
	const GROUP_KEY_EXTRA_ 		= "_EXTRA_";
	const GROUP_KEY_DISCOUNT_ 	= "_DISCOUNT_";
	const GROUP_KEY_SHIPPING_ 	= "_SHIPPING_";
	const GROUP_KEY_TAX_ 		= "_TAX_";
	const GROUP_KEY_ITEM_ 		= "_ITEM_";




	/**
	 * @see model/Instance::__construct()
	 */
	public function __construct() {
		parent::__construct(array(
				"id","articleNumber","name","description",
				"productUrl","quantity","unitMeasure","unitAmountExcludingTax",
				"taxPercent","totalLineTaxAmount","totalLineAmount",
				"lineItemGroupKey",
				"travelData"=>"TravelData"
		));
	}
	
	/**
	 * id setter/getter
	 * The id for this line item. This value must be unique per collection of line items.
	 * @param string $value (optional) used when setting
	 * @return LineItem or string id
	 */
	public function id($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	
	/**
	 * articleNumber setter/getter
	 * The article/product number for the item being sold.
	 * Validation: Minimum length = 1, Maximum length = 50
	 * @param string $value (optional) used when setting
	 * @return LineItem or string articleNumber
	 */
	public function articleNumber($value = null) {return $this->setOrGet(__FUNCTION__,$value);}
	
	/**
	 * name setter/getter
	 * The name of the item being sold.
	 * Validation: Minimum length = 1, Maximum length = 255
	 * @param string $value (optional) used when setting
	 * @return LineItem or string name
	 */
	public function name($value = null) {return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * description setter/getter
	 * The description of the item being sold.
	 * Validation: Minimum length (when present) = 1, Maximum length = 255
	 * @param string $value (optional) used when setting
	 * @return LineItem or string description
	 */
	public function description($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * productUrl setter/getter
	 * The URL on your website to the item being sold.
	 * @param string $value (optional) used when setting
	 * @return LineItem or string productUrl
	 */
	public function productUrl($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	
	/**
	 * quantity setter/getter
	 * The number of items being sold at this price.
	 * @param int $value (optional) used when setting
	 * @return LineItem or int quantity
	 */
	public function quantity($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * unitMeasure setter/getter
	 * Example Values: meters, pieces, st., ea.
	 * @param string $value (optional) used when setting
	 * @return LineItem or string unitMeasure
	 */
	public function unitMeasure($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	
	/**
	 * unitAmountExcludingTax setter/getter
	 * The price of each unit, excluding tax.
	 * @param float $value (optional) used when setting
	 * @return LineItem or float unitAmountExcludingTax
	 */
	public function unitAmountExcludingTax($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	
	/**
	 * taxPercent setter/getter
	 * The tax/VAT percentage for the item being sold.
	 * @param int $value (optional) used when setting
	 * @return LineItem or int taxPercent
	 */
	public function taxPercent($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	
	/**
	 * totalLineTaxAmount setter/getter
	 * The total tax/VAT amount charged for this line.
	 * @param float $value (optional) used when setting
	 * @return LineItem or float totalLineTaxAmount
	 */
	public function totalLineTaxAmount($value = null) { return $this->setOrGet(__FUNCTION__,$value);}
	
	
	/**
	 * totalLineAmount setter/getter
	 * The total amount charged for this line, including tax/VAT (quantity * unitAmountExcludingTax + calculated tax).
	 * @param float $value (optional) used when setting
	 * @return LineItem or float totalLineAmount
	 */
	public function totalLineAmount($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * travelData setter/getter
	 * The line item group that this line item belongs to.
	 * See GROUP_KEY_xxx_ constants in this class, those will be translated to
	 * the specified language
	 * @param string $value (optional) used when setting
	 * @return LineItem or string lineItemGroupKey
	 */
	public function lineItemGroupKey($value = null) { return $this->setOrGet(__FUNCTION__,$value); }
	
	/**
	 * travelData setter/getter
	 * Travel information, if this line item is related to a booking-of-travel.
	 * @param TravelData $object (optional) used when setting
	 * @return TravelData
	 */
	public function travelData($object = null) {
		if($object != null)Util::validateObject($object,"TravelData"); 
		return $this->setOrGet(__FUNCTION__,$object); 
	}
}