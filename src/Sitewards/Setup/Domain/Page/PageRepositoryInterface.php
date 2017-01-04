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
     * @return Page[]
     */
    public function findByIds(array $ids);

    /**
     * @return Page[]
     */
    public function findAll();
}
