/**
 * Copyright © 2018 Cointopay. All rights reserved.
 * See COPYING.txt for license details.
 */
/*browser:true*/
/*global define*/
define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list',
        'jquery'
    ],
    function (
        Component,
        rendererList,
        $
    ) {
        'use strict';
        $(function() {
            $(document).on('change', ".cointopaybank_coin_val", function () {
                var coinVal = $(this).val();
                    $.ajax ({
                        url: '/paymentcointopaybank/coin/',
                        showLoader: true,
                        data: {coinId:coinVal, type:'security'},
                        type: "POST",
                        success: function(result) {
                            
                        }
                    });
                });
            });
        rendererList.push(
            {
                type: 'cointopaybank_gateway',
                component: 'CointopayBank_PaymentGateway/js/view/payment/method-renderer/cointopaybank_gateway'
            }
        );
        /** Add view logic here if needed */
        return Component.extend({});
    }
);