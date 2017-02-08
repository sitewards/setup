<?php

/**
 * This file is part of the Setup package.
 *
 * (c) Sitewards GmbH
 */

namespace Sitewards\Setup\Service\Page;

use JMS\Serializer\Serializer;
use Sitewards\Setup\Domain\Page\PageRepositoryInterface;
use Symfony\Component\Filesystem\Filesystem;

final class JsonFilesystemExporter implements ExporterInterface
{
    /**
     * @var string
     */
    private $filename = 'pages.json';

    /**
     * @var PageRepositoryInterface
     */
    private $pageRepository;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var array
     */
    private $identifier;

    /**
     * @param PageRepositoryInterface $pageRepository
     * @param Serializer $serializer
     * @param Filesystem $filesystem
     */
    public function __construct(
        PageRepositoryInterface $pageRepository,
        Serializer $serializer,
        Filesystem $filesystem
    )
    {
        $this->pageRepository = $pageRepository;
        $this->serializer     = $serializer;
        $this->filesystem     = $filesystem;
    }

    /**
     * {@inheritdoc}
     */
    public function setIdentifier(array $identifier = [])
    {
        $this->identifier = $identifier;
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $data = $this->pageRepository->find($this->identifier);

        $jsonContent = $this->serializer->serialize($data, 'json');

        $this->filesystem->dumpFile($this->filename, $jsonContent);
    }
}
