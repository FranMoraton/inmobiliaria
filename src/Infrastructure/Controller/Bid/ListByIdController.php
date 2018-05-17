<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 20:57
 */

namespace App\Infrastructure\Controller\Bid;

use App\Application\Bid\ListBidById\ListBidById;
use App\Application\Bid\ListBidById\ListBidByIdCommand;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListByIdController
{
    private $handler;

    public function __construct(ListBidById $handler)
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
        $list = $this->handler->handle(new ListBidByIdCommand($id));
        return new JsonResponse($list["data"], $list["code"]);
    }
}
