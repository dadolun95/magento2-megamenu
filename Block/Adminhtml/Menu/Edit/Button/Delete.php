<?php

namespace Dadolun\MegaMenu\Block\Adminhtml\Menu\Edit\Button;

use Magento\Ui\Component\Control\Container;

/**
 * Class Delete
 * @package Dadolun\MegaMenu\Block\Adminhtml\Menu\Edit\Button
 */
class Delete extends Generic
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getBlockId()) {
            $data = [
                'label' => __('Delete'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\''
                    . __('Are you sure you want to delete this menu ?')
                    . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['menu_id' => $this->getBlockId()]);
    }
}
