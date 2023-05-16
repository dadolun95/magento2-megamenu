<?php

namespace Dadolun\MegaMenu\Controller\Adminhtml\Menu;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Backend\App\Action;
use Dadolun\MegaMenu\Api\MenuRepositoryInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Delete
 * @package Dadolun\MegaMenu\Controller\Adminhtml\Menu
 */
class Delete extends \Magento\Backend\App\Action implements HttpGetActionInterface
{

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var MenuRepositoryInterface|null
     */
    private $menuRepository;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param MenuRepositoryInterface|null $menuRepository
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        MenuRepositoryInterface $menuRepository
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->menuRepository = $menuRepository;
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

        if (isset($data['menu_id'])) {
            try {
                $menu = $this->menuRepository->getById($data['menu_id']);
                $this->menuRepository->delete($menu);
                $this->dataPersistor->clear('dadolunmenu');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage(__('This menu no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            return $resultRedirect->setPath('*/*/');
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
        return $this->_authorization->isAllowed('Dadolun_MegaMenu::config');
    }
}
