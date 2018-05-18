<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 18/05/2018
 * Time: 10:17
 */

namespace App\Application\Bid\ModifyBid;

use App\Domain\Model\Entity\Bid\Bid;

class ModifyBidTransform implements ModifyBidTransformInterface
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
