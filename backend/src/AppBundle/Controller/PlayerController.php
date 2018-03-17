<?php
// src/AppBundle/Controller/PlayerController.php
namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use AppBundle\Entity\Art;
use AppBundle\Entity\Player;
use AppBundle\Entity\Draft;
use AppBundle\Entity\User;

class PlayerController extends FOSRestController
{
    public function getPlayerAction($draftID, $playerID)
    {
       $player = $this->getDoctrine()
          ->getRepository(Player::class)
          ->findOneById($playerID);

       return $player;
    }

    // this is unused in the current version where each draft only has one player
    public function putPlayerAction($draftID) {
       
       $draft = $this->getDoctrine()
          ->getRepository(Draft::class)
          ->findOneById($draftID);


       $user = $this->getDoctrine()
          ->getRepository(User::class)
          ->findOneById(1);


       $player = $draft->addPlayer($user);


       $em = $this->getDoctrine()->getManager();
       $em->persist($player);
       $em->flush();


       return $player;
    }

    /*
    public function getPickAction($id) {
       $player = $this->getDoctrine()
          ->getRepository(Player::class)
          ->find($playerid);

       $picks = $player->getPool()->getPicks();

       $pickIds = array();
       foreach ($picks as $pick) {
          $pickIds[] = $pick->getArt()->getMultiverseid();
       }

       $ret[] = array(
          'player' => $playerid,
          'picks' => $pickIds
       );

       $response = new JsonResponse($ret);

       $response->headers->set('Access-Control-Allow-Origin', '*');

       return $response;
    }
     */
}

