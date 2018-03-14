<?php
// src/AppBundle/Controller/PickController.php
namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

use AppBundle\Entity\Art;
use AppBundle\Entity\Player;
use AppBundle\Entity\Draft;
use AppBundle\Entity\Pool;

class PickController extends FOSRestController
{
    /* Returns the decklist so far the player */
    public function getPicksAction($draftID, $playerID)
    {
       $em = $this->getDoctrine()->getManager();
       $player = $em->getRepository(Player::class)->findOneById($playerID);

       return $player->getPicks();
    }

    public function putPicksAction($draftID, $playerID, $cardid) {
       $response = new Response();
       $serializer = $this->container->get('jms_serializer');

       $em = $this->getDoctrine()->getManager();
       $player = $em->getRepository(Player::class)->findOneById($playerID);

       $possiblePicks = $player->getPack()->getPicks();

       foreach ($possiblePicks as $pick) {
          if ($pick->getArt()->getCard()->getId() == $cardid) {
             $player->draftPick($pick);
             // pick recorded, now get the next pack of cards.

             if ($player->getPicks()->getCount() < Draft::DECKSIZE_LIMIT) {
                $draftManager = $this->get('AppBundle\Service\DraftService');
                $draftManager->generatePackFor($player);
             } else { 
                // don't get more cards if deck is completed.
                $player->getDraft()->setStatus(Draft::STATUS_COMPLETED);
                $em->persist($player);
                $em->flush();
             }

             $card_data = $serializer->serialize($player->getPack(), 'json');
             $response = new JsonResponse($card_data);
             $response->headers->set('Access-Control-Allow-Origin', '*');
             return $response;
          }
       }

       // If pick is not found, return the pack again in case frontend is out of sync.
       $card_data = $serializer->serialize($player->getPack(), 'json');
       $response = new JsonResponse($card_data);
       $response->setStatusCode(500);
       $response->headers->set('Access-Control-Allow-Origin', '*');
       return $response;
    }
}
