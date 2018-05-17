<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 20:58
 */

namespace App\Infrastructure\Controller\Bid;

use App\Application\Bid\ListBids\ListBids;
use App\Application\Bid\ListBids\ListBidsCommand;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListBidsController
{
    private $handler;

    public function __construct(ListBids $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke()
    {
        $bids = $this->handler->handle(new ListBidsCommand());
        return new JsonResponse($bids["data"], $bids["code"]);
    }
}
