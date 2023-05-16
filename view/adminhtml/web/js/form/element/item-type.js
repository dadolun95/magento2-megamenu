define([
    'jquery',
    'underscore',
    'Magento_Ui/js/form/element/select'
], function ($, _, Select) {
    'use strict';

    return Select.extend({
        defaults: {
            customName: '${ $.parentName }.${ $.index }_input'
        },

        selectOption: function(id) {
            if (id === null) {
                if (!_.isUndefined(this.value())) {
                    switch(this.value()) {
                        case "1":
                            $('div[data-index="linked_cmspage"]').hide();
                            $('div[data-index="linked_category"]').show();
                            $('div[data-index="custom_url"]').hide();
                            break;
                        case "2":
                            $('div[data-index="linked_cmspage"]').show();
                            $('div[data-index="linked_category"]').hide();
                            $('div[data-index="custom_url"]').hide();
                            break;
                        case "0":
                            $('div[data-index="linked_cmspage"]').hide();
                            $('div[data-index="linked_category"]').hide();
                            $('div[data-index="custom_url"]').show();
                            break;
                    }
                }
            } else {
                switch ($("#" + id).val()) {
                    case "1":
                        $('div[data-index="linked_cmspage"]').hide();
                        $('div[data-index="linked_category"]').show();
                        $('div[data-index="custom_url"]').hide();
                        break;
                    case "2":
                        $('div[data-index="linked_cmspage"]').show();
                        $('div[data-index="linked_category"]').hide();
                        $('div[data-index="custom_url"]').hide();
                        break;
                    case "0":
                        $('div[data-index="linked_cmspage"]').hide();
                        $('div[data-index="linked_category"]').hide();
                        $('div[data-index="custom_url"]').show();
                        break;
                }
            }
        },
    });
});
