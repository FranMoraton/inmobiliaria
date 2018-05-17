<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 17/05/2018
 * Time: 22:45
 */

namespace App\Application\Bid\CreateBid;

use App\Domain\Model\Entity\Bid\Bid;

class CreateBidTransform implements CreateBidTransformInterface
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
