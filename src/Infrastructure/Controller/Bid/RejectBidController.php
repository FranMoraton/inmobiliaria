<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 20:57
 */

namespace App\Infrastructure\Controller\Bid;


use App\Application\Bid\RejectBid\RejectBid;
use App\Application\Bid\RejectBid\RejectBidCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class RejectBidController
{
    private $handler;

    /**
     * RejectBidController constructor.
     * @param $handler
     */
    public function __construct(RejectBid $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \App\Domain\Model\Entity\Bid\BidDoNotExist
     * @throws \App\Domain\Model\Entity\House\HouseDoNotExist
     * @throws \App\Domain\Model\Entity\User\UserNotFound
     * @throws \App\Domain\Model\Entity\User\UsersDoNotMatches
     * @throws \Assert\AssertionFailedException
     */
    public function __invoke(Request $request)
    {
        $dniUser = $request->request->get('dni');
        $bidId = $request->request->get('bidId');
        $houseId = $request->request->get('houseId');

        $bid = $this->handler->handle(new RejectBidCommand($dniUser, $bidId, $houseId));
        return new JsonResponse($bid);
    }
}
