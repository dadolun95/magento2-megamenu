<?php

namespace Dadolun\MegaMenu\Controller\Adminhtml\Menu\Item;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpGetActionInterface;
use \Dadolun\MegaMenu\Api\MenuItemRepositoryInterface;
use \Dadolun\MegaMenu\Api\Data\MenuItemInterfaceFactory;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Edit
 * @package Dadolun\MegaMenu\Controller\Adminhtml\Menu\Item
 */
class Edit extends \Magento\Backend\App\Action implements HttpGetActionInterface
{
    /**
     * Array of actions which can be processed without secret key validation
     *
     * @var array
     */
    protected $_publicActions = ['edit'];

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var MenuItemRepositoryInterface
     */
    protected $menuItemRepository;

    /**
     * @var MenuItemInterfaceFactory
     */
    protected $menuItemInterfaceFactory;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * Edit constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param MenuItemRepositoryInterface $menuItemRepository
     * @param MenuItemInterfaceFactory $menuItemInterfaceFactory
     * @param Registry $registry
     * @param StoreManagerInterface|null $storeManager
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        MenuItemRepositoryInterface $menuItemRepository,
        MenuItemInterfaceFactory $menuItemInterfaceFactory,
        Registry $registry,
        StoreManagerInterface $storeManager = null
    ) {
        parent::__construct($context);
        $this->registry = $registry;
        $this->resultPageFactory = $resultPageFactory;
        $this->storeManager = $storeManager ?: ObjectManager::getInstance()
            ->get(StoreManagerInterface::class);
        $this->menuItemRepository = $menuItemRepository;
        $this->menuItemInterfaceFactory = $menuItemInterfaceFactory;
    }

    /**
     * @return Page|Redirect|ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $menuItemId = (int) $this->getRequest()->getParam('item_id');
        if ($menuItemId) {
            try {
                $menuItem = $this->menuItemRepository->getById($menuItemId);
                $this->registry->register('dadolunmenu_item', $menuItem);
            } catch (\Exception $e) {
                $resultRedirect = $this->resultRedirectFactory->create();
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('dadolunmenu/menu_item/');
            }

            if ($menuItemId && !$menuItem->getId() || $menuItemId == 0) {
                /** @var Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                $this->messageManager->addErrorMessage(__('This menu item doesn\'t exist.'));
                return $resultRedirect->setPath('dadolunmenu/menu_item/');
            }
        } else {
            $menuItem = $this->menuItemInterfaceFactory->create();
            $this->registry->register('dadolunmenu_item', $menuItem);
        }

        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->addHandle('menu_edit');
        $resultPage->setActiveMenu('Dadolun_MegaMenu::dadolunmenu');
        $resultPage->getConfig()->getTitle()->prepend(__('Dadolun Item MegaMenu'));

        return $resultPage;
    }

    /**
     * MegaMenu access rights checking
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Dadolun_MegaMenu::config');
    }
}
