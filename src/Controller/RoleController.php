<?php

namespace App\Controller;

use App\Entity\Role;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/roles', name: 'roles_')]
class RoleController extends AbstractController
{

    #[Route('', name: 'all', methods: ['GET'])]
    public function all(ManagerRegistry $doctrine): JsonResponse
    {
        $roles = $doctrine
            ->getRepository(Role::class)
            ->findAll();

        $data = [];

        foreach ($roles as $role) {
            $data[] = $role->getName();
        }
        return $this->json($data);
    }
}
