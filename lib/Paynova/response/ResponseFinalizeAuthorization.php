<?php
namespace Paynova\response;
/**
 *
 * service: FinalizeAuthorization
 * type: 	response
 *
 * This class will be used in response to RequestFinalizeAuthorization
 * Hold only read-properties
 *
 * @package Paynova/response
 * @copyright Paynova 2014
 */
class ResponseFinalizeAuthorization extends Response {
	
	/**
	 * @see response/Response::__construct()
	 */
	public function __construct() {
		parent::__construct(array(
				"totalAmountFinalized","totalAmountPendingFinalization","canFinalizeAgain",
				"amountRemainingForFinalization","transactionId","batchId",
				"acquirerId"
		));
	}
	
	/**
	 * totalAmountFinalized getter
	 * The amount that have been finalized
	 * @return float totalAmountFinalized
	 */
	public function totalAmountFinalized() {  return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * totalAmountPendingFinalization getter
	 * The amount that previously have been finalized with the same orderId/transactionId
	 * @return float totalAmountPendingFinalization
	 */
	public function totalAmountPendingFinalization() {  return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * canFinalizeAgain getter
	 * If finalize can be called again using the same orderId/transactionId
	 * @return boolean canFinalizeAgain
	 */
	public function canFinalizeAgain() {  return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * amountRemainingForFinalization getter
	 * The amount that remains to be finalized with same orderId/transactionId
	 * If canFinalizeAgain is false, the value for this property will be 0.00 
	 * @return string amountRemainingForFinalization
	 */
	public function amountRemainingForFinalization() {  return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * transactionId getter
	 * Paynova's transaction id for the finalization. Note that for some transactions, this id may be 
	 * the same as the original authorization transaction id.
	 * @return string transactionId
	 */
	public function transactionId() {  return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * batchId getter
	 * 
	 * @return string batchId
	 */
	public function batchId() {  return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * acquirerId getter
	 * 
	 * @return string acquirerId
	 */
	public function acquirerId() {  return $this->setOrGet(__FUNCTION__,null); }
	
}