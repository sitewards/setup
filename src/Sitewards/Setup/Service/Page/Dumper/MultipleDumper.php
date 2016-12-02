<?php

namespace Sitewards\Setup\Service\Page\Dumper;

use JMS\Serializer\Serializer;
use Sitewards\Setup\Persistence\PageRepositoryInterface;

class MultipleDumper extends AbstractDumper
{
    public function prepareData()
    {
        $this->data = $this->pageRepository->findAll();
    }
}
