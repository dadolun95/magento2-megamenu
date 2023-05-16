<?php

namespace Dadolun\MegaMenu\Model\ResourceModel\Menu;

use Dadolun\MegaMenu\Model\ResourceModel\Menu as MenuResource;
use Dadolun\MegaMenu\Model\Menu;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Dadolun\MegaMenu\Model\ResourceModel\Menu
 */
class Collection extends AbstractCollection {

    protected function _construct() {
        $this->_init(
            Menu::class,
            MenuResource::class
        );
    }

    /**
     * @return AbstractCollection
     * @throws \Exception
     */
    protected function _afterLoad()
    {
        parent::_afterLoad();
        foreach($this->_items as $item) {
            $this->getResource()->loadStores($item);
        }
        return $this;
    }
}
