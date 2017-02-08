<?php

/**
 * This file is part of the Setup package.
 *
 * (c) Sitewards GmbH
 */

namespace Sitewards\Setup\Service\Page;

use JMS\Serializer\Serializer;
use Sitewards\Setup\Domain\Page\PageRepositoryInterface;

final class JsonFilesystemImporter implements ImporterInterface
{
    /** @var string */
    private $filename = 'pages.json';

    /** @var PageRepositoryInterface */
    private $pageRepository;

    /** @var Serializer */
    private $serializer;

    /**
     * @param PageRepositoryInterface $pageRepository
     * @param Serializer $serializer
     */
    public function __construct(
        PageRepositoryInterface $pageRepository,
        Serializer $serializer
    )
    {
        $this->pageRepository = $pageRepository;
        $this->serializer     = $serializer;
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pages = $this->serializer->deserialize(file_get_contents($this->filename), 'array<Sitewards\Setup\Domain\Page\Page>', 'json');

        foreach ($pages as $page) {
            $this->pageRepository->save($page);
        }
    }
}
