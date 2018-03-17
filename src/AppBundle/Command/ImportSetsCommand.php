<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\FileLoader;

class ImportSetsCommand extends ContainerAwareCommand
{
   protected function configure()
   {
      $this->setName('app:import-sets');
      $this->setDescription('import set info to database.');

   }

   protected function execute(InputInterface $input, OutputInterface $output)
   {

      $jsonFileDirectory = array(__DIR__ . '/../Resources/json');
      $locator = new FileLocator($jsonFileDirectory);
      $files = $locator->locate('SetList.json', null, false);

      $content = file_get_contents($files[0]);
      $sets = json_decode($content);

      $cardManager = $this->getContainer()->get('AppBundle\Service\CardLibrary');

      $cardManager->updateSets($sets);

   }
}
