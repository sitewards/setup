<?php

/**
 * This file is part of the Setup package.
 *
 * (c) Sitewards GmbH
 */

namespace Sitewards\Setup\Command\Page;

use Sitewards\Setup\Service\Page\ImporterInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class Import extends Command
{
    /** @var ImporterInterface */
    private $importer;

    /**
     * @param ImporterInterface $importer
     */
    public function __construct(ImporterInterface $importer)
    {
        parent::__construct();

        $this->importer = $importer;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('page:import')
            ->setDescription('Import page(s) from JSON format');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->importer->execute();
    }
}
