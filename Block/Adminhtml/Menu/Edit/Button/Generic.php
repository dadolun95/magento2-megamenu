<?php

namespace Dadolun\MegaMenu\Block\Adminhtml\Menu\Edit\Button;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\UiComponent\Context;
use Magento\Backend\Block\Widget\Context as WidgetContext;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Dadolun\MegaMenu\Api\MenuRepositoryInterface;

/**
 * Class Generic
 * @package Dadolun\MegaMenu\Block\Adminhtml\Menu\Edit\Button
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
     * @var MenuRepositoryInterface
     */
    protected $menuRepository;

    /**
     * Generic constructor.
     * @param Context $context
     * @param WidgetContext $widgetContext
     * @param MenuRepositoryInterface $menuRepository
     */
    public function __construct(
        Context $context,
        WidgetContext $widgetContext,
        MenuRepositoryInterface $menuRepository
    ) {
        $this->context = $context;
        $this->widgetContext = $widgetContext;
        $this->menuRepository = $menuRepository;
    }

    /**
     * Return CMS page ID
     *
     * @return int|null
     */
    public function getBlockId()
    {
       if ($this->widgetContext->getRequest()->getParam('menu_id')) {
           try {
               return $this->menuRepository->getById(
                   $this->widgetContext->getRequest()->getParam('menu_id')
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
