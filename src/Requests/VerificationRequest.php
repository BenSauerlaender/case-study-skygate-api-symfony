<?php

namespace App\Requests;

use Symfony\Component\Validator\Constraints as Assert;

class VerificationRequest extends BaseRequest
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    public ?string $code = null;
}
