<?php

namespace Dadolun\MegaMenu\Model\ResourceModel;

use Dadolun\MegaMenu\Api\MenuResourceInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Model\ResourceModel\Db\Context;

/**
 * Class MegaMenu
 * @package Dadolun\MegaMenu\Model\ResourceModel
 */
class Menu extends AbstractDb implements MenuResourceInterface {

    /**
     * @var MetadataPool
     */
    protected $metadataPool;

    /**
     * Menu constructor.
     * @param MetadataPool $metadataPool
     * @param Context $context
     * @param null $connectionName
     */
    public function __construct(
        MetadataPool $metadataPool,
        Context $context,
        $connectionName = null
    )
    {
        $this->metadataPool = $metadataPool;
        parent::__construct($context, $connectionName);
    }

    protected function _construct() {
        $this->_init('dadolun_menu', 'menu_id');
    }

    /**
     * @param $object
     * @return $this
     * @throws LocalizedException
     */
    public function loadStores($object) {
        $connection = $this->getConnection();
        $entityMetadata = $this->metadataPool->getMetadata('dadolun_menu');
        $linkField = $entityMetadata->getLinkField();

        $select = $connection->select()
            ->from(['ums' => $this->getTable('dadolun_menu_store')], 'store_id')
            ->join(
                ['um' => $this->getMainTable()],
                'ums.' . $linkField . ' = um.' . $linkField,
                []
            )
            ->where('um.' . $entityMetadata->getIdentifierField() . ' = :menu_id');

        $storeIds = $connection->fetchCol($select, ['menu_id' => (int)$object->getId()]);
        $object->setData('stores', $storeIds);
        return $this;
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this|array|AbstractDb
     * @throws LocalizedException
     */
    protected function _afterLoad(\Magento\Framework\Model\AbstractModel $object)
    {
        parent::_afterLoad($object);
        $this->loadStores($object);
        return $this;
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this|AbstractDb
     * @throws \Exception
     */
    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $newStores = $object->getData('stores');
        $this->loadStores($object);
        $oldStores = is_array($object->getData('stores')) ? $object->getData('stores') : [];

        $entityMetadata = $this->metadataPool->getMetadata('dadolun_menu');
        $linkField = $entityMetadata->getLinkField();

        if (empty($newStores)) {
            throw new \Exception('MegaMenu must be associated at least to one storeview');
        }

        $table =  $this->getTable('dadolun_menu_store');

        $delete = array_diff($oldStores, $newStores);
        if ($delete) {
            $where = [
                $linkField . ' = ?' => (int)$object->getData($linkField),
                'store_id IN (?)' => $delete,
            ];
            $this->getConnection()->delete($table, $where);
        }

        $insert = array_diff($newStores, $oldStores);
        if ($insert) {
            $data = [];
            foreach ($insert as $storeId) {
                $data[] = [
                    $linkField => (int)$object->getData($linkField),
                    'store_id' => (int)$storeId
                ];
            }
            $this->getConnection()->insertMultiple($table, $data);
        }

        return $this;
    }
}
