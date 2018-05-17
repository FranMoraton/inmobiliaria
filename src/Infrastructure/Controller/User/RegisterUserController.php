<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 21:51
 */

namespace App\Infrastructure\Controller\User;

use App\Application\User\RegisterUser\RegisterUser;
use App\Application\User\RegisterUser\RegisterUserCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class RegisterUserController
{
    private $handler;

    public function __construct(RegisterUser $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Assert\AssertionFailedException
     */
    public function __invoke(Request $request)
    {
        $dni = $request->request->get("dni");
        $password = $request->request->get("password");
        $birthDate = $request->request->get("birthDate");

        $list = $this->handler->handle(new RegisterUserCommand($dni, $password, $birthDate));

        return new JsonResponse($list["data"], $list["code"]);
    }
}
