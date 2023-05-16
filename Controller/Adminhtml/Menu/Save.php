<?php

namespace Dadolun\MegaMenu\Controller\Adminhtml\Menu;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action;
use Dadolun\MegaMenu\Api\MenuRepositoryInterface;
use Dadolun\MegaMenu\Api\Data\MenuInterfaceFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Save
 * @package Dadolun\MegaMenu\Controller\Adminhtml\Menu
 */
class Save extends \Magento\Backend\App\Action implements HttpPostActionInterface
{

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var MenuInterfaceFactory
     */
    private $menuFactory;

    /**
     * @var MenuRepositoryInterface;
     */
    private $menuRepository;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param MenuInterfaceFactory $menuFactory
     * @param MenuRepositoryInterface $menuRepository
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        MenuInterfaceFactory $menuFactory,
        MenuRepositoryInterface $menuRepository
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->menuFactory = $menuFactory;
        $this->menuRepository = $menuRepository;
        parent::__construct($context);
    }

    /**
     * @return Redirect|ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $menu = $this->menuFactory->create();

        if ($data) {
            if (isset($data['menu_id']) && $data['menu_id'] !== "") {
                try {
                    $menu = $this->menuRepository->getById($data['menu_id']);
                    $data['menu_id'] = $menu->getId();
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This menu no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            } else {
                unset($data['menu_id']);
            }
            $menu->setData($data);
            try {
                $menu = $this->menuRepository->save($menu);
                $this->messageManager->addSuccessMessage(__('You saved the menu.'));
                return $resultRedirect->setPath(
                    '*/*/edit',
                    [
                        'menu_id' => $menu->getId(),
                        '_current' => true
                    ]
                );
            } catch (LocalizedException $e) {
                $this->messageManager->addExceptionMessage($e->getPrevious() ?: $e);
            } catch (\Throwable $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the menu.'));
            }

            $this->dataPersistor->set('dadolunmenu_item', $data);
            return $resultRedirect->setPath('*/*/edit', ['menu_id' => $this->getRequest()->getParam('menu_id')]);
        }
        return $resultRedirect->setPath('*/*/');
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
