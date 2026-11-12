define([
 'jquery'
], function ($) {
    'use strict';
    return function (target) {
        $.validator.addMethod(
            'cc-cointopay-validate-total',
            function (value) {
                if(/^\d+\.\d+$|^\d+$/.test(value) && value != 0){
					return true;
				}
            },
            $.mage.__('Please enter a valid amount.')
        );
        return target;
    };
});