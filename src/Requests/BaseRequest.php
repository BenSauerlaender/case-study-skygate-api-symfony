<?php

namespace App\Requests;

use App\Requests\Utilities\AuthChecker;
use Symfony\Component\HttpFoundation\Exception\JsonException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BaseRequest
{
    protected ConstraintViolationListInterface $errors;
    protected Request $request;

    public function __construct(protected ValidatorInterface $validator)
    {
        $this->errors = new ConstraintViolationList();
        $this->request = Request::createFromGlobals();
        $this->populate();
    }

    public function requireAuth(): AuthChecker
    {
        return new AuthChecker($this->request->headers->get('Authorization'));
    }

    public function validate(): ?JsonResponse
    {
        $this->errors->addAll($this->validator->validate($this));

        $messages = ['errorCode' => 102, 'invalidProperties' => []];

        /** @var \Symfony\Component\Validator\ConstraintViolation  */
        foreach ($this->errors as $message) {
            $messages['invalidProperties'][$message->getPropertyPath()] = [
                'errorCode' => $message->getCode(),
                'msg' => $message->getMessageTemplate(),
            ];
        }

        if (count($messages['invalidProperties']) > 0) {
            return new JsonResponse($messages, Response::HTTP_BAD_REQUEST);
        }
        return null;
    }

    protected function populate(): void
    {
        foreach (json_decode($this->request->getContent()) ?? [] as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }
}
