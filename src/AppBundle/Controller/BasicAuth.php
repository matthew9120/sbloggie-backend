<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\User\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class BasicAuth extends Controller
{
    const recaptchaSecretKey = "6LchJTAUAAAAABJ-Aq2OY4wugr8cktywk4eRhtYr";
    
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
            throw $this->createAccessDeniedException(\json_encode([ "errorCode" => 4 ]));
        }
        
        $recaptchaKey = $request->request->get("g-recaptcha-key");
        
        if (empty($recaptchaKey)) {
            throw $this->createAccessDeniedException(\json_encode([ "errorCode" => 3 ]));
        }
        
        $recaptchaParams = [ "response" => $recaptchaKey, "secret" => self::recaptchaSecretKey ];
        
        $recaptchaJson = $this->get("http")->makeRequestUsingPost("https://www.google.com/recaptcha/api/siteverify", $recaptchaParams);
        //something doesn't work
        
//        if (!empty($recaptchaJson)) {
//            $recaptchaResponse = json_decode($recaptchaJson);
//            
//            if (!$recaptchaResponse["success"]) {
//                throw $this->createAccessDeniedException(\json_encode([ "errorCode" => 3 ]));
//            }
//        } else {
//            throw new \Exception(\json_encode([ "errorCode" => "Google's reCAPTCHA site is not responding" ]));
//        }
        
        
        
        return new JsonResponse([ "errorCode" => 0 ]);
    }
}
