<?php

namespace Dadolun\MegaMenu\Api;

use Dadolun\MegaMenu\Api\Data\MenuItemInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Interface MenuItemRepositoryInterface
 * @package Dadolun\MegaMenu\Api
 */
interface MenuItemRepositoryInterface
{
    /**
     * @param AbstractModel $menuItem
     * @return MenuItemInterface|null
     */
    public function save(AbstractModel $menuItem);

    /**
     * @param $menuItemId
     * @return MenuItemInterface|null
     */
    public function getById($menuItemId);

    /**
     * @param AbstractModel $menuItem
     * @return void
     */
    public function delete(AbstractModel $menuItem);
}
