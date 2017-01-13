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
use Sitewards\Setup\Service\Page\Exporter;
use Sitewards\Setup\Service\Page\Importer;
use Sitewards\Setup\Command\Page\Import;

class Application extends SymfonyApplication
{
    /** @var BridgeInterface */
    private $applicationBridge;

    /** @var Serializer */
    private $serializer;

    public function __construct(
        $defaultName = 'Sitewards Setup',
        $version = '1.0.0',
        BridgeInterface $applicationBridge
    ) {
        parent::__construct($defaultName, $version);
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
        $exporter = new Exporter(
            $this->applicationBridge->getPageRepository(),
            $this->serializer,
            new Filesystem()
        );

        $this->add(
            new Export($exporter)
        );

        $importer = new Importer(
            $this->applicationBridge->getPageRepository(),
            $this->serializer
        );

        $this->add(
            new Import($importer)
        );
    }
}