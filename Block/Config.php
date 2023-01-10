<?php
/**
 * Copyright © 2018 Cointopay. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace CointopayBank\PaymentGateway\Block;

use Magento\Framework\Phrase;
use Magento\Payment\Block\ConfigurableInfo;
use CointopayBank\PaymentGateway\Gateway\Response\FraudHandler;

class Config extends ConfigurableInfo
{
    /**
     * Returns label
     *
     * @param string $field
     * @return Phrase
     */
    protected function getLabel($field)
    {
        return __($field);
    }

    /**
     * Returns value view
     *
     * @return string | URL
     */
    public function getAjaxUrl()
    {
        return $this->getUrl("cointopaybankcoins");
    }

    /**
     * Returns value view
     *
     * @return string | URL
     */
    public function getCoinsPaymentUrl()
    {
        return $this->getUrl("paymentcointopaybank");
    }

    /**
     * Returns value view
     *
     * @return string | Status
     */
    public function cointopaybankReference ($status) {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); 
        $customerSession = $objectManager->get('Magento\Customer\Model\Session');
        if (isset($customerSession) && isset($status)) {
            return json_encode('cointopaybank_ref');
        }
        return false;
    }
}
