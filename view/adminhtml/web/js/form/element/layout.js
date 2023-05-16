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

        selectLayoutOption: function(id) {
            if (id === null) {
                if (!_.isUndefined(this.value())) {
                    switch (this.value()) {
                        case "0":
                            $('div[data-index="content"]').hide();
                            $('div[data-index="content_second"]').hide();
                            $('div[data-index="content_third"]').hide();
                            $('div[data-index="content_desktop_width"]').hide();
                            $('div[data-index="content_tablet_width"]').hide();
                            $('div[data-index="content_second_desktop_width"]').hide();
                            $('div[data-index="content_second_tablet_width"]').hide();
                            $('div[data-index="content_third_desktop_width"]').hide();
                            $('div[data-index="content_third_tablet_width"]').hide();
                            $('div[data-index="content_additional_classes"]').hide();
                            $('div[data-index="content_second_additional_classes"]').hide();
                            $('div[data-index="content_third_additional_classes"]').hide();
                            break;
                        case "1":
                            $('div[data-index="content"]').show();
                            $('div[data-index="content_second"]').hide();
                            $('div[data-index="content_third"]').hide();
                            $('div[data-index="content_additional_classes"]').show();
                            $('div[data-index="content_second_additional_classes"]').hide();
                            $('div[data-index="content_third_additional_classes"]').hide();
                            $('div[data-index="content_desktop_width"]').show();
                            $('div[data-index="content_tablet_width"]').show();
                            $('div[data-index="content_second_desktop_width"]').hide();
                            $('div[data-index="content_second_tablet_width"]').hide();
                            $('div[data-index="content_third_desktop_width"]').hide();
                            $('div[data-index="content_third_tablet_width"]').hide();
                            break;
                        case "2":
                            $('div[data-index="content"]').show();
                            $('div[data-index="content_second"]').show();
                            $('div[data-index="content_third"]').hide();
                            $('div[data-index="content_additional_classes"]').show();
                            $('div[data-index="content_second_additional_classes"]').show();
                            $('div[data-index="content_third_additional_classes"]').hide();
                            $('div[data-index="content_desktop_width"]').show();
                            $('div[data-index="content_tablet_width"]').show();
                            $('div[data-index="content_second_desktop_width"]').show();
                            $('div[data-index="content_second_tablet_width"]').show();
                            $('div[data-index="content_third_desktop_width"]').hide();
                            $('div[data-index="content_third_tablet_width"]').hide();
                            break;
                        case "3":
                            $('div[data-index="content"]').show();
                            $('div[data-index="content_second"]').show();
                            $('div[data-index="content_third"]').show();
                            $('div[data-index="content_additional_classes"]').show();
                            $('div[data-index="content_second_additional_classes"]').show();
                            $('div[data-index="content_third_additional_classes"]').show();
                            $('div[data-index="content_desktop_width"]').show();
                            $('div[data-index="content_tablet_width"]').show();
                            $('div[data-index="content_second_desktop_width"]').show();
                            $('div[data-index="content_second_tablet_width"]').show();
                            $('div[data-index="content_third_desktop_width"]').show();
                            $('div[data-index="content_third_tablet_width"]').show();
                            break;
                    }
                }
            } else {
                switch ($("#" + id).val()) {
                    case "0":
                        $('div[data-index="content"]').hide();
                        $('div[data-index="content_second"]').hide();
                        $('div[data-index="content_third"]').hide();
                        $('div[data-index="content_desktop_width"]').hide();
                        $('div[data-index="content_tablet_width"]').hide();
                        $('div[data-index="content_second_desktop_width"]').hide();
                        $('div[data-index="content_second_tablet_width"]').hide();
                        $('div[data-index="content_third_desktop_width"]').hide();
                        $('div[data-index="content_third_tablet_width"]').hide();
                        $('div[data-index="content_additional_classes"]').hide();
                        $('div[data-index="content_second_additional_classes"]').hide();
                        $('div[data-index="content_third_additional_classes"]').hide();
                        break;
                    case "1":
                        $('div[data-index="content"]').show();
                        $('div[data-index="content_second"]').hide();
                        $('div[data-index="content_third"]').hide();
                        $('div[data-index="content_additional_classes"]').show();
                        $('div[data-index="content_second_additional_classes"]').hide();
                        $('div[data-index="content_third_additional_classes"]').hide();
                        $('div[data-index="content_desktop_width"]').show();
                        $('div[data-index="content_tablet_width"]').show();
                        $('div[data-index="content_second_desktop_width"]').hide();
                        $('div[data-index="content_second_tablet_width"]').hide();
                        $('div[data-index="content_third_desktop_width"]').hide();
                        $('div[data-index="content_third_tablet_width"]').hide();
                        break;
                    case "2":
                        $('div[data-index="content"]').show();
                        $('div[data-index="content_second"]').show();
                        $('div[data-index="content_third"]').hide();
                        $('div[data-index="content_additional_classes"]').show();
                        $('div[data-index="content_second_additional_classes"]').show();
                        $('div[data-index="content_third_additional_classes"]').hide();
                        $('div[data-index="content_desktop_width"]').show();
                        $('div[data-index="content_tablet_width"]').show();
                        $('div[data-index="content_second_desktop_width"]').show();
                        $('div[data-index="content_second_tablet_width"]').show();
                        $('div[data-index="content_third_desktop_width"]').hide();
                        $('div[data-index="content_third_tablet_width"]').hide();
                        break;
                    case "3":
                        $('div[data-index="content"]').show();
                        $('div[data-index="content_second"]').show();
                        $('div[data-index="content_third"]').show();
                        $('div[data-index="content_additional_classes"]').show();
                        $('div[data-index="content_second_additional_classes"]').show();
                        $('div[data-index="content_third_additional_classes"]').show();
                        $('div[data-index="content_desktop_width"]').show();
                        $('div[data-index="content_tablet_width"]').show();
                        $('div[data-index="content_second_desktop_width"]').show();
                        $('div[data-index="content_second_tablet_width"]').show();
                        $('div[data-index="content_third_desktop_width"]').show();
                        $('div[data-index="content_third_tablet_width"]').show();
                        break;
                }
            }
        },
    });
});
