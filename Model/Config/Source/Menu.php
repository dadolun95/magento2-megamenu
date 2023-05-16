<?php

namespace Dadolun\MegaMenu\Model\Config\Source;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;
use Dadolun\MegaMenu\Model\ResourceModel\Menu\CollectionFactory;
use Dadolun\MegaMenu\Api\MenuRepositoryInterface;
use Magento\Framework\Registry;

/**
 * Class MegaMenu
 * @package Dadolun\MegaMenu\Model\Config\Source
 */
class Menu implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var CollectionFactory
     */
    private $menuCollectionFactory;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var MenuRepositoryInterface
     */
    private $menuRepository;

    /**
     * @var Registry
     */
    private $registry;

    /**
     * Menu constructor.
     * @param CollectionFactory $menuCollectionFactory
     * @param StoreManagerInterface $storeManager
     * @param RequestInterface $request
     * @param MenuRepositoryInterface $menuRepository
     * @param Registry $registry
     */
    public function __construct(
        CollectionFactory $menuCollectionFactory,
        StoreManagerInterface $storeManager,
        RequestInterface $request,
        MenuRepositoryInterface $menuRepository,
        Registry $registry
    )
    {
        $this->menuCollectionFactory = $menuCollectionFactory;
        $this->storeManager = $storeManager;
        $this->request = $request;
        $this->menuRepository = $menuRepository;
        $this->registry = $registry;
    }

    /**
     * @return array
     * @throws NoSuchEntityException
     */
    public function toOptionArray()
    {
        $optionArray = [];
        foreach ($this->toArray() as $id => $label) {
            $optionArray[] = [
                'value' => $id,
                'label' => $label
            ];
        }
        return $optionArray;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $options = [];
        foreach ($this->getOptions() as $option) {
            $options[$option->getId()] = $option->getName();
        }
        return $options;
    }

    /**
     * @return DataObject[]
     */
    private function getOptions() {
        return $this->menuCollectionFactory->create()->getItems();
    }
}
