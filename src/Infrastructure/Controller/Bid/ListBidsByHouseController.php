<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 28/05/2018
 * Time: 9:42
 */

namespace App\Infrastructure\Controller\Bid;

use App\Application\Bid\ListBidsByHouse\ListBidsByHouse;
use App\Application\Bid\ListBidsByHouse\ListBidsByHouseCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ListBidsByHouseController
{

    private $handler;

    public function __construct(ListBidsByHouse $handler)
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
        $houseId = $content->houseId;

        $list = $this->handler->handle(new ListBidsByHouseCommand($houseId));
        return new JsonResponse($list["data"], $list["code"]);
    }
}
