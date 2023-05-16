<?php

namespace Dadolun\MegaMenu\Model\MenuItem\Source;

use \Dadolun\MegaMenu\Api\Data\MenuItemInterface;

/**
 * Class EntityType
 * @package Dadolun\MegaMenu\Model\Source
 */
class EntityType implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => MenuItemInterface::ITEM_TYPE_MAPPING[MenuItemInterface::ENTITY_TYPE_CATEGORY],
                'label' => __('Category')
            ],
            [
                'value' => MenuItemInterface::ITEM_TYPE_MAPPING[MenuItemInterface::ENTITY_TYPE_CMS_PAGE],
                'label' => __('Cms page')
            ],
            [
                'value' => MenuItemInterface::ITEM_TYPE_MAPPING[MenuItemInterface::ENTITY_TYPE_CUSTOM],
                'label' => __('Custom Link')
            ]
        ];
    }

    /**
     * @return array
     */
    public function toArray() {
        return [
            MenuItemInterface::ITEM_TYPE_MAPPING[MenuItemInterface::ENTITY_TYPE_CATEGORY]  => __('Category'),
            MenuItemInterface::ITEM_TYPE_MAPPING[MenuItemInterface::ENTITY_TYPE_CMS_PAGE] => __('Cms page'),
            MenuItemInterface::ITEM_TYPE_MAPPING[MenuItemInterface::ENTITY_TYPE_CUSTOM] => __('Custom Link')
        ];
    }
}
