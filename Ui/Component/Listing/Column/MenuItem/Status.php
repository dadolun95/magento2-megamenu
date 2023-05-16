<?php

namespace Dadolun\MegaMenu\Ui\Component\Listing\Column\MenuItem;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use \Dadolun\MegaMenu\Model\MenuItem\Source\Status as SourceStatus;

/**
 * Class Status
 * @package Dadolun\MegaMenu\Ui\Component\Listing\Column\MenuItem
 */
class Status extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * @var SourceStatus
     */
    protected $status;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param SourceStatus $status
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        SourceStatus $status,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->status = $status;
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

        $options = $this->status->toArray();

        foreach ($dataSource['data']['items'] as &$item) {
            $item[$fieldName] = $options[$item[$fieldName]];
        }

        return $dataSource;
    }
}
