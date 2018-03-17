<?php
// src/AppBundle/Controller/DeckController.php
namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Entity\Art;
use AppBundle\Entity\Player;
use AppBundle\Entity\Draft;
use AppBundle\Entity\Pool;

class DeckController extends FOSRestController
{
    public function getDeckAction($draftID, $playerID)
    {
       $em = $this->getDoctrine()->getManager();
       $player = $em->getRepository(Player::class)->findOneById($playerID);

       $txt = "";

       $picks = $player->getPicks()->getPicks();

       $cards = [];
       foreach ($picks as $pick){
          $cards[] = $pick->getArt()->getCard();
       }

       usort($cards, array("AppBundle\Entity\Card", "sortByCmc"));

       foreach ($cards as $card) {
          $txt .= $card->getName() . "\n";
       }

       $response = new Response($txt);
       $response->headers->set('Access-Control-Allow-Origin', '*');
       $response->headers->set('Content-Type', 'text/plain');
       return $response;
    }
}

