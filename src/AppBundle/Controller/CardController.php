<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class CardController 
{
    /**
     * @Route("/card")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
       $number = mt_rand(0, 100);

        return new Response(
           '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }
}
