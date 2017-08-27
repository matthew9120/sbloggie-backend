<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\User\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BasicAuth extends Controller
{
    /**
     * @Route("/basic-auth/get-token", name="basic_logging")
     */
    public function getToken(UserInterface $user)
    {
        return new JsonResponse([ "errorCode" => 0, "apiKey" => $user->getApiKey() ]);
    }
}
