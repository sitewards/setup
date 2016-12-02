<?php

namespace Sitewards\Setup\Command\Page;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Sitewards\Setup\Domain\Page;
use Sitewards\Setup\Persistence\PageRepositoryInterface;
use Sitewards\Setup\Service\Page\Dumper\SingleDumper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Dump extends Command
{
    private $pageRepository;

    public function __construct(
        PageRepositoryInterface $pageRepository
    )
    {
        parent::__construct();
        $this->pageRepository = $pageRepository;
    }

    /*
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

    /*
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $identifier = $input->getArgument('identifier');

        AnnotationRegistry::registerAutoloadNamespace(
            'JMS\Serializer\Annotation',
            'vendor/jms/serializer/src'
        );

        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();

        $dumper = new SingleDumper($this->pageRepository, $serializer, $identifier);
        $dumper->execute();
    }
}
