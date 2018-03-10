<?php
// src/AppBundle/Controller/PackController.php
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

class PackController extends FOSRestController
{
    public function getPackAction($draftID, $playerID)
    {
       $player = $this->getDoctrine()
          ->getRepository(Player::class)
          ->findOneById($playerID);

       if ($player->getPack()->isEmpty()) {
          $draftManager = $this->get('AppBundle\Service\DraftService');
          $draftManager->generatePackFor($player);
       }

       $serializer = $this->container->get('jms_serializer');
       $card_data = $serializer->serialize($player->getPack(), 'json');
       $response = new JsonResponse($card_data);
       $response->headers->set('Access-Control-Allow-Origin', '*');
       return $response;
    }
}

