<?php

namespace Sitewards\Setup\Command\Page;

use Sitewards\Setup\Service\Page\Dumper\DumperInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Dump extends Command
{
    /** @var DumperInterface */
    private $dumper;

    /**
     * @param DumperInterface $dumper
     */
    public function __construct(DumperInterface $dumper)
    {
        parent::__construct();

        $this->dumper = $dumper;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('page:dump')
            ->setDescription('Dump page(s) to JSON format')
            ->addArgument(
                'identifier',
                InputArgument::IS_ARRAY,
                'Which page identifier would you like to dump?',
                null
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $identifier = $input->getArgument('identifier');

        $this->dumper->setIdentifier($identifier);
        $this->dumper->execute();
    }
}
