<?php

namespace Dadolun\MegaMenu\Ui\Component\Listing\Column\MenuItem;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use \Dadolun\MegaMenu\Model\MenuItem\Source\EntityType as SourceEntityType;

/**
 * Class ItemType
 * @package Dadolun\MegaMenu\Ui\Component\Listing\Column\MenuItem
 */
class ItemType extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * @var SourceEntityType
     */
    protected $entityType;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param SourceEntityType $entityType
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        SourceEntityType $entityType,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->entityType = $entityType;
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        $dataSource = parent::prepareDataSource($dataSource);

        if (empty($dataSource['data']['items'])) {
            return $dataSource;
        }

        $fieldName = $this->getData('name');

        $options = $this->entityType->toArray();

        foreach ($dataSource['data']['items'] as &$item) {
            $item[$fieldName] = $options[$item[$fieldName]];
        }

        return $dataSource;
    }
}
