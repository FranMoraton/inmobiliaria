<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 20:38
 */

namespace App\Infrastructure\Controller\User;

use App\Application\User\LogInUser\LogInUser;
use App\Application\User\LogInUser\LogInUserCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class LogInUserController
{
    private $handler;

    /**
     * LogInUserController constructor.
     * @param LogInUser $handler
     */
    public function __construct(LogInUser $handler)
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

        $list = $this->handler->handle(new LogInUserCommand($dni, $password));

        return new JsonResponse($list["data"], $list["code"]);
    }
}
