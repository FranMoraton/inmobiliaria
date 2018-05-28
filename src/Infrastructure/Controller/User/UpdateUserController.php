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
     * @throws \Assert\AssertionFailedException
     */
    public function __invoke(Request $request)
    {
        $content = json_decode($request->getContent());
        $dni = $content->dni;
        $password = $content->password;
        $birthDate = $content->birthDate;
        $passwordVerify = $content->passwordVerify;



        $userModified = $this->handler
            ->handle(new UpdateUserByDniCommand($dni, $password, $birthDate, $passwordVerify));

        return new JsonResponse($userModified["data"], $userModified["code"]);
    }
}
