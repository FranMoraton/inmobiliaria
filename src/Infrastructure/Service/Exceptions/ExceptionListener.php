<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 24/05/2018
 * Time: 10:40
 */

namespace App\Infrastructure\Service\Exceptions;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ExceptionListener
{

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        $jsonResponse = new JsonResponse(
            $exception->getMessage(),
            $exception->getCode()
        );
        $event->setResponse($jsonResponse);
    }
}
