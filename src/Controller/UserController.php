<?php

namespace App\Controller;

use App\Entity\EmailChangeRequest;
use App\Entity\Role;
use App\Entity\User;
use App\Exceptions\ValidationError;
use App\Repository\EmailChangeRequestRepository;
use App\Service\CodeGenerator;
use App\Service\PasswordHasher;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class UserController extends AbstractController
{
    #[Route('/register', name: 'user_register', methods: ['POST'])]
    public function register(ManagerRegistry $doctrine, Request $request, CodeGenerator $codeGen, PasswordHasher $hasher, ValidatorInterface $validator, MailerInterface $mailer): JsonResponse
    {
        $email = $request->request->get('email');
        $name = $request->request->get('name');
        $postcode = $request->request->get('postcode');
        $city = $request->request->get('city');
        $phone = $request->request->get('phone');
        $password = $request->request->get('password');

        $errors = new ConstraintViolationList();

        $isEmailFree = $this->isEmailFree($email, $doctrine->getRepository(User::class), $doctrine->getRepository(EmailChangeRequest::class));

        if (!$isEmailFree) {
            $errors->add(new ConstraintViolation('Email is taken', 'Email is taken', [], null, 'email', $email));
            $email = 'email@mail.de';
        }

        $passwordViolations = $this->validatePassword($password, $validator);

        if (count($passwordViolations) > 0) {
            $errors->addAll($passwordViolations);
            $password = null;
        } else {
            $password = $hasher->getHasher()->hash($password);
        }

        $role = $doctrine
            ->getRepository(Role::class)
            ->findOneBy(['name' => 'user']);

        $user = User::create(
            $email,
            $name,
            $postcode,
            $city,
            $phone,
            $password,
            $role,
            $codeGen->getCode(10),
        );

        $errors->addAll($validator->validate($user));

        if (count($errors) > 0) {
            throw new ValidationError($errors);
        }

        $doctrine
            ->getRepository(User::class)
            ->add($user, true);

        $email = (new Email())
            ->from('hello@example.com')
            ->to()
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);

        return new JsonResponse(null, Response::HTTP_CREATED);
    }

    private function isEmailFree(string $email, ObjectRepository $UserRep, ObjectRepository $EmailChangeRequestRep): boolean
    {
        return
            is_null(
                $UserRep->findOneBy(['email' => $email])
            )
            && is_null(
                $EmailChangeRequestRep->findOneBy(['email' => $email])
            );
    }

    private function validatePassword(string $password, ValidatorInterface $validator)
    {
        $passwordConstraints = new Assert\Collection(['password' => [
            new Assert\NotBlank,
            new Assert\Length(['min' => 8, 'max' => 50]),
            new Assert\Regex("/^[a-zA-ZÄÖÜäöüß0-9#?!@$%^&.*\-+]*$/"),
            new Assert\Regex("/[a-zäöüß]+/"),
            new Assert\Regex("/[A-ZÄÖÜ}]+/"),
            new Assert\Regex("/[0-9]+/"),
        ]]);

        return $validator->validate(['password' => $password, $passwordConstraints]);
    }
}
