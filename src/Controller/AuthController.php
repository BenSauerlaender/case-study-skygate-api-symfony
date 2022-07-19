<?php

namespace App\Controller;

use App\Entity\User;
use App\Requests\LoginRequest;
use App\Service\PasswordHasher;
use Doctrine\Persistence\ManagerRegistry;
use ReallySimpleJWT\Token;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{

    #[Route('/login', name: 'auth_login', methods: ['POST'])]
    public function loginUser(ManagerRegistry $doctrine, LoginRequest $request, PasswordHasher $hasher,): JsonResponse
    {
        $error = $request->validate($doctrine);
        if ($error) return $error;

        $entityManager = $doctrine->getManager();

        /** @var User */
        $user = $entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => strtolower($request->email)]);

        if (!$user) return new JsonResponse(['msg' => 'User not found', 'code' => 201], Response::HTTP_BAD_REQUEST);

        if (!$hasher->getHasher()->verify($user->getHashedPass(), $request->password)) {
            return new JsonResponse(['msg' => 'Password is incorrect', 'code' => 215], Response::HTTP_BAD_REQUEST);
        }

        $user->increaseRefreshTokenCount();
        $entityManager->flush();

        $payload = [
            'exp' => time() + 60 * 60 * 24 * 30, //valid for 30days
            'id'  => $user->getId(),
            'cnt' => $user->getRefreshTokenCount()
        ];

        //create and return the JWT 
        $token = Token::customPayload($payload, $_ENV["REFRESH_TOKEN_SECRET"]);

        $response = new JsonResponse(null, Response::HTTP_OK);
        $response->headers->setCookie(new Cookie("skygatecasestudy.refreshtoken.v2", $token, time() + 60 * 60 * 24 * 30, '/api/v2/', 'localhost', false, true, false, 'None'));
        return $response;
    }

    #[Route('/token', name: 'auth_getToken', methods: ['GET'])]
    public function getAccessToken(ManagerRegistry $doctrine, PasswordHasher $hasher, Request $request): JsonResponse
    {
        $invalidToken = new JsonResponse(['msg' => 'The refreshToken is invalid.', 'code' => 302], Response::HTTP_BAD_REQUEST);
        $refreshToken = $request->cookies->get("skygatecasestudy_refreshtoken_v2");


        if (!$refreshToken) return $invalidToken;
        if (!Token::validate($refreshToken, $_ENV["REFRESH_TOKEN_SECRET"])) return $invalidToken;
        if (!Token::validateExpiration($refreshToken)) return $invalidToken;

        $payload = Token::getPayLoad($refreshToken);

        $entityManager = $doctrine->getManager();

        /** @var User */
        $user = $entityManager
            ->getRepository(User::class)
            ->findOneBy(['id' => $payload['id']]);

        if (!$user) return new JsonResponse(['msg' => 'User not found', 'code' => 201], Response::HTTP_BAD_REQUEST);

        if ($payload['cnt'] != $user->getRefreshTokenCount()) {
            return $invalidToken;
        }

        $payload = [
            'exp' => time() + 60 * 15, //valid for 15 mins
            'id'  => $user->getId(),
            'perm' => $user->getRole()->getPermissions()
        ];

        //create and return the JWT 
        $token = Token::customPayload($payload, $_ENV["ACCESS_TOKEN_SECRET"]);

        return new JsonResponse(['accessToken' => $token], Response::HTTP_OK);
    }
}
