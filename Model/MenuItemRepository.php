<?php

namespace Dadolun\MegaMenu\Model;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use \Dadolun\MegaMenu\Api\Data\MenuItemInterface;
use \Dadolun\MegaMenu\Api\Data\MenuItemInterfaceFactory;
use \Dadolun\MegaMenu\Api\MenuItemRepositoryInterface;
use \Dadolun\MegaMenu\Api\MenuItemResourceInterface;
use \Dadolun\MegaMenu\Model\ResourceModel\MenuItem\CollectionFactory as MenuItemCollectionFactory;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Model\AbstractModel;

/**
 * Class MenuItemRepository
 * @package Dadolun\MegaMenu\Model
 */
class MenuItemRepository implements MenuItemRepositoryInterface {

    /**
     * @var MenuItemInterfaceFactory|MenuItemInterfaceFactory
     */
    protected $menuItemFactory;

    /**
     * @var MenuItemCollectionFactory
     */
    protected $menuItemCollectionFactory;

    /**
     * @var MenuItemResourceInterface
     */
    protected $menuItemResource;

    /**
     * MenuItemRepository constructor.
     * @param MenuItemInterfaceFactory $menuItemFactory
     * @param MenuItemCollectionFactory $menuItemCollectionFactory
     * @param MenuItemResourceInterface $menuItemResource
     */
    public function __construct(
        MenuItemInterfaceFactory $menuItemFactory,
        MenuItemCollectionFactory $menuItemCollectionFactory,
        MenuItemResourceInterface $menuItemResource
    ){
        $this->menuItemFactory = $menuItemFactory;
        $this->menuItemCollectionFactory = $menuItemCollectionFactory;
        $this->menuItemResource = $menuItemResource;
    }

    /**
     * @param $menuItemId
     * @return MenuItemInterface|ResourceModel\MenuItem\Collection|null
     * @throws NoSuchEntityException
     */
    public function getById($menuItemId)
    {
        $menuItem = $this->menuItemFactory->create();
        $menuItem->load($menuItemId);
        if (!$menuItem->getId()) {
            throw new NoSuchEntityException(
                __("The item menu that was requested doesn't exist. Verify the id and try again.")
            );
        }
        return $menuItem;
    }

    /**
     * @param AbstractModel $menuItem
     * @return AbstractModel|MenuItemInterface|null
     * @throws CouldNotSaveException
     */
    public function save(AbstractModel $menuItem)
    {
        try {
            $this->menuItemResource->save($menuItem);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(
                __($e->getMessage()),
                $e
            );
        }
        return $menuItem;
    }

    /**
     * @param AbstractModel $menuItem
     * @throws StateException
     */
    public function delete(AbstractModel $menuItem)
    {
        try {
            $this->menuItemResource->delete($menuItem);
        }  catch (\Exception $e) {
            throw new StateException(
                __('The "%1" item menu couldn\'t be removed.', $menuItem->getId()),
                $e
            );
        }
    }
}
