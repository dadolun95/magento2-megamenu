<?php
namespace Dadolun\MegaMenu\Ui\DataProvider\Menu\Form\Modifier;

use Magento\Ui\DataProvider\Modifier\ModifierInterface;

/**
 * Class MenuItems
 * @package Dadolun\MegaMenu\Ui\DataProvider\Menu\Form\Modifier
 */
class MenuItems implements ModifierInterface
{


    public function __construct() {}

    /**
     * @inheritdoc
     * @since 101.0.0
     */
    public function modifyData(array $data)
    {
        return $data;
    }

    /**
     * @inheritdoc
     * @since 101.0.0
     */
    public function modifyMeta(array $meta)
    {
        return $meta;
    }
}
