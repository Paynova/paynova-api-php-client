<?php
namespace Paynova\response;
/**
 *
 * service: RefundPayment
 * type: 	response
 *
 * This class will be used in response to RequestRefundPayment
 *
 * @package Paynova/response
 * @copyright Paynova 2014
 */

class ResponseRefundPayment extends Response {
	
	
	/**
	 * @see response/Response::__construct()
	 */
	public function __construct() {
		parent::__construct(array(
				"totalAmountRefunded","totalAmountPendingRefund","canRefundAgain",
				"amountRemainingForRefund","transactionId","batchId",
				"acquirerId"
		));
	}
	
	/**
	 * totalAmountFinalized getter
	 * The amount that have been refunded
	 * @return float totalAmountRefunded
	 */
	public function totalAmountRefunded() {  return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * totalAmountPendingRefund getter
	 * The amount that previously have been refunded with the same orderId/transactionId
	 * @return float totalAmountPendingRefund
	 */
	public function totalAmountPendingRefund() {  return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * canRefundAgain getter
	 * If finalize can be called again using the same orderId/transactionId
	 * @return boolean canRefundAgain
	 */
	public function canRefundAgain() {  return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * amountRemainingForRefund getter
	 * The amount that remains to be refunded with same orderId/transactionId
	 * @return string amountRemainingForRefund
	 */
	public function amountRemainingForRefund() {  return $this->setOrGet(__FUNCTION__,null); }
	
	/**
	 * transactionId getter
	 * Paynova's unique transaction id for the refund. This property is only returned for successful 
	 * operations.
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