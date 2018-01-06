<?php
// src/AppBundle/Controller/CardController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Entity\Art;
use AppBundle\Entity\Player;

class DraftController extends Controller
{
    /**
     * @Route("/draft")
     */
    public function indexAction(Request $request)
    {
       $multiverseid = $request->query->get('card');
       $playerid = $request->query->get('player');


       $art = $this->getDoctrine()
          ->getRepository(Art::class)
          ->findOneByMultiverseid($multiverseid);

       $player = $this->getDoctrine()
          ->getRepository(Player::class)
          ->find($playerid);

       $poolid = $player->getPool()->getId();

       $player->draftArt($art);

       $em = $this->getDoctrine()->getManager();

       $em->persist($player);
       $em->flush();

       $m = $player->getPool()->getPicks()->first();
       $art = $m->getArt();

       $ret[] = array(
          'response' => "hello world",
          'mid' => $art->getMultiverseid()
       );

       $response = new JsonResponse($ret);

       $response->headers->set('Access-Control-Allow-Origin', '*');

       return $response;
    }
}
