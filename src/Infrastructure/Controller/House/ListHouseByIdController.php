<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 15:57
 */

namespace App\Infrastructure\Controller\House;

use App\Application\House\ListHouseById\ListHouseById;
use App\Application\House\ListHouseById\ListHouseByIdCommand;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListHouseByIdController
{
    private $handler;

    /**
     * ListHouseByIdController constructor.
     * @param $handler
     */
    public function __construct(ListHouseById $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws \Assert\AssertionFailedException
     */
    public function __invoke($id)
    {
        $list = $this->handler->handle(new ListHouseByIdCommand($id));

        return new JsonResponse($list["data"], $list["code"]);
    }
}
