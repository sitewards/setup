<?php

namespace Sitewards\Setup\Persistence;

use Sitewards\Setup\Domain\Page;

class PageRepositoryMagento2Dummy implements PageRepositoryInterface
{
    public function findById($id)
    {
        return new Page('Title', 'Content', true);
    }
}
