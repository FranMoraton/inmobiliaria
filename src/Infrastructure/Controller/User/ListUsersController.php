<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 17:19
 */

namespace App\Infrastructure\Controller\User;

use App\Application\User\ListAllUsers\ListAllUsers;
use App\Application\User\ListAllUsers\ListallUsersCommand;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListUsersController
{
    private $handler;

    /**
     * ListUsersController constructor.
     * @param $handler
     */
    public function __construct(ListAllUsers $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke()
    {
        $list = $this->handler->handle(new ListallUsersCommand());
        return new JsonResponse($list["data"], $list["code"]);
    }
}
