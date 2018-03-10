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

       $cards = $cardManager->getRandomCards();

       $player->getPack()->addCards($cards);


       $this->em->persist($player);
       $this->em->flush();
   }
}
