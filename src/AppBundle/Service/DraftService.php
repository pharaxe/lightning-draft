<?php

// src/AppBundle/Service/PlayerService.php
namespace AppBundle\Service;

use \DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\Container;
use AppBundle\Entity\Card;
use AppBundle\Entity\Color;
use AppBundle\Entity\Type;
use AppBundle\Entity\Set;
use AppBundle\Entity\Art;
use Symfony\Component\Config\FileLocator;
use Doctrine\Common\Collections\ArrayCollection;

class DraftService
{
   protected $em;
   private $container;
   
   public function __construct(EntityManager $entityManager, Container $container)
   {
      $this->em = $entityManager;
      $this->container = $container;

   }

   public function generatePackFor($player) {
       $cardManager = $this->container->get('AppBundle\Service\CardLibrary');

       $colors = $player->getColors();
       $cards = $cardManager->getRandomCards($colors);

       $player->getPack()->addCards($cards);


       $this->em->persist($player);
       $this->em->flush();
   }

   public function getRandomGuilds() {
      $sql = "Select `colorid` from `colors` order by RAND(), colorid ASC limit 2";

      $db = $this->em->getConnection();

      $statement = $db->prepare($sql);

      $guilds = new ArrayCollection();

      while ($guilds->count() < 3) {
         $statement->execute();
         $randomGuild = $statement->fetchAll();
         $colorIDs = array();
         foreach ($randomGuild as $color) {
            $colorIDs[] = $color['colorid'];
         }
         $colorEntities = $this->em->getRepository(Color::class)->findById($colorIDs);

         if (!$guilds->contains($colorEntities))  { // no duplicate guilds
            $guilds->add($colorEntities);
         }
      }

      return $guilds;
   }
}
