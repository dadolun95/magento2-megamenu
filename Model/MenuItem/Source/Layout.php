<?php

namespace Dadolun\MegaMenu\Model\MenuItem\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Layout
 * @package Dadolun\MegaMenu\Model\MenuItem\Source
 */
class Layout implements OptionSourceInterface
{

    const NO_CONTENT_LAYOUT = 0;
    const ONE_COLUMN_LAYOUT = 1;
    const TWO_COLUMN_LAYOUT = 2;
    const THREE_COLUMN_LAYOUT = 3;

    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => self::NO_CONTENT_LAYOUT,
                'label' => __('No content'),
            ],
            [
                'value' => self::ONE_COLUMN_LAYOUT,
                'label' => __('1 Column'),
            ],
            [
                'value' => self::TWO_COLUMN_LAYOUT,
                'label' => __('2 Columns'),
            ],
            [
                'value' => self::THREE_COLUMN_LAYOUT,
                'label' => __('3 Columns'),
            ]
        ];
    }
}
