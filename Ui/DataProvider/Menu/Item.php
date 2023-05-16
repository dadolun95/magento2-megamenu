<?php

namespace Dadolun\MegaMenu\Ui\DataProvider\Menu;

use Dadolun\MegaMenu\Model\ResourceModel\MenuItem\Collection;
use Magento\Ui\DataProvider\Modifier\ModifierInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Dadolun\MegaMenu\Model\ResourceModel\MenuItem\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\RequestInterface;

/**
 * Class Item
 * @package Dadolun\MegaMenu\Ui\DataProvider\Menu
 */
class Item extends \Magento\Ui\DataProvider\AbstractDataProvider
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
     * @var RequestInterface
     */
    protected $request;

    /**
     * Item constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param RequestInterface $request
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
        RequestInterface $request,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        PoolInterface $pool,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->request = $request;
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
        foreach ($items as $menuItem) {
            $this->loadedData[$menuItem->getId()] = $menuItem->getData();
        }
        $data = $this->dataPersistor->get('dadolunmenu_item');
        if (!empty($data)) {
            $megaMenuItem = $this->collection->getNewEmptyItem();
            $megaMenuItem->setData($data);
            $this->loadedData[$megaMenuItem->getId()] = $megaMenuItem->getData();
            $this->dataPersistor->clear('dadolunmenu_item');
        }
        /** @var ModifierInterface $modifier */
        foreach ($this->pool->getModifiersInstances() as $modifier) {
            $this->loadedData = $modifier->modifyData($this->loadedData);
        }
        return $this->loadedData;
    }
}
