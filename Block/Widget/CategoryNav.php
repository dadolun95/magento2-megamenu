<?php

namespace Dadolun\MegaMenu\Block\Widget;

use Magento\Catalog\Model\Category;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Catalog\Api\CategoryRepositoryInterface as CategoryRepository;

/**
 * Class CategoryNav
 * @package Dadolun\MegaMenu\Block\Widget
 */
class CategoryNav extends Template implements BlockInterface
{

    /**
     * @var string
     */
    protected $_template = "widget/category-nav.phtml";

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * CategoryNav constructor.
     * @param CategoryRepository $categoryRepository
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        CategoryRepository $categoryRepository,
        Template\Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->categoryRepository = $categoryRepository;
    }


    /**
     * @param $categoryId
     * @param int $depth
     * @param bool $show_children_only
     * @return string
     * @throws NoSuchEntityException
     */
    public function getCategoryTreeHtml($categoryId, $depth = 1, $show_children_only = false) {
        $categoryId = str_replace('category/', '', $categoryId);
        /**
         * @var  Category $category
         */
        $category = $this->categoryRepository->get($categoryId);
        $initialLevel = $category->getLevel();
        $html = '<ul class="menu-category-nav">';
        $html .= $this->getCategoryNodeHtml($initialLevel, $category, $depth, $show_children_only);
        $html .= '</ul>';
        return $html;
    }

    /**
     * @param $initialLevel
     * @param $category
     * @param $depth
     * @param $show_children_only
     * @return string
     * @throws NoSuchEntityException
     */
    private function getCategoryNodeHtml($initialLevel, $category, $depth, $show_children_only = false) {
        $html = '';
        if ($category->getIsActive() && $category->getIncludeInMenu()) {
            if ($category->getLevel() < $initialLevel + $depth && $category->getChildren()) {
                $html .= '<li class="level' . $category->getLevel() . ' parent">';
            } else {
                $html .= '<li class="level' . $category->getLevel() . '">';
            }
            if(!$show_children_only) {
                $html .= '<a href="' . $category->getUrl() . '">' . $category->getName() . '</a>';
            }
            if ($category->getLevel() < $initialLevel + $depth && $category->getChildren()) {
                $html .= '<ul class="level' . $category->getLevel() . '">';
                $children = explode(',', $category->getChildren());
                foreach ($children as $childId) {
                    $categoryChild = $this->categoryRepository->get($childId);
                    if ($categoryChild->getLevel() < $initialLevel + $depth) {
                        $html .= $this->getCategoryNodeHtml($initialLevel, $categoryChild, $depth);
                    }
                }
                $html .= '</ul>';
            }
            $html .= '</li>';
        }
        return $html;
    }
}
