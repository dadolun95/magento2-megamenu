<?php

namespace Dadolun\MegaMenu\Block\Adminhtml\Menu\Edit\Button;

use Magento\Ui\Component\Control\Button as UiButton;

/**
 * Class Save
 * @package Dadolun\MegaMenu\Block\Adminhtml\Menu\Edit\Button
 */
class Save extends Generic
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}
