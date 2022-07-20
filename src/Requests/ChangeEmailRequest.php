<?php

namespace App\Requests;

use App\Entity\EmailChangeRequest;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolation;

class ChangeEmailRequest extends BaseRequest
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Email]
    public ?string $email = null;

    public function validate(?ManagerRegistry $doctrine = null): ?JsonResponse
    {
        if (!is_null($this->email)) {
            $isEmailFree = $this->isEmailFree($this->email, $doctrine->getRepository(User::class), $doctrine->getRepository(EmailChangeRequest::class));

            if (!$isEmailFree) {
                $this->errors->add(new ConstraintViolation('Email is taken', 'Email is taken', [], null, 'email', $this->email));
                $this->email = 'email@mail.de';
            }
        }

        return parent::validate();
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
}
