<?php

namespace Dadolun\MegaMenu\Model;

use Magento\Framework\Model\AbstractModel;
use Dadolun\MegaMenu\Api\MenuResourceInterface;
use Dadolun\MegaMenu\Api\Data\MenuInterface;

/**
 * Class Menu
 * @package Dadolun\MegaMenu\Model
 */
class Menu extends AbstractModel implements MenuInterface {

    const ENTITY = 'dadolun_menu';

    /**
     * @var array
     */
    protected $interfaceAttributes = [
        MenuInterface::ID,
        MenuInterface::NAME,
        MenuInterface::CREATED_AT,
        MenuInterface::UPDATED_AT
    ];

    protected function _construct(){
        $this->_init(MenuResourceInterface::class);
    }

    /**
     * @return int|null
     */
    public function getId() {
        return $this->getData(self::ID);
    }

    /**
     * @return string|null
     */
    public function getName() {
        return $this->getData(self::NAME);
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
     * @param string $name
     * @return Menu
     */
    public function setName($name) {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @param string $date
     * @return Menu
     */
    public function setUpdatedAt($date) {
        return $this->setData(self::CREATED_AT, $date);
    }
}
