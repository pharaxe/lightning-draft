<?php
// src/AppBundle/Controller/CardController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class CardController extends Controller
{
    /**
     * @Route("/card")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
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
}
