<?php

namespace Sitewards\Setup\Service\Page\Dumper;

use JMS\Serializer\Serializer;
use Sitewards\Setup\Persistence\PageRepositoryInterface;
use Symfony\Component\Filesystem\Filesystem;

class Dumper implements DumperInterface
{
    private $filename = 'pages.json';

    /** @var PageRepositoryInterface */
    private $pageRepository;

    /** @var Serializer */
    private $serializer;

    /** @var Filesystem */
    private $filesystem;

    /** @var array */
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
        $data = ($this->identifier)
            ? $this->pageRepository->findByIds($this->identifier)
            : $this->pageRepository->findAll();

        $jsonContent = $this->serializer->serialize($data, 'json');

        $this->filesystem->dumpFile($this->filename, $jsonContent);
    }
}
