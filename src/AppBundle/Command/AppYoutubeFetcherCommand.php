<?php

namespace AppBundle\Command;

use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AppYoutubeFetcherCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:youtube-fetcher')
            ->setDescription('Fetch a youtube thumbnail')
            ->addOption('max', 'm', InputOption::VALUE_OPTIONAL, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        dump($input->getOption('env'));
        $output->writeln('This is for debug only', OutputInterface::VERBOSITY_DEBUG);
    }

    protected function get($id)
    {
        return $this->getContainer()->get($id);
    }
}
