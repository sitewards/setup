<?php

/**
 * This file is part of the Setup package.
 *
 * (c) Sitewards GmbH
 */

namespace Sitewards\Setup;

use Symfony\Component\Console\Application as SymfonyApplication;
use Symfony\Component\Filesystem\Filesystem;

use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Serializer;

use Sitewards\Setup\Application\BridgeInterface;
use Sitewards\Setup\Command\Page\Export;
use Sitewards\Setup\Service\Page\JsonFilesystemExporter;
use Sitewards\Setup\Command\Page\Import;
use Sitewards\Setup\Service\Page\JsonFilesystemImporter;

class Application extends SymfonyApplication
{
    const APPLICATION_NAME    = 'Sitewards Setup';
    const APPLICATION_VERSION = '2.0.1';

    /** @var BridgeInterface */
    private $applicationBridge;

    /** @var Serializer */
    private $serializer;

    public function __construct(BridgeInterface $applicationBridge)
    {
        parent::__construct(self::APPLICATION_NAME, self::APPLICATION_VERSION);
        $this->applicationBridge = $applicationBridge;
        $this->initSerializer();
        $this->initCommands();
    }

    private function initSerializer()
    {
        AnnotationRegistry::registerAutoloadNamespace(
            'JMS\Serializer\Annotation',
            'vendor/jms/serializer/src'
        );

        $this->serializer = SerializerBuilder::create()->build();
    }

    /**
     * @throws \LogicException
     */
    private function initCommands()
    {
        $exporter = new JsonFilesystemExporter(
            $this->applicationBridge->getPageRepository(),
            $this->serializer,
            new Filesystem()
        );

        $this->add(
            new Export($exporter)
        );

        $importer = new JsonFilesystemImporter(
            $this->applicationBridge->getPageRepository(),
            $this->serializer
        );

        $this->add(
            new Import($importer)
        );
    }
}
