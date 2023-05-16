<?php

namespace Dadolun\MegaMenu\Plugin;

use Dadolun\MegaMenu\Helper\Config as ConfigHelper;
use Dadolun\MegaMenu\Block\Html\Topmenu as MegaTopMenu;
use Magento\Theme\Block\Html\Topmenu;

/**
 * Class UseAsDefaultMenu
 * @package Dadolun\MegaMenu\Plugin
 */
class UseAsDefaultMenu
{

    /**
     * @var ConfigHelper
     */
    protected $configHelper;

    /**
     * @var MegaTopMenu
     */
    protected $topmenu;

    /**
     * UseAsDefaultMenu constructor.
     * @param ConfigHelper $configHelper
     * @param MegaTopMenu $topmenu
     */
    public function __construct(
        ConfigHelper $configHelper,
        MegaTopMenu $topmenu
    ) {
        $this->configHelper = $configHelper;
        $this->topmenu = $topmenu;
    }


    /**
     * @param Topmenu $subject
     * @param string $result
     * @return string
     */
    public function afterToHtml(
        Topmenu $subject,
        string $result
    )
    {
        try {
            if ($this->configHelper->isMenuEnabled()) {
                return $this->topmenu->toHtml();
            }
        } catch (\Exception $e) {}
        return $result;
    }
}
