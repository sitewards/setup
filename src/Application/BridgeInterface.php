<?php

/**
 * This file is part of the Setup package.
 *
 * (c) Sitewards GmbH
 */

namespace Sitewards\Setup\Application;

use Sitewards\Setup\Domain\Page\PageRepositoryInterface;

interface BridgeInterface
{
    /**
     * @return PageRepositoryInterface
     */
    public function getPageRepository();
}