<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 19:50
 */

namespace App\Application\Bid\AcceptBid;


use App\Domain\Model\Entity\Bid\Bid;

class AcceptBidTransform implements AcceptBidTransformInterface
{
    public function transform(Bid $bid): array
    {
        return [
            "id" => $bid->getId(),
            "userBidding" => $bid->getUserBidding(),
            "house" => $bid->getHouse(),
            "moneyBidded" => $bid->getMoneyBidded(),
            "rejected" => $bid->getRejected(),
            "accepted" => $bid->getAccepted(),
            "biddingDate" => $bid->getBiddingDate()
        ];
    }

}
