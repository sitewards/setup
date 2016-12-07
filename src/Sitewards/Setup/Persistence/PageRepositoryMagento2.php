<?php

namespace Sitewards\Setup\Persistence;

use Sitewards\Setup\Domain\Page;

class PageRepositoryMagento2 implements PageRepositoryInterface
{
    /**
     * @var \Magento\Cms\Api\PageRepositoryInterface
     */
    private $pageRepository;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    private $searchCriteria;

    public function __construct(
        \Magento\Cms\Api\PageRepositoryInterface $pageRepositoryInterface,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteria
    ) {
        $this->pageRepository = $pageRepositoryInterface;
        $this->searchCriteria = $searchCriteria;
    }

    /**
     * @param array $ids
     * @return Page[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function findByIds(array $ids)
    {
        $this->setIdFilter($ids);
        return $this->findItems();
    }

    public function findAll()
    {
        return $this->findItems();
    }

    /**
     * @return Page[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function findItems()
    {
        /** @var \Magento\Framework\Api\SearchResults $results */
        $results = $this->pageRepository->getList($this->searchCriteria->create());

        $pages = [];
        foreach ($results->getItems() as $page) {
            $pages[] = new Page(
                $page['identifier'],
                $page['content'],
                $page['active']
            );
        }

        return $pages;
    }

    /**
     * Set the filter ids
     *
     * @param array $ids
     */
    private function setIdFilter(array $ids)
    {
        if (!empty($ids)) {
            $this->searchCriteria->addFilter(
                'identifier',
                implode(',', $ids),
                'in'
            );
        }
    }
}