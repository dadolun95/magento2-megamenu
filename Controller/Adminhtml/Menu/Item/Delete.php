<?php

namespace Dadolun\MegaMenu\Controller\Adminhtml\Menu\Item;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Backend\App\Action;
use Dadolun\MegaMenu\Api\MenuItemRepositoryInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Delete
 * @package Dadolun\MegaMenu\Controller\Adminhtml\Menu\Item
 */
class Delete extends \Magento\Backend\App\Action implements HttpGetActionInterface
{

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var MenuItemRepositoryInterface|null
     */
    private $menuItemRepository;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param MenuItemRepositoryInterface|null $menuItemRepository
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        MenuItemRepositoryInterface $menuItemRepository
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->menuItemRepository = $menuItemRepository;
        parent::__construct($context);
    }

    /**
     * @return Redirect|ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if (isset($data['item_id'])) {
            try {
                $menuItem = $this->menuItemRepository->getById($data['item_id']);
                $menuId = $menuItem->getData('menu_id');
                $this->menuItemRepository->delete($menuItem);
                $this->dataPersistor->clear('dadolunmenu');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage(__('This menu item no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            return $resultRedirect->setPath('dadolunmenu/menu/edit', ['menu_id' => $menuId]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * MegaMenu access rights checking
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Dadolun_MegaMenu::menu');
    }
}
