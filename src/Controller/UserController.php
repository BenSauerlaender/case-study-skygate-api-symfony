<?php

namespace App\Controller;

use App\Entity\User;
use App\Requests\RegistrationRequest;
use App\Service\CodeGenerator;
use App\Service\EmailWriter;
use App\Service\PasswordHasher;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;

class UserController extends AbstractController
{
    #[Route('/register', name: 'user_register', methods: ['POST'])]
    public function register(RegistrationRequest $request, ManagerRegistry $doctrine, CodeGenerator $codeGen, PasswordHasher $hasher, MailerInterface $mailer, EmailWriter $emailWriter): JsonResponse
    {
        $request->validate($doctrine);
        $user = $request->toUser($doctrine, $hasher, $codeGen->getCode(10));

        $doctrine
            ->getRepository(User::class)
            ->add($user, true);

        $mailer->send($emailWriter->getVerificationEmail($user->getEmail(), $user->getName(), $user->getId(), $user->getVerificationCode()));

        return new JsonResponse(null, Response::HTTP_CREATED);
    }

    #[Route('/users/{id}', name: 'user_getOne', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function getOneUser(int $id, ManagerRegistry $doctrine): JsonResponse
    {
        $user = $doctrine
            ->getRepository(User::class)
            ->findOneBy(['id' => $id]);

        if (is_null($user)) return new JsonResponse(['msg' => 'User not found', 'errorCode' => 201], Response::HTTP_BAD_REQUEST);
        else return new JsonResponse($user->getPublicArray());
    }
}
