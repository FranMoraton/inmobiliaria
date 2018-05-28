<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 28/05/2018
 * Time: 9:43
 */

namespace App\Application\Bid\ListBidsByHouse;

use App\Domain\Model\Entity\Bid\Bid;

class ListBidsByHouseTransform implements ListBidsByHouseTransformInterface
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
                "userBidding" => $bid->getUserBidding()->getDNI(),
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
