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
     * @ParamConverter("colors", class="array<AppBundle\Entity\Color>", converter="fos_rest.request_body")
     * The route for this miiiight be clobbering any future POST draft/players routes. Be warned.
     *
     */
    public function postAction($draftID, $playerID, $colors) {
       $player = $this->getDoctrine()
          ->getRepository(Player::class)
          ->findOneById($playerID);


       foreach ($colors as $color) {
          // somehow, if I don't regrab the color object, they save under new primary key ids.
          $correctColorEntity = $this->getDoctrine()
             ->getRepository(Color::class)
             ->findOneById($color->getId());
          $player->addColor($correctColorEntity);
       }


       // update draft to running.
       $player->getDraft()->setStatus(Draft::STATUS_RUNNING);

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
