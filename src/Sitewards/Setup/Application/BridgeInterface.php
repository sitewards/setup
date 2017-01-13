<?php

namespace Sitewards\Setup\Application;

use Sitewards\Setup\Domain\Page\PageRepositoryInterface;

interface BridgeInterface
{
    /**
     * @return PageRepositoryInterface
     */
    public function getPageRepository();
}