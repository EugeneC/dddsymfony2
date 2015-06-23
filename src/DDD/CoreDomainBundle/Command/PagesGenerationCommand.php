<?php

namespace DDD\CoreDomainBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class PagesGenerationCommand
 *
 * @package DDD\CoreDomainBundle\Command
 */
class PagesGenerationCommand extends ContainerAwareCommand
{
    /**
     * Configure command
     */
    protected function configure()
    {
        $this
            ->setName('pages:generate')
            ->setDescription('Generates pages for first use');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('page_service')->generateStartPages();
        $output->writeln('['.(new \DateTime())->format('c').'] Pages successfully generated');
    }
}