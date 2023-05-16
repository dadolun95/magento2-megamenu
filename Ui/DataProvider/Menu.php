<?php

namespace Dadolun\MegaMenu\Ui\DataProvider;

use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Magento\Ui\DataProvider\Modifier\ModifierInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Dadolun\MegaMenu\Model\ResourceModel\Menu\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class Menu
 * @package Dadolun\MegaMenu\Ui\DataProvider
 */
class Menu extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * Product collection
     *
     * @var Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var PoolInterface
     */
    protected $pool;

    /**
     * Menu constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param PoolInterface $pool
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        PoolInterface $pool,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->dataPersistor = $dataPersistor;
        $this->collection = $collectionFactory->create();
        $this->pool = $pool;
    }

    /**
     * {@inheritdoc}
     * @since 101.0.0
     */
    public function getMeta()
    {
        $meta = parent::getMeta();

        /** @var ModifierInterface $modifier */
        foreach ($this->pool->getModifiersInstances() as $modifier) {
            $meta = $modifier->modifyMeta($meta);
        }

        return $meta;
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getData()
    {
        $items = $this->collection->getItems();
        $this->loadedData = array();
        foreach ($items as $menu) {
            $this->loadedData[$menu->getId()] = $menu->getData();
        }
        $data = $this->dataPersistor->get('dadolunmenu');
        if (!empty($data)) {
            $megaMenu = $this->collection->getNewEmptyItem();
            $megaMenu->setData($data);
            $this->loadedData[$megaMenu->getId()] = $megaMenu->getData();
            $this->dataPersistor->clear('dadolunmenu');
        }
        /** @var ModifierInterface $modifier */
        foreach ($this->pool->getModifiersInstances() as $modifier) {
            $this->loadedData = $modifier->modifyData($this->loadedData);
        }
        return $this->loadedData;
    }
}
