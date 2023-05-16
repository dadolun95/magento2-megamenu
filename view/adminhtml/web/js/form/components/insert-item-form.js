define([
    'Magento_Ui/js/form/components/insert-form'
], function (Insert) {
    'use strict';

    return Insert.extend({
        defaults: {
            listens: {
                responseData: 'onResponse'
            },
            modules: {
                itemMegaMenuListing: '${ $.itemMegaMenuListingProvider }',
                itemMegaMenuModal: '${ $.itemMegaMenuModalProvider }'
            }
        },

        /**
         * Close modal, reload item menu listing and save menu item
         *
         * @param {Object} responseData
         */
        onResponse: function (responseData) {
            var data;

            if (!responseData.error) {
                this.itemMegaMenuModal().closeModal();
                this.itemMegaMenuListing().reload({
                    refresh: true
                });
            }
        },
    });
});
