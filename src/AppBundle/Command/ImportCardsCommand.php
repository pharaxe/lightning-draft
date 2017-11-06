<?php

// src/AppBundle/Command/ImportCardsCommand.php
//
namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use AppBundle\Entity\Card;

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
$filename = "AllCards.json";
$handle = fopen($filename, "r");
$allCards = fread($handle, filesize($filename));
$cards = json_decode($allCards);
fclose($handle);

$errHandle = fopen("import_errors.txt", "w");

      $doctrine = $this->getContainer()->get('doctrine');
      $em = $doctrine->getEntityManager();

      $card = new Card();
      $card->setName('Nidoran');

      $em->persist($card);
      $em->flush();


      $output->writeln('testing');
   }
}
