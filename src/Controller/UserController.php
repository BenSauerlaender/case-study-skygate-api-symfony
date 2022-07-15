<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use App\Service\CodeGenerator;
use App\Service\PasswordHasher;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends AbstractController
{
    #[Route('/register', name: 'user_register', methods: ['POST'])]
    public function register(ManagerRegistry $doctrine, Request $request, CodeGenerator $codeGen, PasswordHasher $hasher, ValidatorInterface $validator): JsonResponse
    {

        //validate
        //common
        //role
        //email

        $role = $doctrine
            ->getRepository(Role::class)
            ->findOneBy(['name' => 'user']);

        $password = $hasher->getHasher()->hash($request->request->get('password'));

        $user = User::create(
            $request->request->get('email'),
            $request->request->get('name'),
            $request->request->get('postcode'),
            $request->request->get('city'),
            $request->request->get('phone'),
            $password,
            $role,
            $codeGen->getCode(10),
        );

        $errors = $validator->validate($user);

        if (count($errors) > 0) {
            /*
             * Uses a __toString method on the $errors variable which is a
             * ConstraintViolationList object. This gives us a nice string
             * for debugging.
             */
            $errorsString = (string) $errors;

            return new JsonResponse($errorsString);
        }

        $doctrine
            ->getRepository(User::class)
            ->add($user, true);


        //send email

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
