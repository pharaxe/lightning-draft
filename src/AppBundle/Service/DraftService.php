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
use AppBundle\Entity\Draft;
use AppBundle\Entity\User;
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

   public function setupDraft($draft, $uuid = null) {
      // for now, there's only one player per draft. 
      if ($uuid == null) {
         $user = new User(); // create blank user with no uuid.
      } else {
         // look for existing user.
         $user = $this->em->getRepository(User::class)->findOneByUuid($uuid);
         if ($user == null) {
            // create new user.
            $user = new User();
            $user->setUUID($uuid);
         }
      }

      $draft->createPlayer($user);
      $draft->setStatus(Draft::STATUS_SETUP);

      $this->em->persist($draft);
      $this->em->flush();
   }

   public function generatePackFor($player) {
       $cardManager = $this->container->get('AppBundle\Service\CardLibrary');
       $landPick = false;

       $landCount = $player->getLandCount();
       $cardCount = $player->getDeckSize();

       if ($landCount < 1) {
          if ($cardCount == 10) { // force land pick at pick 10
             $landPick = true;
          } else if ($cardCount >= 5) {
             // after pick 5, 10% chance for a land pick.
             $landPick = (rand(1, 10) == 1);
          }
       } 
       
       // wait till at least pick 10 for second land
       if ($landCount < 2) {
          if ($cardCount == 20) { // force second land pick at 20
             $landPick = true;
          } else if ($cardCount >= 15) {  // at least wait until pick 15
             $landPick = (rand(1, 10) == 1);
          }    
       }

       // determine rarity
       if ($landPick) {
          $rarities = array('mythic', 'rare', 'uncommon');
       } else {
          $diceRoll = rand(1, 20);

          if ($diceRoll < 13) {
             $rarities = array('common');
          } else if ($diceRoll < 18) {
             $rarities = array('uncommon');
          } else if ($diceRoll >= 18) {
             $rarities = array('rare');
          } else if ($diceRoll == 20) {
             $rarities = array('mythic');
          }
       }

       // determine if to look for colorless cards.
       $colorless = ($landPick || rand(1, 10) > 5);

       // determine if we should include noncreatures.
       $noncreatures = (rand(1, 10) > 6);

       $cards = $cardManager->getRandomCards(
          $colors = $player->getColors(),
          $limit = 3,
          $getLand = $landPick,
          $allowColorless = $colorless,
          $restrictRarities = $rarities,
          $allowSpells = $noncreatures
       );

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
