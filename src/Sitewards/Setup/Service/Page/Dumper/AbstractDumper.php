<?php

namespace Sitewards\Setup\Service\Page\Dumper;

use JMS\Serializer\Serializer;
use Sitewards\Setup\Persistence\PageRepositoryInterface;

abstract class AbstractDumper
{
    protected $filename = 'pages.json';

    protected $data;

    protected $serializer;

    public function __construct(PageRepositoryInterface $pageRepository, Serializer $serializer)
    {
        $this->pageRepository = $pageRepository;
        $this->serializer = $serializer;
    }

    abstract protected function prepareData();

    public function execute()
    {
        $this->prepareData();

        $jsonContent = $this->serializer->serialize($this->data, 'json');
        file_put_contents($this->filename, $jsonContent);
    }
}
