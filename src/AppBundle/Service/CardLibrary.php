<?php

// src/AppBundle/Service/CardLibrary.php
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

class CardLibrary
{
   protected $em;
   private $container;
   
   public function __construct(EntityManager $entityManager, Container $container)
   {
      $this->em = $entityManager;
      $this->container = $container;

   }

   public function searchCards($search) {

      $db = $this->em->getRepository(Card::class);

      $qb = $db->createQueryBuilder('c');

      $qb->where("c.name LIKE ?1") 
         ->setMaxResults(10)
         ->setParameter(1, "%" . $search ."%");

      $query = $qb->getQuery();

      $result = $query->getResult();

      return $result;
   }

   public function updateCards($cards) 
   {
      // make sure some associations exist in case fresh db.
      $this->fillColorTable();
      $this->fillTypesTable(); 

      // turn off query logging so we don't run out of memory during this script.
      $this->em->getConnection()->getConfiguration()->setSQLLogger(null);

      $counter = 1;
      foreach ($cards as $card) {
         echo $counter . ': ';
         $this->updateCard($card);
         $counter++;
      }

   }

   private function updateCard($data) 
   {
      // find the card in the database
      $card = $this->em->getRepository(Card::class)->findOneByName($data->name);
      
      // insert instead of update for brand new entries.

      if ($card == null) {
         $card = new Card(); 
         echo 'inserting ' . $data->name . "\n";
      } else {
         echo 'updating ' . $data->name . "\n";
      }


      $card->setName($data->name);
      if (isset($data->power) && is_int($data->power))
            $card->setPower($data->power);

      if (isset($data->toughness) && is_int($data->toughness))
            $card->setToughness($data->toughness);

      if (isset($data->cmc))
         $card->setCmc($data->cmc);
      else
         $card->setCmc(0);

      if (isset($data->manaCost))
         $card->setManaCost($data->manaCost);

      if (isset($data->text))
         $card->setAbility(utf8_encode($data->text));

      if (isset($data->colors)) {
         foreach($data->colors as $colorName) {
            $color = $this->em->getRepository(Color::class)->findOneByName($colorName);
            $card->addColor($color);
         }
      }

      if (isset($data->colorIdentity)) {
         foreach($data->colorIdentity as $colorSymbol) {
            $color = $this->em->getRepository(Color::class)->findOneBySymbol($colorSymbol);
            $card->addIdentity($color);
         }
      }

      if (isset($data->types)) {
         $auraFlag = false;
         foreach($data->types as $typeName) {
            if ($typeName == 'Eaturecray')
               $typeName = 'Creature'; // hack for a pig latin joke card that exists.

            if ($typeName == 'Enchant')  {
               $auraFlag = true;
               $typeName = 'Enchantment';
            }

            $type = $this->em->getRepository(Type::class)->findOneByName($typeName);

            if ($type) {
               $card->addType($type);
            }

            if ($auraFlag) {
               break; // stop adding types so 'Enchant Creature' doesn't count as a creature.
            }
         }
      }

      $this->em->persist($card);
      $this->em->flush();
      $this->em->detach($card);
      $card = null;
      unset($card);
      $this->em->clear();
   }


   /**
    * If the color table is empty, this will fill it with the 5 colors.
    * otherwise, the function does nothing.
    */
   public function fillColorTable() 
   {
      $colors = array(
         array('name' => 'white', 'symbol' => 'W'),
         array('name' => 'blue', 'symbol' => 'U'),
         array('name' => 'black', 'symbol' => 'B'),
         array('name' => 'red', 'symbol' => 'R'),
         array('name' => 'green', 'symbol' => 'G')
      );

      foreach ($colors as $colorInfo) {
         $color = $this->em->getRepository(Color::class)->findOneByName($colorInfo['name']);

         if ($color == null) {
            $color = new Color();
            $color->setName($colorInfo['name']);
            $color->setSymbol($colorInfo['symbol']);
            $this->em->persist($color);
         }
      }
      $this->em->flush();
   }

   public function fillTypesTable()  
   {

      $types = array('creature', 'artifact', 'sorcery', 'enchantment', 'instant', 'land', 'conspiracy', 'planeswalker');

      foreach ($types as $typeName) {
         $type = $this->em->getRepository(Type::class)->findOneByName($typeName);

         if ($type = null) {
            $type = new Type();
            $type->setName($typeName);
            $this->em->persist($type);
         }
      }

      $this->em->flush();
   }

   public function updateSets($data) {
      foreach ($data as $set) {
         $this->updateSet($set);
      }

      $this->em->flush();
   }

   public function updateSet($data) {
      // see if the set is in the database
      $set = $this->em->getRepository(Set::class)->findOneByName($data->name);

      if ($set == null) {
         $set = new Set(); 
         echo 'inserting ' . $data->name . "\n";
      } else {
         echo 'updating ' . $data->name . "\n";
      }

      $set->setName($data->name);
      $set->setCode($data->code);
      $date = DateTime::createFromFormat('Y-m-d', $data->releaseDate); 
      if ($date == null) {
         echo DateTime::getLastErrors();
      }

      $set->setReleaseDate($date);

      $this->em->persist($set);
   }

   public function assignArts($data) {
      // turn off query logging so we don't run out of memory during this script.
      $this->em->getConnection()->getConfiguration()->setSQLLogger(null);

      foreach ($data as $setData) {
         $set = $this->em->getRepository(Set::class)->findOneByCode($setData->code);

         if ($set == null) {
            echo "Couldn't find set in database for " . $setData->code . "\n";
            return;
         }

         $artsToAssign = $setData->cards; 
         foreach ($artsToAssign as $artData) {
            if (!isset($artData->multiverseid))  {
               // this is a card token, don't put in DB
               continue;
            }

            $art = $this->em->getRepository(Art::class)->findOneByMultiverseid($artData->multiverseid);

            if ($art == null) {
               $art = new Art();
               echo 'inserting ' . $artData->name . "\n";
            } else {
               echo 'updating ' . $artData->name . "\n";
            }

            $card = $this->em->getRepository(Card::class)->findOneByName($artData->name);

            if ($card == null) {
               echo "Couldn't find card for art: " . $artData->name . "\n";
               continue;
            }

            $art->setMultiverseid($artData->multiverseid);
            $art->setArtist($artData->artist);
            $art->setRarity($artData->rarity);

            // TODO find out URL

            $art->setSet($set);
            $art->setCard($card);

            $this->em->persist($art);
            $this->em->flush();
         }
      }



   }
}
