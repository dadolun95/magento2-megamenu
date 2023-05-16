<?php

namespace Dadolun\MegaMenu\Ui\Component\CmsPage;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Cms\Model\ResourceModel\Page\CollectionFactory as CmsPageCollectionFactory;
use Magento\Framework\App\RequestInterface;

/**
 * Class Options
 * @package Dadolun\MegaMenu\Ui\Component\Categories
 */
class Options implements OptionSourceInterface
{
    /**
     * @var \Magento\Cms\Model\ResourceModel\Page\CollectionFactory
     */
    protected $cmsPageCollectionFactory;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var array
     */
    protected $cmsPages;

    /**
     * @param CmsPageCollectionFactory $cmsPageCollectionFactory
     * @param RequestInterface $request
     */
    public function __construct(
        CmsPageCollectionFactory $cmsPageCollectionFactory,
        RequestInterface $request
    ) {
        $this->cmsPageCollectionFactory = $cmsPageCollectionFactory;
        $this->request = $request;
    }

    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        return $this->getCmsPages();
    }

    /**
     * @return array|mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function getCmsPages()
    {
        if ($this->cmsPages === null) {
            $storeId = $this->request->getParam('store_id');
            /* @var $cmsPagesCollection \Magento\Cms\Model\ResourceModel\Page\Collection */
            $cmsPagesCollection = $this->cmsPageCollectionFactory->create();

            $cmsPagesCollection
                ->addStoreFilter($storeId, false)
                ->addFieldToFilter('is_active', true)
                ->getItems();

            $cmsPages = [];

            foreach ($cmsPagesCollection as $cmsPage) {
                $cmsPages[] = [
                    'value' => $cmsPage->getId(),
                    'label' => $cmsPage->getTitle()
                ];
            }

            $this->cmsPages = $cmsPages;
        }

        return $this->cmsPages;
    }
}
