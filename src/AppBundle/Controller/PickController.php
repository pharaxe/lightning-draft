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

use AppBundle\Entity\Art;
use AppBundle\Entity\Player;
use AppBundle\Entity\Draft;
use AppBundle\Entity\Pool;

class PickController extends FOSRestController
{
    public function getPicksAction($draftID, $playerID)
    {

       return $response;
    }

    public function postPicksAction($draftID, $playerID) {

    }
}
