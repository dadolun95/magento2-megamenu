<?php

namespace Dadolun\MegaMenu\Ui\Component\Form;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Form\Fieldset;

/**
 * Class Items
 * @package Dadolun\MegaMenu\Ui\Component\Form
 */
class Items extends Fieldset
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * Items constructor.
     * @param ContextInterface $context
     * @param \Magento\Framework\Registry $registry
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        \Magento\Framework\Registry $registry,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $components, $data);
        $this->registry = $registry;
    }

    /**
     * hide or show fieldset based on menu_id
     */
    public function prepare()
    {
        $visible = false;
        $disabled = true;
        if ($this->registry->registry('dadolunmenu')->getId()) {
            $visible = true;
            $disabled = false;
        }
        $config = $this->getData('config');
        $config['visible'] = $visible;
        $config['disabled'] = $disabled;
        $this->setData('config', $config);

        parent::prepare();
    }
}
