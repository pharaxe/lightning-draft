<?php

// src/AppBundle/Command/CleanupCardsCommand.php
//
namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use AppBundle\Entity\Card;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\FileLoader;

class CleanupCardsCommand extends ContainerAwareCommand
{
   protected function configure()
   {
      $this->setName('app:cleanup-cards');
      $this->setDescription('delete the un-cards and cards without art.');
   }

   protected function execute(InputInterface $input, OutputInterface $output)
   {

      $sqlFileDirectory = array(__DIR__ . "/../Resources/sql");
      $locator = new FileLocator($sqlFileDirectory);
      $files = $locator->locate('del_artless.sql', null, false);

      $sql = file_get_contents($files[0]);

      $em = $this->getContainer()->get('doctrine.orm.entity_manager');
      $stmt = $em->getConnection()->prepare($sql);
      $rows = $stmt->execute();
   }
}

