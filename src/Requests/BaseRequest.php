<?php

namespace App\Requests;

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

    public function __construct(protected ValidatorInterface $validator)
    {
        $this->errors = new ConstraintViolationList();
        $this->populate();
    }

    public function validate()
    {
        $this->errors->addAll($this->validator->validate($this));

        $messages = ['errorCode' => 101, 'validationErrors' => []];

        /** @var \Symfony\Component\Validator\ConstraintViolation  */
        foreach ($this->errors as $message) {
            $messages['validationErrors'][$message->getPropertyPath()] = [
                'code' => $message->getCode(),
                'msg' => $message->getMessageTemplate(),
            ];
        }

        if (count($messages['validationErrors']) > 0) {
            $response = new JsonResponse($messages, Response::HTTP_BAD_REQUEST);
            $response->send();

            exit;
        }
    }

    public function getRequest(): Request
    {
        return Request::createFromGlobals();
    }

    protected function populate(): void
    {
        foreach ($this->getRequest()->request->all() as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }
}
