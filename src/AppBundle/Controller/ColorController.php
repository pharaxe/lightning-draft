<?php
// src/AppBundle/Controller/ColorController.php
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
use AppBundle\Entity\Color;
use AppBundle\Entity\Player;
use AppBundle\Entity\Draft;
use AppBundle\Entity\User;
use AppBundle\Controller\PackController;
use Doctrine\Common\Collections\ArrayCollection;

class ColorController extends FOSRestController
{
    /**
     * The colors should come in the JSON body.
     * Hmm maybe this should be in player controller
     */
    public function postAction(Request $request, $draftID, $playerID) {
       $player = $this->getDoctrine()
          ->getRepository(Player::class)
          ->findOneById($playerID);

       $colors = $request->request->get('colors');

       foreach ($colors as $color) {
          $correctColorEntity = $this->getDoctrine()
             ->getRepository(Color::class)
             ->findOneById($color['id']);
          $player->addColor($correctColorEntity);
       }

       // update draft to running.
       $player->getDraft()->setStatus(Draft::STATUS_RUNNING);
       $player->setStartAsNow();

       $em = $this->getDoctrine()->getManager();
       $em->persist($player);
       $em->flush();

       $response = $this->forward('AppBundle\Controller\PackController::getPackAction', array(
          'draftID' => $draftID,
          'playerID' => $playerID
       ));

       return $response;
    }
}
