<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 16/05/2018
 * Time: 19:51
 */

namespace App\Application\Bid\RejectBid;


use App\Domain\Model\Entity\Bid\Bid;

class RejectBidTransform implements RejectBidTransformInterface
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
