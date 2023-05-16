<?php

namespace Dadolun\MegaMenu\Model\ResourceModel;

use Dadolun\MegaMenu\Api\MenuItemResourceInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class MenuItem
 * @package Dadolun\MegaMenu\Model\ResourceModel
 */
class MenuItem extends AbstractDb implements MenuItemResourceInterface {

    protected function _construct() {
        $this->_init('dadolun_menu_item', 'item_id');
    }
}
