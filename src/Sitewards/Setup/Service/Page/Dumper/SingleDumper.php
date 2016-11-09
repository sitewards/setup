<?php

namespace Sitewards\Setup\Service\Page\Dumper;

use JMS\Serializer\Serializer;
use Sitewards\Setup\Persistence\PageRepositoryInterface;

class SingleDumper extends AbstractDumper
{
    private $id;

    public function __construct(PageRepositoryInterface $pageRepository, Serializer $serializer, $id)
    {
        $this->id = $id;

        parent::__construct($pageRepository, $serializer);
    }

    public function prepareData()
    {
        $this->data = $this->pageRepository->findById($this->id);
    }
}
