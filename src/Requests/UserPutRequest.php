<?php

namespace App\Requests;

use App\Helper\ValidationHelper;
use Symfony\Component\Validator\Constraints as Assert;

class UserPutRequest extends BaseRequest
{
    #[Assert\Type('string')]
    #[Assert\Regex(ValidationHelper::WORDS_REGEX)]
    public ?string $name = null;

    #[Assert\Type('string')]
    #[Assert\Length(min: 5, max: 5)]
    #[Assert\Regex(ValidationHelper::NUMBER_REGEX)]
    public ?string $postcode = null;

    #[Assert\Type('string')]
    #[Assert\Regex(ValidationHelper::WORDS_REGEX)]
    public ?string $city = null;

    #[Assert\Type('string')]
    #[Assert\Length(
        min: 8,
        max: 15,
        normalizer: "App\Helper\ValidationHelper::onlyNumbers",
    )]
    #[Assert\Regex(ValidationHelper::PHONE_NUMBER_REGEX)]
    public ?string $phone = null;
}
