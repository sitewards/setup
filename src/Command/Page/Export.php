<?php

/**
 * This file is part of the Setup package.
 *
 * (c) Sitewards GmbH
 */

namespace Sitewards\Setup\Command\Page;

use Sitewards\Setup\Service\Page\ExporterInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class Export extends Command
{
    /** @var ExporterInterface */
    private $exporter;

    /**
     * @param ExporterInterface $exporter
     */
    public function __construct(ExporterInterface $exporter)
    {
        parent::__construct();

        $this->exporter = $exporter;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('page:export')
            ->setDescription('Export page(s) to JSON format')
            ->addArgument(
                'identifier',
                InputArgument::IS_ARRAY,
                'Which page identifier would you like to export?',
                null
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $identifier = $input->getArgument('identifier');

        $this->exporter->setIdentifier($identifier);
        $this->exporter->execute();
    }
}
