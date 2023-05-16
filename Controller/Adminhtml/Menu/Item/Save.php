<?php

namespace Dadolun\MegaMenu\Controller\Adminhtml\Menu\Item;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Dadolun\MegaMenu\Api\MenuItemRepositoryInterface;
use Dadolun\MegaMenu\Api\Data\MenuItemInterfaceFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Save
 * @package Dadolun\MegaMenu\Controller\Adminhtml\Menu\Item
 */
class Save extends \Magento\Backend\App\Action implements HttpPostActionInterface
{

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var MenuItemInterfaceFactory
     */
    private $menuItemFactory;

    /**
     * @var MenuItemRepositoryInterface;
     */
    private $menuItemRepository;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param MenuItemInterfaceFactory $menuItemFactory
     * @param MenuItemRepositoryInterface $menuItemRepository
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        MenuItemInterfaceFactory $menuItemFactory,
        MenuItemRepositoryInterface $menuItemRepository
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->menuItemFactory = $menuItemFactory;
        $this->menuItemRepository = $menuItemRepository;
        parent::__construct($context);
    }

    /**
     * @return Redirect|ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $menuId = $this->getRequest()->getParam('menu_id');
        $isAjax = $this->getRequest()->getParam('isAjax');
        $data = $this->getRequest()->getPostValue();
        $data['menu_id'] = $menuId;

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $jsonMessage = '';
        $jsonError = false;
        $menuItem = $this->menuItemFactory->create();

        if ($data) {
            if (isset($data['item_id']) && $data['item_id'] !== "") {
                try {
                    $menuItem = $this->menuItemRepository->getById($data['item_id']);
                    $data['item_id'] = $menuItem->getId();
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This menu item no longer exists.'));
                    $jsonMessage = __('This menu item no longer exists.');
                    if ($isAjax) {
                        $jsonError = true;
                        $resultJson->setData(
                            [
                                'message' => $jsonMessage,
                                'error' => $jsonError,
                            ]
                        );
                        return $resultJson;
                    }
                    return $resultRedirect->setPath('dadolunmenu/menu/edit', ['menu_id' => $menuId]);
                }
            }
            $menuItem->setData($data);
            try {
                $this->menuItemRepository->save($menuItem);
                $this->messageManager->addSuccessMessage(__('You saved the menu item.'));
                $jsonMessage = __('You saved the menu item.');
                $jsonError = false;
            } catch (LocalizedException $e) {
                $this->messageManager->addExceptionMessage($e->getPrevious() ?: $e);
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the menu item.'));
            }

            $this->dataPersistor->set('dadolunmenu_item', $data);
        }
        if ($isAjax) {
            $resultJson->setData(
                [
                    'message' => $jsonMessage,
                    'error' => $jsonError,
                ]
            );
            return $resultJson;
        }
        return $resultRedirect->setPath('dadolunmenu/menu/edit', ['menu_id' => $menuId]);
    }

    /**
     * Menu access rights checking
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Dadolun_MegaMenu::config');
    }
}
