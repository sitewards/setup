<?php

namespace Sitewards\Setup\Service\Page\Dumper;

use JMS\Serializer\Serializer;
use Sitewards\Setup\Persistence\PageRepositoryInterface;
use Symfony\Component\Filesystem\Filesystem;

abstract class AbstractDumper
{
    protected $filename = 'pages.json';

    protected $data;

    protected $serializer;

    public function __construct(
        PageRepositoryInterface $pageRepository,
        Serializer $serializer,
        Filesystem $filesystem
    )
    {
        $this->pageRepository = $pageRepository;
        $this->serializer = $serializer;
        $this->filesystem = $filesystem;
    }

    abstract protected function prepareData();

    public function execute()
    {
        $this->prepareData();

        $jsonContent = $this->serializer->serialize($this->data, 'json');

        $this->filesystem->dumpFile($this->filename, $jsonContent);
    }
}
