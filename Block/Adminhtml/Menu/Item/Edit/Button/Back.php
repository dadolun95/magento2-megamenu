<?php

namespace Dadolun\MegaMenu\Block\Adminhtml\Menu\Item\Edit\Button;

/**
 * Class Back
 * @package Dadolun\MegaMenu\Block\Adminhtml\Menu\Item\Edit\Button
 */
class Back extends Generic
{
    /**
     * Get Button Data
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => (
                !is_null($this->getMenuId())
                    ? sprintf("location.href = '%s';", $this->getBackUrl())
                    : ''
            ),
            'class' => 'back',
            'sort_order' => 10,
            'data_attribute' => [
                'mage-init' => [
                    'Magento_Ui/js/form/button-adapter' => [
                        'actions' => [
                            [
                                'targetName' => 'dadolunmenu_menu_form.dadolunmenu_menu_form.items.dadolunmenu_menu_item_update_modal',
                                'actionName' => 'closeModal'
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
    /**
     * Get URL for back
     *
     * @return string
     */
    private function getBackUrl()
    {
        return $this->getUrl('dadolunmenu/menu/edit', ['menu_id' => $this->getMenuId()]);
    }
}
