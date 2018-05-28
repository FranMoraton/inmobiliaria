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
use Symfony\Component\HttpFoundation\Request;

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
     * @param Request $request
     * @return JsonResponse
     * @throws \Assert\AssertionFailedException
     */
    public function __invoke(Request $request)
    {
        $content = json_decode($request->getContent());
        $dni = $content->dni;
        $list = $this->handler->handle(new ListHouseByOwnerCommand($dni));

        return new JsonResponse($list["data"], $list["code"]);
    }
}
