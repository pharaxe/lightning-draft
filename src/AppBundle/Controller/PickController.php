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
    public function getPicksAction($draftID, $playerID)
    {
       $em = $this->getDoctrine()->getManager();
       $player = $em->getRepository(Player::class)->findOneById($playerID);

       return $player->getPicks();
    }

    public function putPicksAction($draftID, $playerID, $multiverseID) {
       $response = new Response();

       $em = $this->getDoctrine()->getManager();
       $player = $em->getRepository(Player::class)->findOneById($playerID);

       $possiblePicks = $player->getPack()->getPicks();

       foreach ($possiblePicks as $pick) {
          if ($pick->getArt()->getMultiverseid() == $multiverseID) {
             $player->draftPick($pick);

             $em = $this->getDoctrine()->getManager();
             $em->persist($player);
             $em->flush();

             return 'success';
          }
       }

       throw new HttpException(400, "Pick is not valid. Please pick a card from the offered pack");
    }
}
