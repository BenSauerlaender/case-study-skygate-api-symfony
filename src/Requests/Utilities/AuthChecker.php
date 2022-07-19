<?php

namespace App\Requests\Utilities;

use Doctrine\Persistence\ObjectRepository;
use ReallySimpleJWT\Token;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthChecker
{
    private ?string $token;

    private array $acceptingPermissions = [];

    public function __construct(?string $token)
    {
        $this->token = explode(" ", $token)[1] ?? null;
    }

    public function accept(string $permission, ?int $for_user_id = null): Self
    {
        $this->acceptingPermissions[] = [$permission, $for_user_id];
        return $this;
    }

    public function check(ObjectRepository $userRep): ?JsonResponse
    {
        $unauthorized = new JsonResponse(['msg' => 'The Request cant be authorized.'], Response::HTTP_UNAUTHORIZED);

        $token = $this->token;

        //check if the string is a valid JWT
        if (!Token::validate($token ?? '', $_ENV["ACCESS_TOKEN_SECRET"])) {
            return $unauthorized;
        }

        //check if the JWT is not expired
        if (!Token::validateExpiration($token)) {
            return $unauthorized;
        }

        //get the payload 
        $payload = Token::getPayLoad($token);

        $permissions = explode(" ", $payload["perm"]);
        $id =  $payload["id"];

        foreach ($this->acceptingPermissions as [$required_perm, $required_id]) {
            if (($required_id != null) and ($required_id != $id)) {
                continue;
            }
            if (!in_array($required_perm, $permissions)) {
                continue;
            }
            //user has required permission
            return null;
        }

        //user has no accepted permission
        return new JsonResponse(['msg' => "The Route requires permissions you dont have."], Response::HTTP_FORBIDDEN);
    }
}
