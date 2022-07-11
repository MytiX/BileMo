<?php

namespace App\Security\AuthentificationHandler;

use DateTime;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class AuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{    
    public function __construct(private $jwtKey) {}

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): JsonResponse
    {
        /** @var User $user */
        $user = $token->getUser();

        $datetime = new DateTime();

        $payload = [
            'sub' => $user->getId(),
            'email' => $user->getEmail(),
            'iat' => $datetime->getTimestamp(),
        ];

        $jwt = JWT::encode($payload, $this->jwtKey, 'HS256');

        return new JsonResponse(
            [
                'token' => $jwt,
                'expireAt' => $datetime->getTimestamp() + 3600
            ]
        );   
    }
}
