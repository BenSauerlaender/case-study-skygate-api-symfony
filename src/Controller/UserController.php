<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/register', name: 'user_register', methods: ['GET'])]
    public function register(): JsonResponse
    {

        //validate
        //common
        //role
        //email

        //hash password
        //generate veri-code
        //insert

        //send email

        //return created

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserController.php',
        ]);
    }
}
