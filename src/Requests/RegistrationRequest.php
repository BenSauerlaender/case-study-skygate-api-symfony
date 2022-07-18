<?php

namespace App\Requests;

use App\Entity\EmailChangeRequest;
use App\Entity\Role;
use App\Entity\User;
use App\Helper\ValidationHelper;
use App\Service\PasswordHasher;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolation;

class RegistrationRequest extends BaseRequest
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Email]
    protected ?string $email = null;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Regex(ValidationHelper::WORDS_REGEX)]
    protected ?string $name = null;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Length(min: 5, max: 5)]
    #[Assert\Regex(ValidationHelper::NUMBER_REGEX)]
    protected ?string $postcode = null;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Regex(ValidationHelper::WORDS_REGEX)]
    protected ?string $city = null;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Length(
        min: 8,
        max: 15,
        normalizer: "App\Helper\ValidationHelper::onlyNumbers",
    )]
    #[Assert\Regex(ValidationHelper::PHONE_NUMBER_REGEX)]
    protected ?string $phone = null;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Length(min: 8, max: 50)]
    #[Assert\Regex("/^[a-zA-ZÄÖÜäöüß0-9#?!@$%^&.*\-+]*$/")]
    #[Assert\Regex("/[a-zäöüß]+/")]
    #[Assert\Regex("/[A-ZÄÖÜ}]+/")]
    #[Assert\Regex("/[0-9]+/")]
    protected ?string $password = null;


    public function validate(?ManagerRegistry $doctrine = null)
    {
        if (!is_null($this->email)) {
            $isEmailFree = $this->isEmailFree($this->email, $doctrine->getRepository(User::class), $doctrine->getRepository(EmailChangeRequest::class));

            if (!$isEmailFree) {
                $this->errors->add(new ConstraintViolation('Email is taken', 'Email is taken', [], null, 'email', $this->email));
                $this->email = 'email@mail.de';
            }
        }

        parent::validate();
    }

    private function isEmailFree(string $email, ObjectRepository $UserRep, ObjectRepository $EmailChangeRequestRep): bool
    {
        return
            is_null(
                $UserRep->findOneBy(['email' => $email])
            )
            && is_null(
                $EmailChangeRequestRep->findOneBy(['email' => $email])
            );
    }

    public function toUser(ManagerRegistry $doctrine, PasswordHasher $hasher, string $code): User
    {

        $role = $doctrine
            ->getRepository(Role::class)
            ->findOneBy(['name' => 'user']);

        $password = $hasher->getHasher()->hash($this->password);

        return User::create(
            $this->email,
            $this->name,
            $this->postcode,
            $this->city,
            $this->phone,
            $password,
            $role,
            $code,
        );
    }
}
