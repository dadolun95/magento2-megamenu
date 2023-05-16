<?php

namespace Dadolun\MegaMenu\Api;

use Dadolun\MegaMenu\Api\Data\MenuInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Interface MenuRepositoryInterface
 * @package Dadolun\MegaMenu\Api
 */
interface MenuRepositoryInterface
{
    /**
     * @param AbstractModel $menu
     * @return MenuInterface|null
     */
    public function save(AbstractModel $menu);

    /**
     * @param $menuId
     * @return MenuInterface|null
     */
    public function getById($menuId);

    /**
     * @param AbstractModel $menu
     * @return void
     */
    public function delete(AbstractModel $menu);
}
