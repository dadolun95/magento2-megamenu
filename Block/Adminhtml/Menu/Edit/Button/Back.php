<?php

namespace Dadolun\MegaMenu\Block\Adminhtml\Menu\Edit\Button;

/**
 * Class Back
 * @package Dadolun\MegaMenu\Block\Adminhtml\Menu\Edit\Button
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
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10
        ];
    }
    /**
     * Get URL for back
     *
     * @return string
     */
    private function getBackUrl()
    {
        return $this->getUrl('*/*/');
    }
}
