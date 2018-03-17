<?php

// src/AppBundle/Command/CreateDatabaseCommand.php
//
namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use AppBundle\Entity\Card;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\FileLoader;

class CreateDatabaseCommand extends ContainerAwareCommand
{
   protected function configure()
   {
      $this->setName('app:create-database');
      $this->setDescription('run the create tables');
   }

   protected function execute(InputInterface $input, OutputInterface $output)
   {

      $sqlFileDirectory = array(__DIR__ . "/../Resources/sql");
      $locator = new FileLocator($sqlFileDirectory);

      foreach (array('cards.sql', 'draft.sql') as $filename) {
         $files = $locator->locate($filename, null, false);

         $sql = file_get_contents($files[0]);

         $em = $this->getContainer()->get('doctrine.orm.entity_manager');
         $stmt = $em->getConnection()->prepare($sql);
         $rows = $stmt->execute();
      }
   }
}


