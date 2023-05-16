<?php

namespace Dadolun\MegaMenu\Model\ResourceModel\MenuItem;

use Dadolun\MegaMenu\Model\ResourceModel\MenuItem as MenuItemResource;
use Dadolun\MegaMenu\Model\MenuItem;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Dadolun\MegaMenu\Model\ResourceModel\MenuItem
 */
class Collection extends AbstractCollection {

    protected function _construct() {
        $this->_init(
            MenuItem::class,
            MenuItemResource::class
        );
    }
}
