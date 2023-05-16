<?php

namespace Dadolun\MegaMenu\Block\Html\MenuType;

use Dadolun\MegaMenu\Api\Data\MenuInterface;
use Dadolun\MegaMenu\Model\MenuItem;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Cms\Helper\Page;
use Dadolun\MegaMenu\Api\MenuRepositoryInterface;
use Dadolun\MegaMenu\Model\MenuItem\Source\Layout;
use Dadolun\MegaMenu\Model\ResourceModel\MenuItem\CollectionFactory as MenuItemCollectionFactory;
use Dadolun\MegaMenu\Api\Data\MenuItemInterface;
use Magento\Cms\Model\Template\FilterProvider;
use Dadolun\MegaMenu\Helper\Config as ConfigHelper;

/**
 * Class Navbar
 * @package Dadolun\MegaMenu\Block\Html\MenuType
 */
class Nav extends Template
{
    /**
     * @var null|int
     */
    protected $storeId = null;

    /**
     * @var CategoryRepositoryInterface
     */
    protected $categoryRepository;

    /**
     * @var ConfigHelper
     */
    protected $configHelper;

    /**
     * @var Page
     */
    protected $pageHelper;

    /**
     * @var MenuRepositoryInterface
     */
    protected $menuRepository;

    /**
     * @var MenuItemCollectionFactory
     */
    protected $menuItemCollectionFactory;

    /**
     * @var FilterProvider
     */
    protected $filterProvider;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Topmenu constructor.
     * @param CategoryRepositoryInterface $categoryRepository
     * @param ConfigHelper $configHelper
     * @param Page $pageHelper
     * @param MenuRepositoryInterface $menuRepository
     * @param MenuItemCollectionFactory $menuItemCollectionFactory
     * @param FilterProvider $filterProvider
     * @param StoreManagerInterface $storeManager
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        ConfigHelper $configHelper,
        Page $pageHelper,
        MenuRepositoryInterface $menuRepository,
        MenuItemCollectionFactory $menuItemCollectionFactory,
        FilterProvider $filterProvider,
        StoreManagerInterface $storeManager,
        Template\Context $context,
        array $data = []
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->configHelper = $configHelper;
        $this->pageHelper = $pageHelper;
        $this->menuRepository = $menuRepository;
        $this->menuItemCollectionFactory = $menuItemCollectionFactory;
        $this->filterProvider = $filterProvider;
        $this->storeManager = $storeManager;
        parent::__construct($context, $data);
    }

    /**
     * @return MenuInterface|null
     */
    public function getMenuData($menuId = null)
    {
        return $this->menuRepository->getById($menuId);
    }

    /**
     * @param $menu
     * @return string
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getHtml($menu)
    {
        $menuHtml = '';
        if (!is_null($menu)) {
            /**
             * @var MenuItem[] $menuItems
             */
            $menuItems = $this->menuItemCollectionFactory->create()
                ->addFieldToFilter('menu_id', $menu->getId())
                ->addFieldToFilter('status', 1)
                ->getItems();

            foreach ($menuItems as $key => $menuItem) {
                $menuHtml .= $this->getChildItemHtml($menuItem, null, $key);
            }
        }
        return $menuHtml;
    }

    /**
     * @param $menuItem
     * @param null $menuItems
     * @param null $key
     * @return string
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    protected function getChildItemHtml($menuItem, $menuItems = null, $key = null)
    {
        $html = '';
        $html .= '<li class="level0 nav-' . $key . ' first level-top ' . $menuItem->getLinkClasses() . '"><a href="' . $this->getMenuItemUrl($menuItem) . '">' . $menuItem->getTitle() . '</a>';
        $html .= $this->getChildItemSubmenuHtml($menuItem);
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
        $layout = $menuItem->getLayout();
        $layoutHtml = '';
        $defaultClass = '';
        switch ($layout) {
            case Layout::NO_CONTENT_LAYOUT:
                return '';
            case Layout::ONE_COLUMN_LAYOUT:
                $layoutHtml .= '<ul class="level0"><li class="container">';
                $layoutHtml .= $this->getMenuItemContent($menuItem, $defaultClass);
                $layoutHtml .= '</li></ul>';
                break;
            case Layout::TWO_COLUMN_LAYOUT:
                $layoutHtml .= '<ul class="level0"><li class="container">';
                $layoutHtml .= $this->getMenuItemContent($menuItem, $defaultClass);
                $layoutHtml .= $this->getMenuItemContentSecond($menuItem, $defaultClass);
                $layoutHtml .= '</li></ul>';
                break;
            case Layout::THREE_COLUMN_LAYOUT:
                $layoutHtml .= '<ul class="level0"><li class="container">';
                $layoutHtml .= $this->getMenuItemContent($menuItem, $defaultClass);
                $layoutHtml .= $this->getMenuItemContentSecond($menuItem, $defaultClass);
                $layoutHtml .= $this->getMenuItemContentThird($menuItem, $defaultClass);
                $layoutHtml .= '</li></ul>';
                break;
        }
        return $layoutHtml;
    }

    /**
     * @param $menuItem
     * @param $defaultClass
     * @return string
     * @throws NoSuchEntityException
     */
    protected function getMenuItemContent($menuItem, $defaultClass)
    {
        $contentAdditionalClasses = $menuItem->getContentAdditionalClasses();
        $contentDesktopWidth = $menuItem->getContentDesktopWidth();
        $contentTabletWidth = $menuItem->getContentTabletWidth();
        $contentHtml = '';
        $contentHtml .= '<div class="width-' . $contentDesktopWidth . '-6-m width-' . $contentTabletWidth . '-6-s ' . ($contentAdditionalClasses !== null ? $contentAdditionalClasses : $defaultClass) . '">';
        $contentHtml .= $this->filterProvider->getBlockFilter()->setStoreId($this->getStoreId())->filter($menuItem->getContent());
        $contentHtml .= '</div>';
        return $contentHtml;
    }

    /**
     * @param $menuItem
     * @param $defaultClass
     * @return string
     * @throws NoSuchEntityException
     */
    protected function getMenuItemContentSecond($menuItem, $defaultClass)
    {
        $contentAdditionalClasses = $menuItem->getContentSecondAdditionalClasses();
        $contentDesktopWidth = $menuItem->getContentSecondDesktopWidth();
        $contentTabletWidth = $menuItem->getContentSecondTabletWidth();
        $contentHtml = '';
        $contentHtml .= '<div class="width-' . $contentDesktopWidth . '-6-m width-' . $contentTabletWidth . '-6-s ' . ($contentAdditionalClasses !== null ? $contentAdditionalClasses : $defaultClass) . '">';
        $contentHtml .= $this->filterProvider->getBlockFilter()->setStoreId($this->getStoreId())->filter($menuItem->getContentSecond());
        $contentHtml .= '</div>';
        return $contentHtml;
    }

    /**
     * @param $menuItem
     * @param $defaultClass
     * @return string
     * @throws NoSuchEntityException
     */
    protected function getMenuItemContentThird($menuItem, $defaultClass)
    {
        $contentAdditionalClasses = $menuItem->getContentThirdAdditionalClasses();
        $contentDesktopWidth = $menuItem->getContentThirdDesktopWidth();
        $contentTabletWidth = $menuItem->getContentThirdTabletWidth();
        $contentHtml = '';
        $contentHtml .= '<div class="width-' . $contentDesktopWidth . '-6-m width-' . $contentTabletWidth . '-6-s ' . ($contentAdditionalClasses !== null ? $contentAdditionalClasses : $defaultClass) . '">';
        $contentHtml .= $this->filterProvider->getBlockFilter()->setStoreId($this->getStoreId())->filter($menuItem->getContentThird());
        $contentHtml .= '</div>';
        return $contentHtml;
    }

    /**
     * @param MenuItem $menuItem
     * @return string
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    protected function getMenuItemUrl($menuItem)
    {
        switch ($menuItem->getItemType()) {
            case MenuItemInterface::ITEM_TYPE_MAPPING[MenuItemInterface::ENTITY_TYPE_CATEGORY]:
                $categoryId = $menuItem->getLinkedEntityId();
                $category = $this->categoryRepository->get($categoryId, $this->getStoreId());
                $url = $category->getUrl();
                break;
            case MenuItemInterface::ITEM_TYPE_MAPPING[MenuItemInterface::ENTITY_TYPE_CUSTOM]:
                $url = $menuItem->getCustomUrl();
                break;
            case MenuItemInterface::ITEM_TYPE_MAPPING[MenuItemInterface::ENTITY_TYPE_CMS_PAGE]:
                $cmsPageId = $menuItem->getLinkedEntityId();
                $url = $this->pageHelper->getPageUrl($cmsPageId);
                break;
            default:
                $url = '#';
                break;
        }
        return $url;
    }


    /**
     * @return int
     * @throws NoSuchEntityException
     */
    protected function getStoreId()
    {
        if (is_null($this->storeId)) {
            $this->storeId = $this->storeManager->getStore()->getId();
        }
        return $this->storeId;
    }
}
