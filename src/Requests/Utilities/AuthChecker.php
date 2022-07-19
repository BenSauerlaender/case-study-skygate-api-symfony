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
        $acceptingPermissions[] = [$permission, $for_user_id];
        return $this;
    }

    public function check(ObjectRepository $userRep)
    {
        $unauthorized = new JsonResponse('The Request cant be authorized.', Response::HTTP_UNAUTHORIZED);

        $token = $this->token;

        //check if the string is a valid JWT
        if (!Token::validate($token ?? '', $_ENV["ACCESS_TOKEN_SECRET"])) {
            $unauthorized->send();
            exit;
        }

        //check if the JWT is not expired
        if (!Token::validateExpiration($token)) {
            $unauthorized->send();
            exit;
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
            return;
        }

        //user has no accepted permission
        $response = new JsonResponse("The Route requires permissions you don't have.", Response::HTTP_FORBIDDEN);
        $response->send();
        exit;
    }
}
