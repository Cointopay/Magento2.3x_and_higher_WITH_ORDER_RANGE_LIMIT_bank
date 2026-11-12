<?php 
namespace CointopayCC\PaymentGateway\Api;
 
 
interface CointopayOrdersManagementInterface {


	/**
	 * GET for Post api
	 * @param string $param
	 * @return string
	 */
	
	public function getCoin($param);
}
