<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class Panel extends Controller
{
    /**
      * @Route("/panel", name="user_panel")
      */
    public function handlePanel()
    {
        return new JsonResponse([ "errorCode" => 0 ]);
    }
}
