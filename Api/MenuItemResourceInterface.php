<?php

namespace Dadolun\MegaMenu\Api;

use Magento\Framework\Model\AbstractModel;

/**
 * Interface MenuItemResourceInterface
 * @package Dadolun\MegaMenu\Api
 */
interface MenuItemResourceInterface
{
    /**
     * @param AbstractModel $object
     * @return mixed
     */
    public function save(AbstractModel $object);

    /**
     * @param AbstractModel $object
     * @param $value
     * @param null $field
     * @return mixed
     */
    public function load(AbstractModel $object, $value, $field = null);

    /**
     * @param AbstractModel $object
     * @return mixed
     */
    public function delete(AbstractModel $object);
}
