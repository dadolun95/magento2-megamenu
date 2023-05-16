<?php

namespace Dadolun\MegaMenu\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Config
 * @package Dadolun\Theme\Helper
 */
class Config extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Module section
     */
    const SECTION_MODULE = 'dadolun_menu';

    /**
     * Header Configuration section
     */
    const HEADER_GROUP_CONFIGURATION = self::SECTION_MODULE . '/menu';

    /**
     * Is dadolun menu enabled
     */
    const DADOLUN_MENU_ENABLE = 'enable';

    /**
     * Is dadolun menu into topbar
     */
    const DADOLUN_MENU_TOPBAR = 'inside_topbar';

    /**
     * menu Id
     */
    const DADOLUN_MENU_MENU = 'menu';

    const MENU_ALIGNMENT_CONFIG = 'menu_alignment';
    const FULLWIDTH_CONFIG = 'full_width';
    const DROPDOWN_FULLWIDTH_CONFIG = 'dropdown_fullwidth';
    const DROPDOWN_CONTAINERIZED_CONFIG = 'dropdown_containerized';
    const DROPDOWN_WIDTH_CONFIG = 'dropdown_width';
    const DROPDOWN_ANIMATION_CONFIG = 'dropdown_animation';
    const DROPDOWN_ANIMATION_DURATION_CONFIG = 'dropdown_animation_duration';
    const DROPDOWN_CLICK_MODE_CONFIG = 'dropdown_click_mode';
    const SEARCH_STYLE = 'search_style';

    /**
     * Core store config
     *
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Config constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param null $store
     * @param string $scope
     * @return bool
     */
    public function getMenu( $store = null, $scope = ScopeInterface::SCOPE_STORE) {
        return $this->getConfigValue(self::HEADER_GROUP_CONFIGURATION . "/" . self::DADOLUN_MENU_MENU, $store, $scope);
    }

    /**
     * @param null $store
     * @param string $scope
     * @return bool
     */
    public function isMenuEnabled( $store = null, $scope = ScopeInterface::SCOPE_STORE) {
        return $this->getConfigFlag(self::HEADER_GROUP_CONFIGURATION . "/" . self::DADOLUN_MENU_ENABLE, $store, $scope);
    }

    /**
     * @param null $store
     * @param string $scope
     * @return bool
     */
    public function isMenuInsideTopbar( $store = null, $scope = ScopeInterface::SCOPE_STORE) {
        return $this->getConfigFlag(self::HEADER_GROUP_CONFIGURATION . "/" . self::DADOLUN_MENU_TOPBAR, $store, $scope);
    }

    /**
     * @param $field
     * @param null $store
     * @param string $scope
     * @return mixed
     */
    public function getModuleConfigValue($field, $store = null, $scope = ScopeInterface::SCOPE_STORE) {
        return $this->getConfigValue(self::HEADER_GROUP_CONFIGURATION . "/" . $field, $store, $scope);
    }

    /**
     * @param $field
     * @param null $store
     * @param string $scope
     * @return bool
     */
    public function getModuleConfigFlag($field, $store = null, $scope = ScopeInterface::SCOPE_STORE) {
        return $this->getConfigFlag(self::HEADER_GROUP_CONFIGURATION . "/" . $field, $store, $scope);
    }

    /**
     * @param string $fieldPath
     * @param null $store
     * @param string $scope
     * @return bool
     */
    private function getConfigFlag($fieldPath, $store = null, $scope = ScopeInterface::SCOPE_STORE)
    {
        return $this->scopeConfig->isSetFlag(
            $fieldPath,
            $scope,
            $store
        );
    }

    /**
     * @param string $fieldPath
     * @param null $store
     * @param string $scope
     * @return mixed
     */
    private function getConfigValue($fieldPath, $store = null, $scope = ScopeInterface::SCOPE_STORE)
    {
        return $this->scopeConfig->getValue(
            $fieldPath,
            $scope,
            $store
        );
    }
}
