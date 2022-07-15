<?php

namespace App\Controller;

use App\Entity\EmailChangeRequest;
use App\Entity\Role;
use App\Entity\User;
use App\Exceptions\ValidationError;
use App\Service\CodeGenerator;
use App\Service\PasswordHasher;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends AbstractController
{
    #[Route('/register', name: 'user_register', methods: ['POST'])]
    public function register(ManagerRegistry $doctrine, Request $request, CodeGenerator $codeGen, PasswordHasher $hasher, ValidatorInterface $validator): JsonResponse
    {
        $errors = new ConstraintViolationList();

        $email = $request->request->get('email');

        $emailIsFree =
            is_null($doctrine
                ->getRepository(User::class)
                ->findOneBy(['email' => $email]))
            && is_null($doctrine
                ->getRepository(EmailChangeRequest::class)
                ->findOneBy(['email' => $email]));

        if (!$emailIsFree) {
            $errors->add(new ConstraintViolation('Email is taken', 'Email is taken', [], null, 'email', $email));
            $email = 'email@mail.de';
        }

        $passwordConstraints = new Assert\Collection(['password' => [
            new Assert\NotBlank,
            new Assert\Length(['min' => 8, 'max' => 50]),
            new Assert\Regex("/^[a-zA-ZÄÖÜäöüß0-9#?!@$%^&.*\-+]*$/"),
            new Assert\Regex("/[a-zäöüß]+/"),
            new Assert\Regex("/[A-ZÄÖÜ}]+/"),
            new Assert\Regex("/[0-9]+/"),
        ]]);

        $passwordViolations = $validator->validate(['password' => $request->request->get('password')], $passwordConstraints);

        if (count($passwordViolations) > 0) {
            $errors->addAll($passwordViolations);
            $password = null;
        } else {
            $password = $hasher->getHasher()->hash($request->request->get('password'));
        }

        $role = $doctrine
            ->getRepository(Role::class)
            ->findOneBy(['name' => 'user']);

        $user = User::create(
            $email,
            $request->request->get('name'),
            $request->request->get('postcode'),
            $request->request->get('city'),
            $request->request->get('phone'),
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




        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
