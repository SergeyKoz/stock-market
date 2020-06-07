<?php

namespace App\EventListener;

use App\Exception\FormErrorException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        $code = $exception instanceof HttpException ? $exception->getStatusCode() : 500;
        $message = $exception->getMessage();

        $responseData = [
            'error' => [
                'code' => $code,
                'message' => $message
            ]
        ];

        if ($exception instanceof  FormErrorException )
        {
            $responseData['error']['fields'] = $exception->getErrorFields();
        }

        $event->setResponse(new JsonResponse($responseData, $code));
    }
}
