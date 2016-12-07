<?php

namespace Sitewards\Setup\Service\Page\Dumper;

use JMS\Serializer\Serializer;
use Sitewards\Setup\Persistence\PageRepositoryInterface;

class SingleDumper extends AbstractDumper
{
    /**
     * @var string[]
     */
    private $ids;

    public function __construct(
        PageRepositoryInterface $pageRepository,
        Serializer $serializer,
        array $ids
    ) {
        $this->ids = $ids;

        parent::__construct($pageRepository, $serializer);
    }

    public function prepareData()
    {
        $this->data = $this->pageRepository->findByIds($this->ids);
    }
}
