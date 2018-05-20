<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 20/05/2018
 * Time: 16:34
 */

namespace App\Infrastructure\Controller\House;

use App\Application\House\ListHouseByOwner\ListHouseByOwner;
use App\Application\House\ListHouseByOwner\ListHouseByOwnerCommand;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListHouseByOwnerController
{

    private $handler;

    /**
     * ListHouseByIdController constructor.
     * @param $handler
     */
    public function __construct(ListHouseByOwner $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @param $dni
     * @return JsonResponse
     * @throws \Assert\AssertionFailedException
     */
    public function __invoke($dni)
    {
        $list = $this->handler->handle(new ListHouseByOwnerCommand($dni));

        return new JsonResponse($list["data"], $list["code"]);
    }
}
