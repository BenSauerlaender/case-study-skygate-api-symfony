<?php

namespace App\Requests;

use App\Entity\Role;
use App\Helper\ValidationHelper;
use Symfony\Component\Validator\Constraints as Assert;

class ChangeRoleRequest extends BaseRequest
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    public ?string $role = null;
}
