<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 15/05/2018
 * Time: 19:18
 */

namespace App\Infrastructure\Controller\User;

use App\Application\User\ListUserByDni\ListUserByDni;
use App\Application\User\ListUserByDni\ListUserByDniCommand;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListUserByDniController
{
    private $handler;


    /**
     * ListUserByDniController constructor.
     * @param ListUserByDni $handler
     */
    public function __construct(ListUserByDni $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @param string $dni
     * @return JsonResponse
     * @throws \App\Domain\Model\Entity\User\UserNotFound
     * @throws \Assert\AssertionFailedException
     */
    public function __invoke(string $dni)
    {
        $list = $this->handler->handle(new ListUserByDniCommand($dni));
        return new JsonResponse($list);
    }
}
