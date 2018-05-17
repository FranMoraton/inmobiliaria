<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 20:58
 */

namespace App\Infrastructure\Controller\Bid;

use App\Application\Bid\ListBidsByOwner\ListBidsByOwner;
use App\Application\Bid\ListBidsByOwner\ListBidsByOwnerCommand;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListBidsByOwnerController
{
    private $handler;

    public function __construct(ListBidsByOwner $handler)
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
        $list = $this->handler->handle(new ListBidsByOwnerCommand($dni));
        return new JsonResponse($list["data"], $list["code"]);
    }
}
