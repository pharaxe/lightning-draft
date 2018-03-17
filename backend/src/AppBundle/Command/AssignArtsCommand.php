<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use AppBundle\Entity\Set;
use AppBundle\Entity\Art;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\FileLoader;

class AssignArtsCommand extends ContainerAwareCommand
{
   protected function configure()
   {
      $this->setName('app:assign-arts');
      $this->setDescription('link the card arts to cards from a json file.');

   }

   protected function execute(InputInterface $input, OutputInterface $output)
   {

      $jsonFileDirectory = array(__DIR__ . "/../Resources/json");
      $locator = new FileLocator($jsonFileDirectory);
      ini_set('memory_limit','-1');
      $files = $locator->locate('AllSets.json', null, false);

      $content = file_get_contents($files[0]);
      $cards = json_decode($content);

      $cardManager = $this->getContainer()->get('AppBundle\Service\CardLibrary');

      $cardManager->updateSets($cards);
      $cardManager->assignArts($cards);

   }
}
