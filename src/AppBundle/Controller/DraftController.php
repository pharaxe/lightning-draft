<?php
// src/AppBundle/Controller/DraftController.php
namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

use AppBundle\Entity\Art;
use AppBundle\Entity\Player;
use AppBundle\Entity\Draft;
use AppBundle\Entity\Color;


class DraftController extends FOSRestController
{
   
    public function getDraftAction($draftID)
    {
       $draft = $this->getDoctrine()
          ->getRepository(Draft::class)
          ->findOneById($draftID);

       if ($draft) {
          // add guild choices here for now.
          $draftManager = $this->get('AppBundle\Service\DraftService');
          /*
          $guilds = $draftManager->getRandomGuilds();
          $draft->getPlayers()->first()->setGuilds($guilds);
           */

          $serializer = $this->container->get('jms_serializer');
          $draft_data = $serializer->serialize($draft, 'json');
          $response = new JsonResponse($draft_data);
          return $response;
       } else {
          throw new HttpException(500, "Could not find draft with id: " . $draftID);
       }
    }


    /**
     * list of drafts a user is participating or invited to.
     * public function getDraftsAction() {
     *  // big ol todo
     * }
     **/

    /**
     * When a user creates a new draft. Guild choice is in message body.
     */
    public function postDraftAction(Request $request) {
       $serializer = $this->container->get('jms_serializer');
       $draft = new Draft();
       $draft->setup();
       $draftManager = $this->get('AppBundle\Service\DraftService');

       $em = $this->getDoctrine()->getManager();
       $em->persist($draft);
       $em->flush();

       $colors = $request->request->get('colors');

       if ($colors) {
          $this->forward('AppBundle\Controller\ColorController::postAction', array(
             'draftID' => $draft->getId(),
             'playerID' => $draft->getPlayers()->first()->getId(),
             'request' => $request
          ));
       }

       //$draftManager->generatePackFor($draft->getPlayers()->first()); // right now there's only one player per draft.

       $em = $this->getDoctrine()->getManager();
       $em->persist($draft);
       $em->flush();

       // might have to reload draft here. might not.
       $draft_data = $serializer->serialize($draft, 'json');
       
       $response = new JsonResponse($draft_data);

       $response->headers->set('Access-Control-Allow-Origin', '*');

       return $response;
    }


    /**
     * Get three random unique guilds
     */
    public function getGuildsAction() {
       $draftManager = $this->get('AppBundle\Service\DraftService');
       $guilds = $draftManager->getRandomGuilds();

       $serializer = $this->container->get('jms_serializer');
       $guild_data = $serializer->serialize($guilds, 'json');
       
       $response = new JsonResponse($guild_data);

       $response->headers->set('Access-Control-Allow-Origin', '*');

       return $response;
    }

    /*
    public function getPlayerAction($playerid) {
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
