<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 18/05/2018
 * Time: 11:37
 */

namespace App\Infrastructure\Controller\Bid;

use App\Application\Bid\ModifyBid\ModifyBid;
use App\Application\Bid\ModifyBid\ModifyBidCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ModifyBidController
{

    private $handler;

    public function __construct(ModifyBid $handler)
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
        $house = $content->house;
        $money = $content->money;

        $bid = $this->handler->handle(new ModifyBidCommand($dni, $house, $money));

        return new JsonResponse($bid["data"], $bid["code"]);
    }
}
