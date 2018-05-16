<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 18:15
 */

namespace App\Infrastructure\Controller\User;


use App\Application\User\UpdateUserByDni\UpdateUserByDni;
use App\Application\User\UpdateUserByDni\UpdateUserByDniCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UpdateUserController
{
    private $handler;

    /**
     * UpdateUserController constructor.
     * @param $handler
     */
    public function __construct(UpdateUserByDni $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \App\Domain\Model\Entity\User\UserNotFound
     * @throws \Assert\AssertionFailedException
     */
    public function __invoke(Request $request)
    {
        $dni = $request->request->get("dni");
        $password = $request->request->get("password");
        $passwordVerify = $request->request->get("passwordVerify");
        $birthDate = $request->request->get("birthDate");

        $userModified = $this->handler->handle(new UpdateUserByDniCommand($dni, $password, $birthDate, $passwordVerify));

        return new JsonResponse($userModified);
    }
}
