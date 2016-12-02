<?php

namespace Sitewards\Setup\Persistence;

use Sitewards\Setup\Domain\Page;

class PageRepositoryMagento2 implements PageRepositoryInterface
{
    /**
     * @var \Magento\Cms\Api\PageRepositoryInterface
     */
    private $pageRepository;

    public function __construct(
        \Magento\Cms\Api\PageRepositoryInterface $pageRepository
    ) {
        $this->pageRepository = $pageRepository;
    }

    public function findById($id)
    {
        /** @var \Magento\Cms\Api\Data\PageInterface $page */
        $page = $this->pageRepository->getById($id);

        return new Page(
            $page->getTitle(),
            $page->getContent(),
            $page->isActive()
        );
    }
}