<?php

namespace Dadolun\MegaMenu\Controller\Adminhtml\Menu;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Dadolun\MegaMenu\Api\MenuRepositoryInterface;
use Dadolun\MegaMenu\Api\Data\MenuInterfaceFactory;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Edit
 * @package Dadolun\MegaMenu\Controller\Adminhtml\Menu
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
     * @var MenuRepositoryInterface
     */
    protected $menuRepository;

    /**
     * @var MenuInterfaceFactory
     */
    protected $menuInterfaceFactory;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * Edit constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param MenuRepositoryInterface $menuRepository
     * @param MenuInterfaceFactory $menuInterfaceFactory
     * @param Registry $registry
     * @param StoreManagerInterface|null $storeManager
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        MenuRepositoryInterface $menuRepository,
        MenuInterfaceFactory $menuInterfaceFactory,
        Registry $registry,
        StoreManagerInterface $storeManager = null
    ) {
        parent::__construct($context);
        $this->registry = $registry;
        $this->resultPageFactory = $resultPageFactory;
        $this->storeManager = $storeManager ?: ObjectManager::getInstance()
            ->get(StoreManagerInterface::class);
        $this->menuRepository = $menuRepository;
        $this->menuInterfaceFactory = $menuInterfaceFactory;
    }

    /**
     * @return Page|Redirect|ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $menuId = (int) $this->getRequest()->getParam('menu_id');

        if ($menuId) {
            try {
                $menu = $this->menuRepository->getById($menuId);
                $this->registry->register('dadolunmenu', $menu);
            } catch (\Exception $e) {
                $resultRedirect = $this->resultRedirectFactory->create();
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('dadolunmenu/menu/');
            }

            if ($menuId && !$menu->getId() || $menuId == 0) {
                /** @var Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                $this->messageManager->addErrorMessage(__('This menu doesn\'t exist.'));
                return $resultRedirect->setPath('dadolunmenu/menu/');
            }
        } else {
            $menu = $this->menuInterfaceFactory->create();
            $this->registry->register('dadolunmenu', $menu);
        }

        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->addHandle('menu_edit');
        $resultPage->setActiveMenu('Dadolun_MegaMenu::dadolunmenu');
        $resultPage->getConfig()->getTitle()->prepend(__('Dadolun MegaMenu'));

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
