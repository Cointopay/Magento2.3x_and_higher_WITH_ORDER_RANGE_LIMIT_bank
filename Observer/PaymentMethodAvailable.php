<?php
/**
 * Copyright © 2018 Cointopay. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace CointopayCC\PaymentGateway\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class PaymentMethodAvailable implements ObserverInterface
{
	
	/**
    * @var \Magento\Framework\App\Config\ScopeConfigInterface
    */
    protected $scopeConfig;


     /**
    * @var $ctpMin
    **/
    protected $ctpMin;
	
     /**
    * @var $ctpMAx
    **/

    protected $ctpMAx;

     /**
    * COINTOPAY MIN AMOUNT
    */
    const XML_PATH_MIN_AMOUNT = 'payment/cointopaycc_gateway/cc_cointopay_min_amount';
	
     /**
    * COINTOPAY MAN AMOUNT
    */
    const XML_PATH_MAX_AMOUNT = 'payment/cointopaycc_gateway/cc_cointopay_max_amount';
	
	/*
    * @param \Magento\Framework\App\Config\ScopeConfigInterface    $scopeConfig
    */
    public function __construct (
	     \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
		$this->scopeConfig = $scopeConfig;
    }
	
    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $method = $observer->getEvent()->getMethodInstance()->getCode();
        
        if ($method == 'cointopaycc_gateway') {
            
			$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
			$cart = $objectManager->get('Magento\Checkout\Model\Cart');
			$scopeConfig = $objectManager->get('Magento\Framework\App\Config\ScopeConfigInterface');
            $grandTotal = $cart->getQuote()->getGrandTotal();
            if (!empty($grandTotal)) {
				$storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
				$this->ctpMin = $this->scopeConfig->getValue(self::XML_PATH_MIN_AMOUNT, $storeScope);
				$this->ctpMax = $this->scopeConfig->getValue(self::XML_PATH_MAX_AMOUNT, $storeScope);
                //list($grandTotal, $decimals) = explode(".", $grandTotal);

                if ($grandTotal >= $this->ctpMin && $grandTotal <= $this->ctpMax) {
                    $result = $observer->getEvent()->getResult();
					$result->setData('is_available', true);
                } else {
                    $result = $observer->getEvent()->getResult();
					$result->setData('is_available', false);
                }
            }
               
        }
    }
}
