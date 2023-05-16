<?php

namespace Dadolun\MegaMenu\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Dadolun\MegaMenu\Helper\Config as ConfigHelper;

/**
 * Class MenuManager
 * @package Dadolun\MegaMenu\ViewModel
 */
class MenuManager implements ArgumentInterface
{

    /**
     * @var ConfigHelper
     */
    protected $configHelper;

    /**
     * MenuManager constructor.
     * @param ConfigHelper $configHelper
     */
    public function __construct(
        ConfigHelper $configHelper
    )
    {
        $this->configHelper = $configHelper;
    }

    /**
     * @return string
     */
    public function getHeaderWidthClass() {
        $cssClass = '';
        if (!$this->configHelper->getModuleConfigFlag(\Dadolun\MegaMenu\Helper\Config::FULLWIDTH_CONFIG)) {
            $cssClass = 'uk-container';
        }
        return $cssClass;
    }

    /**
     * @return mixed
     */
    public function showMagentoMobileToggle() {
        return $this->configHelper->isMenuEnabled();
    }


    /**
     * @return bool
     */
    public function isDropdownFullWidth() {
        return $this->configHelper->getModuleConfigFlag(\Dadolun\MegaMenu\Helper\Config::DROPDOWN_FULLWIDTH_CONFIG);
    }

    /**
     * @return bool
     */
    public function isDropdownContainerized() {
        return $this->configHelper->getModuleConfigFlag(\Dadolun\MegaMenu\Helper\Config::DROPDOWN_CONTAINERIZED_CONFIG);
    }

    /**
     * @return string
     */
    public function getSearchStyle(){
        return $this->configHelper->getModuleConfigValue(\Dadolun\MegaMenu\Helper\Config::SEARCH_STYLE);
    }
}
