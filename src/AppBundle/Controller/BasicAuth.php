<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\User\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class BasicAuth extends Controller
{
    /**
     * @Route("/basic-auth/get-token", name="basic_logging")
     */
    public function getToken(UserInterface $user)
    {
        return new JsonResponse([ "errorCode" => 0, "apiKey" => $user->getApiKey() ]);
    }
    
    /**
     * @Route("/basic-auth/register", name="registering")
     */
    public function register(Request $request)
    {
        if ($this->get("security.authorization_checker")->isGranted("ROLE_USER")) {
            throw $this->createAccessDeniedException();
        }
        
        $recaptchaKey = $request->request->get("g-recaptcha-key");
        
        if (empty($recaptchaKey)) {
            return JsonResponse(["errorCode" => 3 ], JsonResponse::HTTP_BAD_REQUEST);
        }
        
        
        
        return new JsonResponse([ "errorCode" => 0 ]);
    }
}
