<?php

// src/AppBundle/Command/ImportCardsCommand.php
//
namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use AppBundle\Entity\Card;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\FileLoader;

class ImportCardsCommand extends ContainerAwareCommand
{
   protected function configure()
   {
      $this->setName('app:import-cards');
      $this->setDescription('import cards from a json file.');

      //$this->cardManager = $this->getContainer()->get('app.card_library');
   }

   protected function execute(InputInterface $input, OutputInterface $output)
   {

      $jsonFileDirectory = array(__DIR__);
      $locator = new FileLocator($jsonFileDirectory);
      $files = $locator->locate('AllCards.json', null, false);

      $content = file_get_contents($files[0]);
      $cards = json_decode($content);

      $cardManager = $this->getContainer()->get('AppBundle\Service\CardLibrary');

      $cardManager->updateCards($cards);

   }
}
