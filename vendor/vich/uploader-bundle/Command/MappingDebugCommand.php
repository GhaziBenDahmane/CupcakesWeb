<?php

namespace Vich\UploaderBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
<<<<<<< HEAD
=======

>>>>>>> anis
use Vich\UploaderBundle\Exception\MappingNotFoundException;

class MappingDebugCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('vich:mapping:debug')
            ->setDescription('Debug a mapping.')
            ->addArgument('mapping', InputArgument::REQUIRED, 'The mapping to debug.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $mappings = $this->getContainer()->getParameter('vich_uploader.mappings');
<<<<<<< HEAD
        $mapping = $input->getArgument('mapping');
=======
        $mapping  = $input->getArgument('mapping');
>>>>>>> anis

        if (!isset($mappings[$mapping])) {
            throw new MappingNotFoundException(sprintf('Mapping "%s" does not exist.', $mapping));
        }

        $output->writeln(sprintf('Debug information for mapping <info>%s</info>', $mapping));

<<<<<<< HEAD
        foreach ($mappings[$mapping] as $key => $value) {
=======
        foreach($mappings[$mapping] as $key => $value) {
>>>>>>> anis
            $output->writeln(sprintf('<comment>%s</comment>: %s', $key, var_export($value, true)));
        }
    }
}
