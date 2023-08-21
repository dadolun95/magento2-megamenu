<?php

namespace Dadolun\MegaMenu\Model;

use Magento\Framework\Model\AbstractModel;
use Dadolun\MegaMenu\Api\MenuItemResourceInterface;
use Dadolun\MegaMenu\Api\Data\MenuItemInterface;

/**
 * Class MenuItem
 * @package Dadolun\MegaMenu\Model
 */
class MenuItem extends AbstractModel implements MenuItemInterface {

    const ENTITY = 'dadolun_menu_item';

    /**
     * @var array
     */
    protected $interfaceAttributes = [
        MenuItemInterface::ID,
        MenuItemInterface::MENU_ID,
        MenuItemInterface::ORDER,
        MenuItemInterface::STATUS,
        MenuItemInterface::LAYOUT,
        MenuItemInterface::TITLE,
        MenuItemInterface::LINK_CLASSES,
        MenuItemInterface::ITEM_TYPE,
        MenuItemInterface::LINKED_ENTITY_ID,
        MenuItemInterface::CONTENT,
        MenuItemInterface::CONTENT_ADDITIONAL_CLASSES,
        MenuItemInterface::CONTENT_DESKTOP_WIDTH,
        MenuItemInterface::CONTENT_TABLET_WIDTH,
        MenuItemInterface::CONTENT_SECOND,
        MenuItemInterface::CONTENT_SECOND_ADDITIONAL_CLASSES,
        MenuItemInterface::CONTENT_SECOND_DESKTOP_WIDTH,
        MenuItemInterface::CONTENT_SECOND_TABLET_WIDTH,
        MenuItemInterface::CONTENT_THIRD,
        MenuItemInterface::CONTENT_THIRD_ADDITIONAL_CLASSES,
        MenuItemInterface::CONTENT_THIRD_DESKTOP_WIDTH,
        MenuItemInterface::CONTENT_THIRD_TABLET_WIDTH,
        MenuItemInterface::CUSTOM_URL,
        MenuItemInterface::CREATED_AT,
        MenuItemInterface::UPDATED_AT,
    ];

    protected function _construct(){
        $this->_init(MenuItemResourceInterface::class);
    }

    /**
     * @return int|null
     */
    public function getId() {
        return $this->getData(self::ID);
    }

    /**
     * @return string
     */
    public function getMenuId() {
        return $this->getData(self::MENU_ID);
    }

    /**
     * @return integer
     */
    public function getOrder() {
        return $this->getData(self::ORDER);
    }

    /**
     * @return integer
     */
    public function getStatus() {
        return $this->getData(self::STATUS);
    }

    /**
     * @return integer
     */
    public function getLayout() {
        return $this->getData(self::LAYOUT);
    }

    /**
     * @return integer
     */
    public function getTitle() {
        return $this->getData(self::TITLE);
    }

    /**
     * @return string
     */
    public function getLinkClasses() {
        return $this->getData(self::LINK_CLASSES);
    }

    /**
     * @return string
     */
    public function getItemType() {
        return $this->getData(self::ITEM_TYPE);
    }

    /**
     * @return int|mixed
     */
    public function getLinkedEntityId()
    {
        return $this->getData(self::LINKED_ENTITY_ID);
    }

    /**
     * @return string
     */
    public function getContent() {
        return strval($this->getData(self::CONTENT));
    }

    /**
     * @return integer
     */
    public function getContentAdditionalClasses() {
        return $this->getData(self::CONTENT_ADDITIONAL_CLASSES);
    }

    /**
     * @return integer
     */
    public function getContentDesktopWidth() {
        return $this->getData(self::CONTENT_DESKTOP_WIDTH);
    }

    /**
     * @return integer
     */
    public function getContentTabletWidth() {
        return $this->getData(self::CONTENT_TABLET_WIDTH);
    }

    /**
     * @return string
     */
    public function getContentSecond() {
        return strval($this->getData(self::CONTENT_SECOND));
    }

    /**
     * @return integer
     */
    public function getContentSecondAdditionalClasses() {
        return $this->getData(self::CONTENT_SECOND_ADDITIONAL_CLASSES);
    }

    /**
     * @return integer
     */
    public function getContentSecondDesktopWidth() {
        return $this->getData(self::CONTENT_SECOND_DESKTOP_WIDTH);
    }

    /**
     * @return integer
     */
    public function getContentSecondTabletWidth() {
        return $this->getData(self::CONTENT_SECOND_TABLET_WIDTH);
    }

    /**
     * @return strval
     */
    public function getContentThird() {
        return strval($this->getData(self::CONTENT_THIRD));
    }

    /**
     * @return integer
     */
    public function getContentThirdAdditionalClasses() {
        return $this->getData(self::CONTENT_THIRD_ADDITIONAL_CLASSES);
    }

    /**
     * @return integer
     */
    public function getContentThirdDesktopWidth() {
        return $this->getData(self::CONTENT_THIRD_DESKTOP_WIDTH);
    }

    /**
     * @return integer
     */
    public function getContentThirdTabletWidth() {
        return $this->getData(self::CONTENT_THIRD_TABLET_WIDTH);
    }

    /**
     * @return string
     */
    public function getCustomUrl() {
        return $this->getData(self::CUSTOM_URL);
    }

    /**
     * @return string
     */
    public function getCreatedAt() {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @return integer
     */
    public function getUpdatedAt() {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @param integer $menuId
     * @return MenuItemInterface|MenuItem
     */
    public function setMenuId($menuId) {
        return $this->setData(self::MENU_ID, $menuId);
    }

    /**
     * @param integer $order
     * @return MenuItemInterface|MenuItem
     */
    public function setOrder($order) {
        return $this->setData(self::ORDER, $order);
    }

    /**
     * @param integer $status
     * @return MenuItemInterface|MenuItem
     */
    public function setStatus($status) {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * @param integer $layout
     * @return MenuItemInterface|MenuItem
     */
    public function setLayout($layout) {
        return $this->setData(self::LAYOUT, $layout);
    }

    /**
     * @param string $title
     * @return MenuItemInterface|MenuItem
     */
    public function setTitle($title) {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * @param string $linkClasses
     * @return MenuItemInterface|MenuItem
     */
    public function setLinkClasses($linkClasses) {
        return $this->setData(self::LINK_CLASSES, $linkClasses);
    }

    /**
     * @param integer $itemType
     * @return MenuItemInterface|MenuItem
     */
    public function setItemType($itemType) {
        return $this->setData(self::ITEM_TYPE, $itemType);
    }

    /**
     * @param integer $linkedEntityId
     * @return MenuItemInterface|MenuItem
     */
    public function setLinkedEntityId($linkedEntityId)
    {
        return $this->setData(self::LINKED_ENTITY_ID, $linkedEntityId);
    }

    /**
     * @param string $content
     * @return MenuItemInterface|MenuItem
     */
    public function setContent($content) {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * @param string $contentAdditionalClasses
     * @return MenuItemInterface|MenuItem
     */
    public function setContentAdditionalClasses($contentAdditionalClasses) {
        return $this->setData(self::CONTENT_ADDITIONAL_CLASSES, $contentAdditionalClasses);
    }

    /**
     * @param string $contentWidth
     * @return MenuItemInterface|MenuItem
     */
    public function setContentDesktopWidth($contentWidth) {
        return $this->setData(self::CONTENT_DESKTOP_WIDTH, $contentWidth);
    }

    /**
     * @param string $contentWidth
     * @return MenuItemInterface|MenuItem
     */
    public function setContentTabletWidth($contentWidth) {
        return $this->setData(self::CONTENT_TABLET_WIDTH, $contentWidth);
    }

    /**
     * @param string $content
     * @return MenuItemInterface|MenuItem
     */
    public function setContentSecond($content) {
        return $this->setData(self::CONTENT_SECOND, $content);
    }

    /**
     * @param string $contentAdditionalClasses
     * @return MenuItemInterface|MenuItem
     */
    public function setContentSecondAdditionalClasses($contentAdditionalClasses) {
        return $this->setData(self::CONTENT_SECOND_ADDITIONAL_CLASSES, $contentAdditionalClasses);
    }

    /**
     * @param string $contentSecondWidth
     * @return MenuItemInterface|MenuItem
     */
    public function setContentSecondDesktopWidth($contentSecondWidth) {
        return $this->setData(self::CONTENT_SECOND_DESKTOP_WIDTH, $contentSecondWidth);
    }

    /**
     * @param string $contentSecondWidth
     * @return MenuItemInterface|MenuItem
     */
    public function setContentSecondTabletWidth($contentSecondWidth) {
        return $this->setData(self::CONTENT_SECOND_TABLET_WIDTH, $contentSecondWidth);
    }

    /**
     * @param string $content
     * @return MenuItemInterface|MenuItem
     */
    public function setContentThird($content) {
        return $this->setData(self::CONTENT_THIRD, $content);
    }

    /**
     * @param string $contentAdditionalClasses
     * @return MenuItemInterface|MenuItem
     */
    public function setContentThirdAdditionalClasses($contentAdditionalClasses) {
        return $this->setData(self::CONTENT_THIRD_ADDITIONAL_CLASSES, $contentAdditionalClasses);
    }

    /**
     * @param string $contentThirdWidth
     * @return MenuItemInterface|MenuItem
     */
    public function setContentThirdDesktopWidth($contentThirdWidth) {
        return $this->setData(self::CONTENT_THIRD_DESKTOP_WIDTH, $contentThirdWidth);
    }

    /**
     * @param string $contentThirdWidth
     * @return MenuItemInterface|MenuItem
     */
    public function setContentThirdTabletWidth($contentThirdWidth) {
        return $this->setData(self::CONTENT_THIRD_TABLET_WIDTH, $contentThirdWidth);
    }

    /**
     * @param string $customUrl
     * @return MenuItemInterface|MenuItem
     */
    public function setCustomUrl($customUrl) {
        return $this->setData(self::CUSTOM_URL, $customUrl);
    }

    /**
     * @param string $date
     * @return MenuItemInterface|MenuItem
     */
    public function setUpdatedAt($date) {
        return $this->setData(self::UPDATED_AT, $date);
    }
}
