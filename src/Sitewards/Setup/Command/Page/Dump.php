<?php

namespace Sitewards\Setup\Command\Page;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Sitewards\Setup\Domain\Page;
use Sitewards\Setup\Persistence\PageRepositoryMagento2Dummy;
use Sitewards\Setup\Service\Page\Dumper\SingleDumper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Dump extends Command
{
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
                InputArgument::OPTIONAL,
                'Which page identifier would you like to dump?'
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

        if ($identifier) {
            $pageRepository = new PageRepositoryMagento2Dummy();
            $dumper = new SingleDumper($pageRepository, $serializer, $identifier);
            $dumper->execute();

            $output->writeln('One');
        } else {
            $pages = [
                new Page('Title 1', 'Content 1', true),
                new Page('Title 2', 'Content 2', true),
                new Page('Title 3', 'Content 3', false)
            ];

            $jsonContent = $serializer->serialize($pages, 'json');
            file_put_contents('dump_all.json', $jsonContent);
            $output->writeln('All');
        }
    }
}
