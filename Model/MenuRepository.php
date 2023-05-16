<?php

namespace Dadolun\MegaMenu\Model;

use Dadolun\MegaMenu\Api\Data\MenuInterfaceFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use \Dadolun\MegaMenu\Api\Data\MenuInterface;
use \Dadolun\MegaMenu\Api\MenuRepositoryInterface;
use \Dadolun\MegaMenu\Api\MenuResourceInterface;
use \Dadolun\MegaMenu\Model\ResourceModel\Menu\CollectionFactory as MenuCollectionFactory;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Model\AbstractModel;

/**
 * Class MenuRepository
 * @package Dadolun\MegaMenu\Model
 */
class MenuRepository implements MenuRepositoryInterface {

    /**
     * @var MenuInterfaceFactory|MenuInterfaceFactory
     */
    protected $menuFactory;

    /**
     * @var MenuCollectionFactory
     */
    protected $menuCollectionFactory;

    /**
     * @var MenuResourceInterface
     */
    protected $menuResource;

    /**
     * MenuRepository constructor.
     * @param MenuInterfaceFactory $menuFactory
     * @param MenuCollectionFactory $menuCollectionFactory
     * @param MenuResourceInterface $menuResource
     */
    public function __construct(
        MenuInterfaceFactory $menuFactory,
        MenuCollectionFactory $menuCollectionFactory,
        MenuResourceInterface $menuResource
    ){
        $this->menuFactory = $menuFactory;
        $this->menuCollectionFactory = $menuCollectionFactory;
        $this->menuResource = $menuResource;
    }

    /**
     * @param $menuId
     * @return MenuInterface|ResourceModel\Menu\Collection|null
     * @throws NoSuchEntityException
     */
    public function getById($menuId)
    {
        $menu = $this->menuFactory->create();
        $menu->load($menuId);
        if (!$menu->getId()) {
            throw new NoSuchEntityException(
                __("The menu that was requested doesn't exist. Verify the id and try again.")
            );
        }
        return $menu;
    }

    /**
     * @param AbstractModel $menu
     * @return AbstractModel|MenuInterface|null
     * @throws CouldNotSaveException
     */
    public function save(AbstractModel $menu)
    {
        try {
            $this->menuResource->save($menu);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(
                __($e->getMessage()),
                $e
            );
        }
        return $menu;
    }

    /**
     * @param AbstractModel $menu
     * @throws StateException
     */
    public function delete(AbstractModel $menu)
    {
        try {
            $this->menuResource->delete($menu);
        }  catch (\Exception $e) {
            throw new StateException(
                __('The "%1" menu couldn\'t be removed.', $menu->getId()),
                $e
            );
        }
    }
}
