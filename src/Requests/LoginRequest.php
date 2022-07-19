<?php

namespace App\Requests;

use Symfony\Component\Validator\Constraints as Assert;

class LoginRequest extends BaseRequest
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    public ?string $email = null;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    public ?string $password = null;
}
