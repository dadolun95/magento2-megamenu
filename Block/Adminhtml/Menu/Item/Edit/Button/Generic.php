<?php

namespace Dadolun\MegaMenu\Block\Adminhtml\Menu\Item\Edit\Button;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\UiComponent\Context;
use Magento\Backend\Block\Widget\Context as WidgetContext;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Dadolun\MegaMenu\Api\MenuItemRepositoryInterface;

/**
 * Class Generic
 * @package Dadolun\MegaMenu\Block\Adminhtml\Menu\Item\Edit\Button
 */
class Generic implements ButtonProviderInterface
{
    /**
     * Url Builder
     *
     * @var Context
     */
    protected $context;

    /**
     * @var WidgetContext
     */
    protected $widgetContext;

    /**
     * @var MenuItemRepositoryInterface
     */
    protected $menuItemRepository;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * Generic constructor.
     * @param Context $context
     * @param WidgetContext $widgetContext
     * @param MenuItemRepositoryInterface $menuItemRepository
     * @param Registry $registry
     */
    public function __construct(
        Context $context,
        WidgetContext $widgetContext,
        MenuItemRepositoryInterface $menuItemRepository,
        Registry $registry
    ) {
        $this->context = $context;
        $this->widgetContext = $widgetContext;
        $this->menuItemRepository = $menuItemRepository;
        $this->registry = $registry;
    }

    /**
     * @return mixed
     */
    public function getMenuId() {
        $menuItem = $this->registry->registry('dadolunmenu_item');
        if ($menuItem) {
            return $menuItem->getMenuId();
        }
        return null;
    }

    /**
     * Return MegaMenu Item ID
     *
     * @return int|null
     */
    public function getBlockId()
    {
       if ($this->widgetContext->getRequest()->getParam('item_id')) {
           try {
               return $this->menuItemRepository->getById(
                   $this->widgetContext->getRequest()->getParam('item_id')
               )->getId();
           } catch (NoSuchEntityException $e) {
           }
        }
        return null;
    }


    /**
     * Generate url by route and parameters
     *
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrl($route, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function getButtonData()
    {
        return [];
    }
}
