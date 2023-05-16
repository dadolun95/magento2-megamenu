<?php

namespace Dadolun\MegaMenu\Api\Data;

/**
 * Interface MenuInterface
 * @package Dadolun\MegaMenu\Api\Data
 */
interface MenuInterface
{
    const ID = 'menu_id';

    const NAME = 'name';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    /**
     * @return integer
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @return string
     */
    public function getUpdatedAt();

    /**
     * @param string $name
     * @return MenuInterface
     */
    public function setName($name);

    /**
     * @param $date
     * @return MenuInterface
     */
    public function setUpdatedAt($date);
}
