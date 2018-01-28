<?php
// src/AppBundle/Controller/CardController.php
namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class CardController extends FOSRestController
{
    public function getAction(Request $request)
    {
       $term = $request->query->get('name');

       if ($term == null) {
          $term = 'Mox';
       }

       $cardManager = $this->get('AppBundle\Service\CardLibrary');
       $cards = $cardManager->searchCards($term);

       $ret = array(); 
       foreach ($cards as $card) {
          $art = $card->getMiddleArt();

          $ret[] = array(
             'id' => $card->getId(), 
             'name' => $card->getName(), 
             'url' => $art->getFullUrl(),
             'multiverseid' => $art->getMultiverseid());
       }

       $response = new JsonResponse($ret);

       $response->headers->set('Access-Control-Allow-Origin', '*');

       return $response;
    }

    public function getRandomAction() {
       $cardManager = $this->get('AppBundle\Service\CardLibrary');
       $cards = $cardManager->getRandomCards();

       return $cards;
    }
}
