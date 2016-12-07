<?php

namespace Sitewards\Setup\Service\Page\Dumper;

use JMS\Serializer\Serializer;
use Sitewards\Setup\Persistence\PageRepositoryInterface;
use Symfony\Component\Filesystem\Filesystem;

class SingleDumper extends AbstractDumper
{
    /**
     * @var string[]
     */
    private $ids;

    public function __construct(
        PageRepositoryInterface $pageRepository,
        Serializer $serializer,
        Filesystem $filesystem,
        array $ids
    ) {
        $this->ids = $ids;

        parent::__construct($pageRepository, $serializer, $filesystem);
    }

    public function prepareData()
    {
        $this->data = $this->pageRepository->findByIds($this->ids);
    }
}
