<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 20:56
 */

namespace App\Infrastructure\Controller\Bid;


use App\Application\Bid\AcceptBid\AcceptBid;
use App\Application\Bid\AcceptBid\AcceptBidCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AcceptBidController
{
    private $handler;

    /**
     * RejectBidController constructor.
     * @param $handler
     */
    public function __construct(AcceptBid $handler)
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
        $dniUser = $request->request->get('dni');
        $bidId = $request->request->get('bidId');
        $houseId = $request->request->get('houseId');

        $bid = $this->handler->handle(new AcceptBidCommand($dniUser, $bidId, $houseId));
        return new JsonResponse($bid["data"], $bid["code"]);
    }
}
