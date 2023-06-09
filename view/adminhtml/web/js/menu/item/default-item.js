define([
    'Magento_Ui/js/form/components/button',
    'underscore'
], function (Button, _) {
    'use strict';

    return Button.extend({
        defaults: {
            itemId: null,
            menuId: null,
            listens: {
                entity: 'changeVisibility'
            }
        },

        /**
         * Apply action on target component,
         * but previously create this component from template if it is not existed
         *
         * @param {Object} action - action configuration
         */
        applyAction: function (action) {
            if (action.params && action.params[0]) {
                action.params[0]['item_id'] = this.itemId;
                action.params[0]['menu_id'] = this.menuId;
            } else {
                action.params = [{
                    'item_id': this.itemId,
                    'menu_id': this.menuId
                }];
            }

            this._super();
        },

        /**
         * Change visibility of the default address shipping/billing blocks
         *
         * @param {Object} entity - customer address
         */
        changeVisibility: function (entity) {
            this.visible(!_.isEmpty(entity));
        }
    });
});
