<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use App\Requests\BaseRequest;
use App\Requests\ChangeRoleRequest;
use App\Requests\RegistrationRequest;
use App\Requests\UserPutRequest;
use App\Requests\VerificationRequest;
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
        $error = $request->validate($doctrine);
        if ($error) return $error;

        $user = $request->toUser($doctrine, $hasher, $codeGen->getCode(10));

        $doctrine
            ->getRepository(User::class)
            ->add($user, true);

        $mailer->send($emailWriter->getVerificationEmail($user->getEmail(), $user->getName(), $user->getId(), $user->getVerificationCode()));

        return new JsonResponse(null, Response::HTTP_CREATED);
    }

    #[Route('/users/{id}/verify', name: 'user_verify', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function verifyUser(int $id, ManagerRegistry $doctrine, VerificationRequest $request): JsonResponse
    {
        $error = $request->validate($doctrine);
        if ($error) return $error;

        $entityManager = $doctrine->getManager();

        /** @var User */
        $user = $entityManager
            ->getRepository(User::class)
            ->findOneBy(['id' => $id]);

        if (is_null($user)) return new JsonResponse(['msg' => 'User not found', 'errorCode' => 201], Response::HTTP_BAD_REQUEST);

        if ($user->isVerified()) return new JsonResponse(['msg' => 'User is already verified', 'errorCode' => 210], Response::HTTP_BAD_REQUEST);

        $verified = $user->verify($request->code);

        if (!$verified) return new JsonResponse(['msg' => 'The verification code is invalid', 'errorCode' => 211], Response::HTTP_BAD_REQUEST);

        $entityManager->flush();

        return new JsonResponse(null, Response::HTTP_OK);
    }

    #[Route('/users/{id}', name: 'user_getOne', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function getOneUser(int $id, ManagerRegistry $doctrine, BaseRequest $request): JsonResponse
    {
        $userRep = $doctrine->getRepository(User::class);

        $error = $request->requireAuth()
            ->accept('getAllUsers')
            ->accept('getSelf', $id)
            ->check($userRep);
        if ($error) return $error;

        $user = $userRep
            ->findOneBy(['id' => $id]);

        if (is_null($user)) return new JsonResponse(['msg' => 'User not found', 'errorCode' => 201], Response::HTTP_BAD_REQUEST);
        else return new JsonResponse($user->getPublicArray());
    }

    #[Route('/users/{id}', name: 'user_updateOne', methods: ['PUT'], requirements: ['id' => '\d+'])]
    public function updateOneUser(int $id, ManagerRegistry $doctrine, UserPutRequest $request): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        $userRep = $entityManager->getRepository(User::class);

        $error = $request->requireAuth()
            ->accept('changeAllUsersContactData')
            ->accept('changeOwnContactData', $id)
            ->check($userRep);
        if ($error) return $error;

        $error = $request->validate($doctrine);
        if ($error) return $error;

        /** @var User */
        $user = $userRep
            ->findOneBy(['id' => $id]);
        if (is_null($user)) return new JsonResponse(['msg' => 'User not found', 'errorCode' => 201], Response::HTTP_BAD_REQUEST);


        foreach (['name', 'city', 'postcode', 'phone'] as $property) {
            if (!is_null($request->{$property})) {
                $user->set($property, $request->{$property});
            }
        }

        $entityManager->flush();

        return new JsonResponse(null, Response::HTTP_OK);
    }

    #[Route('/users/{id}', name: 'user_deleteOne', methods: ['DELETE'], requirements: ['id' => '\d+'])]
    public function deleteOneUser(int $id, ManagerRegistry $doctrine, BaseRequest $request): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        $userRep = $entityManager->getRepository(User::class);

        $error = $request->requireAuth()
            ->accept('deleteSelf')
            ->accept('deleteSelf', $id)
            ->check($userRep);
        if ($error) return $error;

        /** @var User */
        $user = $userRep
            ->findOneBy(['id' => $id]);
        if (is_null($user)) return new JsonResponse(['msg' => 'User not found', 'errorCode' => 201], Response::HTTP_BAD_REQUEST);

        $userRep->remove($user, true);

        return new JsonResponse(null, Response::HTTP_OK);
    }

    #[Route('/users/{id}/role', name: 'user_changeRole', methods: ['PUT'], requirements: ['id' => '\d+'])]
    public function changeUsersRole(int $id, ManagerRegistry $doctrine, ChangeRoleRequest $request): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        $userRep = $entityManager->getRepository(User::class);

        $error = $request->requireAuth()
            ->accept('changeAllUsersRoles')
            ->check($userRep);
        if ($error) return $error;

        $error = $request->validate($doctrine);
        if ($error) return $error;

        $role = $entityManager->getRepository(Role::class)->findOneBy(['name' => $request->role]);
        if (is_null($role)) {
            return new JsonResponse(['errorCode' => 102, 'invalidProperties' => ['role' => ['msg' => 'Role cant be found.', 'errorCode' => null]]], Response::HTTP_BAD_REQUEST);
        }

        /** @var User */
        $user = $userRep
            ->findOneBy(['id' => $id]);
        if (is_null($user)) return new JsonResponse(['msg' => 'User not found', 'errorCode' => 201], Response::HTTP_BAD_REQUEST);

        $user->setRole($role);
        $entityManager->flush();

        return new JsonResponse(null, Response::HTTP_OK);
    }
}
