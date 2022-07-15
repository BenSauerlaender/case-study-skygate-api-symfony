<?php

namespace App\Controller;

//from https://stackoverflow.com/questions/63504225/catch-exception-at-root

use App\Exceptions\ExpiredLinkException;
use App\Exceptions\ValidationError;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Throwable;

/**
 * Controller for exceptions
 */
class ErrorController extends AbstractController
{

    /**
     * @param Request $request
     * @param Throwable $exception
     * @return Mixed
     * @throws Throwable
     */
    public function handle(Request $request, Throwable $exception)
    {
        if ($exception instanceof ValidationError) {
            $errors = $exception->getErrors();
            $jsonErrors = [];

            for ($i = 0; $i < count($errors); $i++) {
                $error = $errors->get($i);

                $jsonErrors[$error->getPropertyPath()] = ['code' => $error->getCode(), 'msg' => $error->getMessageTemplate()];
            }

            return new JsonResponse(['errorCode' => 101, 'validationErrors' => $jsonErrors], Response::HTTP_BAD_REQUEST);
        }
        throw $exception;
    }
}
