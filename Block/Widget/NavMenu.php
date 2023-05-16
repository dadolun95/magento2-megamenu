<?php

namespace Dadolun\MegaMenu\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Dadolun\MegaMenu\Block\Html\MenuType\Nav;

/**
 * Class NavMenu
 * @package Dadolun\MegaMenu\Block\Widget
 */
class NavMenu extends Template implements BlockInterface
{

    /**
     * @var string
     */
    protected $_template = "widget/menu/nav.phtml";

    /**
     * @var Nav
     */
    protected $nav;

    /**
     * NavMenu constructor.
     * @param Nav $nav
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        Nav $nav,
        Template\Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->nav = $nav;
    }


    /**
     * @param $menuId
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getMenuHtml($menuId) {
        return $this->nav->getHtml($this->nav->getMenuData($menuId));
    }

}
