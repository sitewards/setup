<?php

/**
 * This file is part of the Setup package.
 *
 * (c) Sitewards GmbH
 */

namespace Sitewards\Setup\Domain\Page;

interface PageRepositoryInterface
{
    /**
     * @param array $ids
     *
     * @return PageInterface[]
     */
    public function findByIds(array $ids);

    /**
     * @return PageInterface[]
     */
    public function findAll();

    /**
     * @param PageInterface $page
     *
     * @return void
     */
    public function import(PageInterface $page);
}
