<?php

namespace Dadolun\MegaMenu\Block\Html;

use Dadolun\MegaMenu\Api\Data\MenuInterface;
use Dadolun\MegaMenu\Block\Html\MenuType\Nav;
use Dadolun\MegaMenu\Model\MenuItem\Source\Layout;
use Dadolun\MegaMenu\Helper\Config;
use Dadolun\MegaMenu\Model\MenuItem;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class Topmenu
 * @package Dadolun\MegaMenu\Block\Html
 */
class Topmenu extends Nav
{

    /**
     * Path to template file in theme.
     *
     * @var string
     */
    protected $_template;

    /**
     * @var null
     */
    protected $menuItems = null;

    /**
     * @var bool
     */
    protected $isMobile = false;

    /**
     * @return MenuInterface|null
     */
    public function getMenu()
    {
        if ($this->configHelper->isMenuEnabled()) {
            $menuId = $this->configHelper->getMenu();
            return $this->getMenuData($menuId);
        }
        return null;
    }

    /**
     * @return bool|string
     */
    public function getMenuAlignment()
    {
        return $this->configHelper->getModuleConfigValue(Config::MENU_ALIGNMENT_CONFIG) ? $this->configHelper->getModuleConfigValue(Config::MENU_ALIGNMENT_CONFIG) : 'left';
    }

    /**
     * @return array
     */
    public function getAdditionalClasses()
    {
        $additionalClasses = [];
        if ($this->configHelper->getModuleConfigFlag(Config::FULLWIDTH_CONFIG)) {
            $additionalClasses[] = 'menu-fullwidth';
        }
        return $additionalClasses;
    }

    /**
     * @return string
     */
    public function toHtml() {
        $this->_template = 'Dadolun_MegaMenu::topmenu.phtml';
        return parent::toHtml();
    }

    /**
     * @param null $menu
     * @return string
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getHtml($menu = null)
    {
        $menuHtml = '';
        if (is_null($menu)) {
            $menu = $this->getMenu();
        }
        if ($this->menuItems === null) {
            /**
             * @var MenuItem[] $menuItems
             */
            $this->menuItems = $this->getMenuItems($menu);
        }
        foreach ($this->menuItems as $key => $menuItem) {
            $menuHtml .= $this->getChildItemHtml($menuItem, $this->menuItems, $key);
        }
        return $menuHtml;
    }

    /**
     * @param $menu
     * @return DataObject[]|null
     */
    private function getMenuItems($menu)
    {
        if (is_null($this->menuItems)) {
            $this->menuItems = $this->menuItemCollectionFactory->create()
                ->addFieldToFilter('menu_id', $menu->getId())
                ->addFieldToFilter('status', 1)
                ->setOrder('sort_order', 'ASC')
                ->getItems();
        }
        return $this->menuItems;
    }

    /**
     * @param $menuItem
     * @param null $menuItems
     * @param null $key
     * @return string
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    protected function getChildItemHtml($menuItem, $menuItems = null, $key = null) {
        $html = '';
        if ($menuItems !== null) {
            if (!isset($menuItems['link_memorized'])) {
                $menuItems[$key]['link_memorized'] = true;
                $menuItems[$key]['url'] = $this->getMenuItemUrl($menuItem);
                $menuItems[$key]['title'] = $menuItem->getTitle();
                $menuItems[$key]['classes'] = $menuItem->getLinkClasses();
            }
            $html .= '<li class="level0 nav-' . $key . ' first level-top ' . $menuItems[$key]['classes'] . '"><a href="' . $menuItems[$key]['url'] . '" class="level-top" title="' . $menuItems[$key]['title'] . '"><span>' . $menuItems[$key]['title'] . '</span></a>';
        } else {
            $itemUrl = $this->getMenuItemUrl($menuItem);
            $itemTitle = $menuItem->getTitle();
            $itemClasses = $menuItem->getLinkClasses();
            $html .= '<li class="level0 nav-' . $key . ' first level-top parent ' . $itemClasses . '"><a href="' . $itemUrl . '" class="level-top" title="' . $itemTitle . '"><span>' . $itemTitle . '</span></a>';
        }
        $html .= $this->getChildItemSubmenuHtml($menuItem, $menuItems, $key);
        $html .= '</li>';
        return $html;
    }

    /**
     * @param $menuItem
     * @param null $menuItems
     * @param null $key
     * @return string
     * @throws NoSuchEntityException
     */
    protected function getChildItemSubmenuHtml($menuItem, $menuItems = null, $key = null)
    {
        $layoutHtml = '';
        if ($menuItems !== null) {
            if (!isset($menuItems['content_memorized'])) {
                $menuItems[$key]['content_memorized'] = true;
                $menuItems[$key]['layout'] = $menuItem->getLayout();
                $defaultClass = $this->getDefaultContentClass($menuItems[$key]['layout']);
                $menuItems[$key]['content'] = $this->getMenuItemContent($menuItem, $defaultClass);
                $menuItems[$key]['content_second'] = $this->getMenuItemContentSecond($menuItem, $defaultClass);
                $menuItems[$key]['content_third'] = $this->getMenuItemContentThird($menuItem, $defaultClass);
            }
            $itemLayout = $menuItems[$key]['layout'];
            $itemContent = $menuItems[$key]['content'];
            $itemContentSecond = $menuItems[$key]['content_second'];
            $itemContentThird = $menuItems[$key]['content_third'];
        } else {
            $itemLayout = $menuItem->getLayout();
            $defaultClass = $this->getDefaultContentClass($menuItems[$key]['layout']);
            $itemContent = $this->getMenuItemContent($menuItem, $defaultClass);
            $itemContentSecond = $this->getMenuItemContentSecond($menuItem, $defaultClass);
            $itemContentThird = $this->getMenuItemContentThird($menuItem, $defaultClass);
        }

        switch ($itemLayout) {
            case Layout::NO_CONTENT_LAYOUT:
                return '';
            case Layout::ONE_COLUMN_LAYOUT:
                $layoutHtml .= '<div class="level0 submenu ui-menu ui-widget ui-widget-content ui-front"><div class="row column-' . Layout::ONE_COLUMN_LAYOUT . '">';
                $layoutHtml .= $itemContent;
                $layoutHtml .= '</div></div>';
                break;
            case Layout::TWO_COLUMN_LAYOUT:
                $layoutHtml .= '<div class="level0 submenu ui-menu ui-widget ui-widget-content ui-front"><div class="row column-' . Layout::TWO_COLUMN_LAYOUT . '">';
                $layoutHtml .= $itemContent;
                $layoutHtml .= $itemContentSecond;
                $layoutHtml .= '</div></div>';
                break;
            case Layout::THREE_COLUMN_LAYOUT:
                $layoutHtml .= '<div class="level0 submenu ui-menu ui-widget ui-widget-content ui-front"><div class="row column-' . Layout::THREE_COLUMN_LAYOUT . '">';
                $layoutHtml .= $itemContent;
                $layoutHtml .= $itemContentSecond;
                $layoutHtml .= $itemContentThird;
                $layoutHtml .= '</div></div>';
                break;
        }

        return $layoutHtml;
    }
}
