<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 17:39
 */

namespace App\Infrastructure\Controller\House;

use App\Application\House\ListHouseBiddedByUser\ListHouseBiddedByUser;
use App\Application\House\ListHouseBiddedByUser\ListHouseBiddedByUserCommand;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ListHouseBiddedByUserController
{
    private $handler;

    /**
     * ListHouseByIdController constructor.
     * @param $handler
     */
    public function __construct(ListHouseBiddedByUser $handler)
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
        $list = $this->handler->handle(new ListHouseBiddedByUserCommand($dni));

        return new JsonResponse($list["data"], $list["code"]);
    }
}
