<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 17/05/2018
 * Time: 19:41
 */

namespace App\Application\Bid\ListBidsByOwner;

use App\Domain\Model\Entity\Bid\Bid;

class ListBidsByOwnerTransform implements ListBidsByOwnerTransformInterface
{

    /**
     * @param array|Bid[] $bids
     * @return array
     */
    public function transform(array $bids): array
    {
        $transformed = [];
        foreach ($bids as $bid) {
            $transformed [] = [
                "id" => $bid->getId(),
                "userBidding" => $bid->getUserBidding(),
                "house" => $bid->getHouse(),
                "moneyBidded" => $bid->getMoneyBidded(),
                "rejected" => $bid->getRejected(),
                "accepted" => $bid->getAccepted(),
                "biddingDate" => $bid->getBiddingDate()
            ];
        }

        return $transformed;
    }
}
