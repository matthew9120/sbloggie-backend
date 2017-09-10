<?php

namespace AppBundle\Security;

use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Guard\GuardAuthenticatorInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiKeyAuthenticator extends AbstractGuardAuthenticator implements GuardAuthenticatorInterface
{
    const API_KEY_HEADER = "X-AUTH-TOKEN";
    
    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new JsonResponse([ "errorCode" => 1 ], JsonResponse::HTTP_UNAUTHORIZED);
    }
    
    public function getCredentials(Request $request)
    {
        return $request->headers->get(self::API_KEY_HEADER);
    }
    
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        if ($credentials === null) {
            return;
        }
        
        return $userProvider->loadUserByUsername($credentials);
    }
    
    public function checkCredentials($credentials, UserInterface $user)
    {
        return $user->getApiKey() === $credentials;
    }
    
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new JsonResponse([ "errorCode" => 2 ], Response::HTTP_UNAUTHORIZED);
    }
    
      public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }
    
    public function supportsRememberMe()
    {
        return false;
    }
}
