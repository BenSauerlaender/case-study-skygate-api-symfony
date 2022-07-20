<?php

namespace App\Requests;

use Symfony\Component\Validator\Constraints as Assert;

class ChangePasswordRequest extends BaseRequest
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Length(min: 8, max: 50)]
    #[Assert\Regex("/^[a-zA-ZÄÖÜäöüß0-9#?!@$%^&.*\-+]*$/")]
    #[Assert\Regex("/[a-zäöüß]+/")]
    #[Assert\Regex("/[A-ZÄÖÜ}]+/")]
    #[Assert\Regex("/[0-9]+/")]
    public ?string $newPassword = null;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    public ?string $oldPassword = null;
}
