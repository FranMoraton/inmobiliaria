<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 21:05
 */

namespace App\Infrastructure\Controller\Bid;

use App\Application\Bid\CreateBid\CreateBid;
use App\Application\Bid\CreateBid\CreateBidCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreateBidController
{
    private $handler;

    public function __construct(CreateBid $handler)
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

        $bid = $this->handler->handle(new CreateBidCommand($dni, $house, $money));

        return new JsonResponse($bid["data"], $bid["code"]);
    }
}
