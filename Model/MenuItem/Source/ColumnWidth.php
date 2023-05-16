<?php

namespace Dadolun\MegaMenu\Model\MenuItem\Source;

/**
 * Class ColumnWidth
 * @package Dadolun\MegaMenu\Model\MenuItem\Source
 */
class ColumnWidth implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];
        foreach ($this->toArray() as $key => $value) {
            $options[] = [
                'value' => $key,
                'label' => $value
            ];
        }
        return $options;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            1 => __("1/6"),
            2 => __("2/6"),
            3 => __("3/6"),
            4 => __("4/6"),
            5 => __("5/6"),
            6 => __("6/6")
        ];
    }
}
