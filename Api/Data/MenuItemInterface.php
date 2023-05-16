<?php

namespace Dadolun\MegaMenu\Api\Data;

/**
 * Interface MenuItemInterface
 * @package Dadolun\MegaMenu\Api\Data
 */
interface MenuItemInterface
{
    const ID = 'item_id';

    const MENU_ID = 'menu_id';

    const ORDER = 'sort_order';

    const STATUS = 'status';

    const LAYOUT = 'layout';

    const TITLE = 'title';

    const LINK_CLASSES = 'link_classes';

    const ITEM_TYPE = 'item_type';

    const LINKED_ENTITY_ID = 'linked_entity_id';

    const CONTENT = 'content';

    const CONTENT_ADDITIONAL_CLASSES = 'content_additional_classes';

    const CONTENT_DESKTOP_WIDTH = 'content_desktop_width';

    const CONTENT_TABLET_WIDTH = 'content_tablet_width';

    const CONTENT_SECOND = 'content_second';

    const CONTENT_SECOND_ADDITIONAL_CLASSES = 'content_second_additional_classes';

    const CONTENT_SECOND_DESKTOP_WIDTH = 'content_second_desktop_width';

    const CONTENT_SECOND_TABLET_WIDTH = 'content_second_tablet_width';

    const CONTENT_THIRD = 'content_third';

    const CONTENT_THIRD_ADDITIONAL_CLASSES = 'content_third_additional_classes';

    const CONTENT_THIRD_DESKTOP_WIDTH = 'content_third_desktop_width';

    const CONTENT_THIRD_TABLET_WIDTH = 'content_third_tablet_width';

    const CUSTOM_URL = 'custom_url';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    const ENTITY_TYPE_CUSTOM = 'custom';

    const ENTITY_TYPE_CATEGORY = 'category';

    const ENTITY_TYPE_CMS_PAGE = 'cms-page';

    const ITEM_TYPE_MAPPING = [
        self::ENTITY_TYPE_CUSTOM => 0,
        self::ENTITY_TYPE_CATEGORY => 1,
        self::ENTITY_TYPE_CMS_PAGE => 2
    ];

    /**
     * @return integer
     */
    public function getId();

    /**
     * @return integer
     */
    public function getMenuId();

    /**
     * @param integer $menuId
     * @return MenuItemInterface
     */
    public function setMenuId($menuId);

    /**
     * @return integer
     */
    public function getOrder();

    /**
     * @return integer
     */
    public function getStatus();

    /**
    * @return integer
    */
    public function getlayout();

    /**
     * @param integer $order
     * @return MenuItemInterface
     */
    public function setOrder($order);

    /**
     * @param integer $status
     * @return MenuItemInterface
     */
    public function setStatus($status);

    /**
     * @param $layout
     * @return MenuItemInterface
     */
    public function setLayout($layout);

    /**
     * @return string|null
     */
    public function getTitle();

    /**
     * @param string $title
     * @return MenuItemInterface
     */
    public function setTitle($title);

    /**
     * @return string|null
     */
    public function getLinkClasses();

    /**
     * @param string $linkClasses
     * @return MenuItemInterface
     */
    public function setLinkClasses($linkClasses);

    /**
     * @return integer
     */
    public function getItemType();

    /**
     * @param integer $itemType
     * @return MenuItemInterface
     */
    public function setItemType($itemType);

    /**
     * @return integer
     */
    public function getLinkedEntityId();

    /**
     * @return integer $linkedEntityId
     * @return MenuItemInterface
     */
    public function setLinkedEntityId($linkedEntityId);

    /**
     * @return string
     */
    public function getContent();

    /**
     * @param string $content
     * @return MenuItemInterface
     */
    public function setContent($content);

    /**
     * @return string
     */
    public function getContentDesktopWidth();

    /**
     * @param string $content
     * @return MenuItemInterface
     */
    public function setContentDesktopWidth($content);

    /**
     * @return string
     */
    public function getContentTabletWidth();

    /**
     * @param string $content
     * @return MenuItemInterface
     */
    public function setContentTabletWidth($content);

    /**
     * @return string
     */
    public function getContentAdditionalClasses();

    /**
     * @param string $contentAdditionalClasses
     * @return MenuItemInterface
     */
    public function setContentAdditionalClasses($contentAdditionalClasses);

    /**
     * @return string
     */
    public function getContentSecond();

    /**
     * @param string $content
     * @return MenuItemInterface
     */
    public function setContentSecond($content);

    /**
     * @return string
     */
    public function getContentSecondDesktopWidth();

    /**
     * @param string $content
     * @return MenuItemInterface
     */
    public function setContentSecondDesktopWidth($content);

    /**
     * @return string
     */
    public function getContentSecondTabletWidth();

    /**
     * @param string $content
     * @return MenuItemInterface
     */
    public function setContentSecondTabletWidth($content);

    /**
     * @return string
     */
    public function getContentSecondAdditionalClasses();

    /**
     * @param string $contentAdditionalClasses
     * @return MenuItemInterface
     */
    public function setContentSecondAdditionalClasses($contentAdditionalClasses);

    /**
     * @return string
     */
    public function getContentThird();

    /**
     * @param string $content
     * @return MenuItemInterface
     */
    public function setContentThird($content);

    /**
     * @return string
     */
    public function getContentThirdDesktopWidth();

    /**
     * @param string $content
     * @return MenuItemInterface
     */
    public function setContentThirdDesktopWidth($content);

    /**
     * @return string
     */
    public function getContentThirdTabletWidth();

    /**
     * @param string $content
     * @return MenuItemInterface
     */
    public function setContentThirdTabletWidth($content);

    /**
     * @return string
     */
    public function getContentThirdAdditionalClasses();

    /**
     * @param string $contentAdditionalClasses
     * @return MenuItemInterface
     */
    public function setContentThirdAdditionalClasses($contentAdditionalClasses);

    /**
     * @return string
     */
    public function getCustomUrl();

    /**
     * @param string $customUrl
     * @return MenuItemInterface
     */
    public function setCustomUrl($customUrl);

    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @return string
     */
    public function getUpdatedAt();

    /**
     * @param $date
     * @return MenuItemInterface
     */
    public function setUpdatedAt($date);
}
