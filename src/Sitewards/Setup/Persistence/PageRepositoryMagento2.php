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
     * @param $id
     * @return Page[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function findById($id)
    {
        if (!empty($id)) {
            $this->searchCriteria->addFilter(
                'identifier',
                implode(',', $id),
                'in'
            );
        }

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
}