<?php

namespace Dadolun\MegaMenu\Model\MenuItem\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Status
 * @package Dadolun\MegaMenu\Model\MenuItem\Source
 */
class Status implements OptionSourceInterface
{

    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => 0,
                'label' => __('Disabled'),
            ],
            [
                'value' => 1,
                'label' => __('Enabled'),
            ],
        ];
    }

    /**
     * @return array
     */
    public function toArray() {
        return [
            0  => __('Disabled'),
            1 => __('Enabled')
        ];
    }
}
