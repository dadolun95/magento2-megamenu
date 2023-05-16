<?php
namespace Dadolun\MegaMenu\Block\Adminhtml;

use Magento\Catalog\Block\Adminhtml\Product;

/**
 * Class Menu
 * @package Dadolun\MegaMenu\Block\Adminhtml
 */
class Menu extends \Magento\Backend\Block\Widget\Container
{
    /**
     * Prepare button and grid
     *
     * @return Product
     */
    protected function _prepareLayout()
    {
        $addButtonProps = [
            'id' => 'add_new_menu',
            'label' => __('Add New MegaMenu'),
            'class' => 'primary',
            'button_class' => '',
            'onclick' => "setLocation('" . $this->_getMenuCreateUrl() . "')",
            'class_name' => \Magento\Backend\Block\Widget\Button::class
        ];
        $this->buttonList->add('add_new', $addButtonProps);

        return parent::_prepareLayout();
    }

    /**
     * Retrieve product create url by specified product type
     *
     * @param string $type
     * @return string
     */
    protected function _getMenuCreateUrl()
    {
        return $this->getUrl(
            'dadolunmenu/menu/new'
        );
    }
}
